<?php

class Space48_BarclaysPartnerFinance_Model_Observer_Application
    extends Space48_BarclaysPartnerFinance_Model_Observer_Abstract
{
    /**
     * alias to "onProposalEnquiry"
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function onSoapCallback(Varien_Event_Observer $observer)
    {
        return $this->onProposalEnquiry($observer);
    }
    
    /**
     * on after proposal enquiry
     * 
     * listens to "space48_bpf_proposal_enquiry_after"
     * listens to "space48_bpf_soap_callback"
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function onProposalEnquiry(Varien_Event_Observer $observer)
    {
        // get order, application and transport
        $order       = $this->_getOrderFromObserver($observer);
        $application = $this->_getApplicationFromObserver($observer);
        $transport   = $this->_getTransportFromObserver($observer);
        
        // get response
        $response = $transport->getResponse();
        
        // if this is data from a soap call
        if ( $response instanceof Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponse ) {
            /**
             * get result object
             *
             * @var Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData
             */
            $data = $response->getResult();
        }
        
        // if this is data from callback from bpf
        elseif ( $response instanceof Space48_BarclaysPartnerFinance_Soap_Server_Callback ) {
            /**
             * get result object
             *
             * @var Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData
             */
            $data = $response;
        }
        
        // we have failed
        else {
            $this->_exception('Invalid response object.');
        }
        
        // change to "1" to debug response data
        if ( 0 ) { echo '<pre>'; print_r($data); exit; }
        
        // process order status
        $this->_processOrderStatus($data, $order);
        
        // process checklist conditions
        $this->_processAddress($data, $application);
        
        // process checklist conditions
        $this->_processChecklistConditions($data, $application);
        
        // process snags
        $this->_processSnags($data, $application);
        
        // we need this so that magento does not automatically
        // set the order to "complete"
        $this->_setActionStateIfRequired($order);
        
        // save the order and application
        $order->save();
        $application->save();
        
        return $this;
    }
    
    /**
     * set action state if required
     * 
     * this method does the exact same checks as in Mage_Sales_Model_Order::_checkState()
     * and if all conditions are met then we need to set the action flag because
     * otherwise the order will automatically be set to "complete" and this is undesired
     * functionality. the bpf order is only complete after we hit a status of "live" given
     * by bpf themselves.
     *
     * @param Mage_Sales_Model_Order $order
     */
    protected function _setActionStateIfRequired(Mage_Sales_Model_Order $order)
    {
        if ( ! $order->isCanceled() && ! $order->canUnhold() && ! $order->canInvoice() && ! $order->canShip() ) {
            if ( 0 == $order->getBaseGrandTotal() || $order->canCreditmemo() ) {
                $order->setActionFlag(Mage_Sales_Model_Order::ACTION_FLAG_EDIT, false);
            }
        }
        
        return $this;
    }
    
    /**
     * process order status
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $data
     * @param  Mage_Sales_Model_Order $order
     *
     * @return $this
     */
    protected function _processOrderStatus(
        Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $data,
        Mage_Sales_Model_Order $order
        )
    {
        // get old and new status
        $oldStatus = $order->getStatus();
        $newStatus = $this->_helper()->getMagentoStatusByBpfStatus($data->getStatus());
        
        // check if status is newer
        if ( ! $this->_helper()->isStatusNewer($oldStatus, $newStatus) ) {
            return $this;
        }
        
        // for event
        $transport = new Varien_Object(array(
            'old_status'   => $oldStatus,
            'new_status'   => $newStatus,
            'can_continue' => true,
        ));
        
        // to allow hooks into before updating status
        Mage::dispatchEvent('space48_bpf_proposal_enquiry_update_status_before', array(
            'transport' => $transport,
            'order'     => $order,
        ));
        
        // check to see if we can continue
        if ( $transport->getCanContinue() === false ) {
            return $this;
        }
        
        // get new status from transport
        $state  = Mage_Sales_Model_Order::STATE_PENDING_PAYMENT;
        $status = $transport->getNewStatus();
        
        // status should be one of the existing status
        if ( ! $this->_helper()->isValidStatus($status) ) {
            return $this;
        }
        
        // depending on new status we need
        // to apply different actions
        switch ( $status ) {
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACCEPTED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_REFERRED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_INTRODUCER_PENDING:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DOCUMENTS_RECIEVED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED:
                // pending
                $state = Mage_Sales_Model_Order::STATE_PENDING_PAYMENT;
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                
                // we only need to generate invoice once
                // we hit this status. there is some
                // logic in place within the following
                // method to ensure that we only create
                // one invoice per bpf order
                $this->_generateInvoice($order, $newStatus);
                
                // processing
                $state = Mage_Sales_Model_Order::STATE_PROCESSING;
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                // complete
                $state = Mage_Sales_Model_Order::STATE_COMPLETE;
            break;
                
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                // cancelled
                $state = Mage_Sales_Model_Order::STATE_CANCELED;
            break;
        }
        
        // update order state/status
        $this->_updateOrderStatus($order, $state, $status);
        
        // update transport object
        $transport->setState($state);
        $transport->setStatus($status);
        
        // to allow hooks into before updating status
        Mage::dispatchEvent('space48_bpf_proposal_enquiry_update_status_after', array(
            'transport' => $transport,
            'order'     => $order,
        ));
        
        return $this;
    }
    
    /**
     * generate invoice for order
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return $this
     */
    public function _generateInvoice(Mage_Sales_Model_Order $order, $status)
    {
        // only deal with this status
        if ( ! $status == Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER ) {
            return $this;
        }
        
        // if this order has invoices then
        // we will assume that we do not need
        // to create another one.
        if ( $order->hasInvoices() ) {
            return $this;
        }
        
        // get all items
        $items = $order->getItemsCollection();
        
        // quantity array for invoice
        $qtys = array();
        
        // loop through and build qtys
        foreach( $items as $item ) {
            $qtys[$item->getId()] = $item->getQtyOrdered();
        }
        
        // prepare invoice
        $invoice = Mage::getModel('sales/service_order', $order)->prepareInvoice($qtys);
        
        // register invoice
        $invoice->register();
        
        // we dont want to notify customer
        $invoice->getOrder()->setCustomerNoteNotify(false);
        
        // as per controller
        $invoice->getOrder()->setIsInProcess(true);
        
        // save transactions
        $transactionSave = Mage::getModel('core/resource_transaction')
            ->addObject($invoice)
            ->addObject($invoice->getOrder())
            ->save();
        
        // store comment
        $order->addStatusHistoryComment(
            $this->_helper()->__('Invoice generated.')
        );
        
        // sanity save
        $invoice->save();
        $order->save();
        
        return $this;
    }
    
    /**
     * update order status
     *
     * @param  Mage_Sales_Model_Order $order
     * @param  string $state
     * @param  string $status
     *
     * @return $this
     */
    public function _updateOrderStatus(Mage_Sales_Model_Order $order, $state, $status)
    {
        $comment = $this->_helper()->__(
            'Changed order status from "%s" (%s) to "%s" (%s)',
            $order->getConfig()->getStatusLabel($order->getStatus()),
            $order->getConfig()->getStatusLabel($order->getState()),
            $order->getConfig()->getStatusLabel($status),
            $order->getConfig()->getStatusLabel($state)
        );
        
        if ( $order instanceof Space48_BarclaysPartnerFinance_Model_Sales_Order ) {
            $order->setCustomState($state, $status, $comment, null);
        } else {
            $order->setState($state, $status, $comment, null);
        }
        
        $order->save();
        
        return $this;
    }
    
    /**
     * process checklist conditions and store in application
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $data
     *
     * @return $this
     */
    protected function _processChecklistConditions(
        Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $data,
        Space48_BarclaysPartnerFinance_Model_Application $application
        )
    {
        $checklists = $data->getChecklistConditions();
        
        foreach ( $checklists as $checklist ) {
            $model = Mage::getModel('space48_bpf/application_checklist');
            $model->loadByApplicationAndType($application, $checklist);
            $model->setApplication($application);
            $model->applyChecklistResponseObject($checklist);
            $model->save();
        }
        
        return $this;
    }
    
    /**
     * process snags and store in application
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $data
     *
     * @return $this
     */
    protected function _processSnags(
        Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $data,
        Space48_BarclaysPartnerFinance_Model_Application $application
        )
    {
        // get snags
        $snags = $data->getSnags();
        
        // must have at least 1
        if ( ! $snags || ! count($snags) ) {
            return $this;
        }
        
        // purge all previous
        $application->purgeSnags();
        
        // add new snags
        foreach ( $snags as $snag ) {
            $model = Mage::getModel('space48_bpf/application_snag');
            $model->setApplication($application);
            $model->applySnagObject($snag);
            $model->save();
        }
        
        return $this;
    }
    
    protected function _processAddress(
        Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $data,
        Space48_BarclaysPartnerFinance_Model_Application $application
        )
    {
        $address = $data->getCustomerAddress();
        
        $model = Mage::getModel('space48_bpf/application_address')->loadByApplication($application);
        $model->setApplication($application);
        $model->setAddressResponseObject($address);
        $model->save();
        
        return $this;
    }
}
