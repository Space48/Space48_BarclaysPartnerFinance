<?php

class Space48_BarclaysPartnerFinance_Model_Observer_Soap
    extends Space48_BarclaysPartnerFinance_Model_Observer_Abstract
{
    /**
     * get soap client
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client
     */
    protected function _getClient()
    {
        return $this->_helper()->getClient();
    }
    
    /**
     * get helper
     *
     * @return Space48_BarclaysPartnerFinance_Helper_Data
     */
    protected function _helper($helper = 'space48_bpf/soap')
    {
        return parent::_helper($helper);
    }
    
    /**
     * on new finance application
     * 
     * this should fire after the user has selected to pay
     * via BPF
     * 
     * listens to "space48_bpf_new_application"
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function newFinanceApplication(Varien_Event_Observer $observer)
    {
        // get order, application and transport
        $order       = $this->_getOrderFromObserver($observer);
        $application = $this->_getApplicationFromObserver($observer);
        $transport   = $this->_getTransportFromObserver($observer);
        
        // get elements required for soap call
        $userCredentials = $this->_helper()->getUserCredentials();
        $proposalShort   = $this->_helper()->getProposalShort($order);
        $customer        = $this->_helper()->getCustomer($order);
        $address         = $this->_helper()->getAddress($order);
        $goods           = $this->_helper()->getGoods($order);
        
        // get data object
        $data = $this->_helper()->getNewApplicationDataShort(
            $userCredentials,
            $proposalShort,
            $customer,
            $address,
            $goods
        );
        
        // final object for call
        $submitNewApplicationShort = $this->_helper()->getSubmitNewApplicationShort($data);
        
        // invoke service call
        $response = $this->_getClient()->callSubmitNewApplicationShort($submitNewApplicationShort);
        
        // set elements in transport object
        $transport->addData(array(
            'params'   => $submitNewApplicationShort,
            'response' => $response,
        ));
        
        /**
         * dispatch event to allow other observers to react to 
         * changes
         */
        Mage::dispatchEvent('space48_bpf_new_finance_application_after', array(
            'order'       => $order,
            'application' => $application,
            'transport'   => $transport,
        ));
        
        return $this;
    }
    
    /**
     * new proposal enquiry
     * 
     * listens to "space48_bpf_proposal_enquiry"
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function proposalEnquiry(Varien_Event_Observer $observer)
    {
        // get order, application and transport
        $order       = $this->_getOrderFromObserver($observer);
        $application = $this->_getApplicationFromObserver($observer);
        $transport   = $this->_getTransportFromObserver($observer);
        
        // get elements required for soap call
        $userCredentials = $this->_helper()->getUserCredentials();
        $proposalId      = $this->_helper()->getProposalId($order);
        $clientReference = $this->_helper()->getClientReference($order);
        
        // get data
        $data = $this->_helper()->getProposalEnquiryData($userCredentials, $proposalId, $clientReference);
        
        // get submit proposal enquiry object to make service call
        $submitProposalEnquiry = $this->_helper()->getSubmitProposalEnquiry($data);
        
        // invoke service call
        $response = $this->_getClient()->callProposalEnquiry($submitProposalEnquiry);
        
        // add history comment
        $order->addStatusHistoryComment(
            $this->_helper()->__('Submitted Proposal Enquiry')
        );
        
        // set elements in transport object
        $transport->addData(array(
            'params'   => $submitProposalEnquiry,
            'response' => $response,
        ));
        
        /**
         * dispatch event to allow other observers to react to 
         * proposal changes
         */
        Mage::dispatchEvent('space48_bpf_proposal_enquiry_after', array(
            'order'       => $order,
            'application' => $application,
            'transport'   => $transport,
        ));
        
        return $this;
    }
    
    /**
     * new proposal enquiry
     * 
     * listens to "space48_bpf_notification"
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function notification(Varien_Event_Observer $observer)
    {
        // get order, application and transport
        $order       = $this->_getOrderFromObserver($observer);
        $application = $this->_getApplicationFromObserver($observer);
        $transport   = $this->_getTransportFromObserver($observer);
        
        // get elements required for soap call
        $proposalId       = $this->_helper()->getProposalId($order);
        $batchReference   = $this->_helper()->getBatchReference($order);
        $clientReference  = $this->_helper()->getClientReference($order);
        $userCredentials  = $this->_helper()->getUserCredentials();
        $balanceToFinance = $this->_helper()->getBalanceToFinance($order);
        
        // get notification
        $notification = $this->_helper()->getNotification($clientReference, $balanceToFinance, $proposalId);
        
        // get notification batch
        $notificationBatch = $this->_helper()->getNotificationBatch($batchReference, array($notification));
        
        // get data
        $data = $this->_helper()->getNotificationData($userCredentials, $notificationBatch);
        
        // get submit notification batch
        $submitNotificationBatch = $this->_helper()->getSubmitNotificationBatch($data);
        
        // invoke service call
        $response = $this->_getClient()->callSubmitNotificationBatch($submitNotificationBatch);
        
        // set elements in transport object
        $transport->addData(array(
            'params'   => $data,
            'response' => $response,
        ));
        
        /**
         * dispatch event to allow other observers to react to 
         * proposal changes
         */
        Mage::dispatchEvent('space48_bpf_notification_after', array(
            'order'       => $order,
            'application' => $application,
            'transport'   => $transport,
        ));
        
        return $this;
    }
}
