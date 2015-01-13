<?php

class Space48_BarclaysPartnerFinance_Adminhtml_Bpf_IndexController
    extends Space48_BarclaysPartnerFinance_Controller_Admin_Abstract
{
    /**
     * submit proposal enquiry service call
     * 
     * @return void
     */
    public function proposalAction()
    {
        try {
            // get order
            $order = $this->_getOrder();
            
            // load application
            $application = Mage::getModel('space48_bpf/application')->loadByOrder($order);
            
            // dispatch event
            Mage::dispatchEvent('space48_bpf_proposal_enquiry', array(
                'order'       => $order,
                'application' => $application,
            ));
            
            // seems like all worked if we get here
            $this->_addSuccess(
                $this->_helper()->__('Successfully submitted proposal enquiry.')
            );
            
            // redirect back to order
            $this->_redirect('*/sales_order/view', array(
                'order_id'   => $order->getId(),
                'active_tab' => 'space48_bpf',
            ));
            
            return;
            
        } catch (Exception $e) {
            $this->_addError($e->getMessage());
            
            // get order id
            if ( $orderId = $this->_getOrderId() ) {
                $this->_redirect('*/sales_order/view', array('order_id' => $orderId));
                return;
            }
        }
        
        $this->_redirect('*/dashboard/index');
    }
    
    /**
     * submit notification service call
     * 
     * @return void
     */
    public function notificationAction()
    {
        try {
            // get order
            $order = $this->_getOrder();
            
            // load application
            $application = Mage::getModel('space48_bpf/application')->loadByOrder($order);
            
            // can only dispatch a notification that has not been sent before
            if ( $application->getSentDispatchNotification() ) {
                $this->_exception('Dispatch notification has already been sent.');
            }
            
            // create transport object
            $transport = new Varien_Object();
            
            // dispatch event
            Mage::dispatchEvent('space48_bpf_notification', array(
                'order'       => $order,
                'transport'   => $transport,
                'application' => $application,
            ));
            
            // get response
            $response = $transport->getResponse();
            
            // throw exception if no response object
            if ( ! ( $response instanceof Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatchResponse ) ) {
                $this->_exception('Invalid response object.');
            }
            
            // get result
            $result = $response->getResult();
            
            // output messages dependant on errors
            if ( $result->hasErrors() ) {
                foreach ( $result->getErrors() as $error ) {
                    $message = $error->getCode().': '.$error->getMessage();
                    
                    switch ( $error->getCode() ) {
                        case '601':
                            $message .= $this->_helper()->__('<br /> This normally means that the notification has already been sent.');
                        break;
                    }
                    
                    $this->_addError($message);
                }
            } else {
                // seems like all worked if we get here
                $this->_addSuccess(
                    $this->_helper()->__('Dispatch notification successfully completed.')
                );
            }
            
            // dispatch notification has been sent
            $application->sentDispatchNotification();
            
            // store comment
            $order->addStatusHistoryComment( $this->_helper()->__('Dispatch notification sent manually.') )->save();
            
            // redirect back to order
            $this->_redirect('*/sales_order/view', array(
                'order_id'   => $order->getId()
            ));
            
            return;
            
        } catch (Exception $e) {
            $this->_addError($e->getMessage());
            
            // get order id
            if ( $orderId = $this->_getOrderId() ) {
                $this->_redirect('*/sales_order/view', array('order_id' => $orderId));
                return;
            }
        }
        
        $this->_redirect('*/dashboard/index');
    }
}
