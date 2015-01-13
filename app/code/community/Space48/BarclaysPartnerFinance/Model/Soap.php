<?php

class Space48_BarclaysPartnerFinance_Model_Soap
{
    /**
     * callback service call
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Server_Callback $callback
     * 
     * @return Space48_BarclaysPartnerFinance_Soap_Server_CallbackResponse
     */
    public function Callback(Space48_BarclaysPartnerFinance_Soap_Server_Callback $callback)
    {
        try {
            // try and get application model
            $application = $this->_getApplication($callback);
            
            // if we have loaded the application successfully
            if ( $application ) {
                // get order from application
                $order = $application->getOrder();
            }
            
            // we will try load via the returned customer
            // reference if we have failed to load the application
            // via the proposal id
            else {
                // get order
                $order = $this->_getOrder($callback);
                
                // make sure we have a loaded order model
                if ( $order && $order->getId() ) {
                    // get application model given order
                    $application = Mage::getModel('space48_bpf/application')->loadByOrder($order);
                }
            }
            
            // at this point we should have a loaded
            // application and order model
            if ( ! $application || ! $order ) {
                Mage::throwException('Unable to load order or application with information contained within callback.');
            }
            
            // add history comment
            $order->addStatusHistoryComment(
                Mage::helper('space48_bpf')->__('BPF Callback Received')
            );
            
            // need transport object
            $transport = new Varien_Object();
            
            // set elements in transport object
            $transport->addData(array(
                'response' => $callback,
            ));
            
            // fire event
            Mage::dispatchEvent('space48_bpf_soap_callback', array(
                'order'       => $order,
                'application' => $application,
                'transport'   => $transport,
            ));
            
        } catch (Exception $e) {
            // do nothing but log it
            Mage::helper('space48_bpf')->logException($e, 'bpf-soap-callback.log');
        }
        
        // create response objects
        $result   = new Space48_BarclaysPartnerFinance_Soap_Server_CallbackResult();
        $response = new Space48_BarclaysPartnerFinance_Soap_Server_CallbackResponse();
        
        // set result to response
        $response->setResult($result);
        
        // return response
        return $response;
    }
    
    /**
     * get application given response
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Server_Callback $callback
     *
     * @return Space48_BarclaysPartnerFinance_Model_Application
     */
    protected function _getApplication(Space48_BarclaysPartnerFinance_Soap_Server_Callback $callback)
    {
        // get proposal id
        $proposalId = $callback->getProposalID();
        
        // if no proposal
        if ( ! $proposalId ) {
            return false;
        }
        
        // load application
        $application = Mage::getModel('space48_bpf/application')->load($proposalId, 'proposal_id');
        
        // must exist
        if ( ! $application || ! $application->getId() ) {
            return false;
        }
        
        return $application;
    }
    
    /**
     * get order given response
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Server_Callback $callback
     *
     * @return Mage_Sales_Model_Order
     */
    protected function _getOrder(Space48_BarclaysPartnerFinance_Soap_Server_Callback $callback)
    {
        // get client reference
        $clientReference = $callback->getClientReference();
        
        // if we haven't got one
        if ( ! $clientReference ) {
            return false;
        }
        
        // try load order by increment id aka client reference
        // as known by the bpf service
        $order = Mage::getModel('space48_bpf/sales_order')->loadByIncrementId($clientReference);
        
        // if we were unsuccessful
        if ( ! $order || ! $order->getId() ) {
            return false;
        }
        
        return $order;
    }
}
