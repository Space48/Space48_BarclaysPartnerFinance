<?php

class Space48_BarclaysPartnerFinance_Model_Observer_Silentnight_Orderupdate
{
    /**
     * this method checks to see if the order update module can
     * allow the update of an order status
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function canUpdateStatus(Varien_Event_Observer $observer)
    {
        // get order and transport
        $order = $observer->getEvent()->getOrder();
        $transport = $observer->getEvent()->getTransport();
        
        // order must exist
        if ( ! $order || ! $order->getId() ) {
            return $this;
        }
        
        // check the old status
        switch ( $transport->getOldStatus() ) {
            // ready to deliver status
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
                switch ( $transport->getNewStatus() ) {
                    // any of these status can be updated
                    case Silentnight_OrderUpdate_Model_Order::STATUS_PROCESSING_540:
                    case Silentnight_OrderUpdate_Model_Order::STATUS_PROCESSING_555:
                    case Silentnight_OrderUpdate_Model_Order::STATUS_PROCESSING_580:
                    case Silentnight_OrderUpdate_Model_Order::STATUS_COMPLETE_610:
                        $transport->setCanUpdate(true);
                    break;
                }
            break;
        }
        
        return $this;
    }
    
    /**
     * this method allows us to change the state/status/comment before an
     * order is deemed "complete". when a finance application order is placed
     * we need to tell barclays that a particular order has been dispatched.
     * this will then in turn set the application live and forward the money
     * on to silentnight
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function beforeOrderComplete(Varien_Event_Observer $observer)
    {
        // get order and transport
        $order = $observer->getEvent()->getOrder();
        $transport = $observer->getEvent()->getTransport();
        
        // order must exist
        if ( ! $order || ! $order->getId() ) {
            return $this;
        }
        
        $application = Mage::helper('space48_bpf')->getApplicationFromOrder($order);
        
        // this ensures that this order is a "bpf" order
        if ( ! $application || ! $application->getId() ) {
            return $this;
        }
        
        // build new comment
        $comment = Mage::helper('space48_bpf')->__("Order has been dispatched and is now ready for BPF batch notification.");
        
        // set new data in transport object
        $transport->setState(Mage_Sales_Model_Order::STATE_PROCESSING);
        $transport->setStatus(Space48_BarclaysPartnerFinance_Model_Application::STATUS_DISPATCHED);
        $transport->setComment($comment);
        
        return $this;
    }
}
