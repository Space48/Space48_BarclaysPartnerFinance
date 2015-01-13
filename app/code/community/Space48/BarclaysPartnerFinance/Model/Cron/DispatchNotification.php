<?php

class Space48_BarclaysPartnerFinance_Model_Cron_DispatchNotification
    extends Space48_BarclaysPartnerFinance_Model_Cron_Abstract
{
    /**
     * this cron will gather all orders that have been dispatched
     * and it is not required that the bpf service is notified
     * of their dispatched status
     *
     * @return $this
     */
    public function processDispatchNotifications()
    {
        // get orders
        $orders = $this->_getOrders();
        
        // no orders then no need to continue
        if ( ! $orders->count() ) {
            return $this;
        }
        
        foreach ( $orders as $order ) {
            $this->_sendDispatchNotification($order);
        }
        
        return $this;
    }
    
    /**
     * send dispatch notification
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return $this
     */
    protected function _sendDispatchNotification(Mage_Sales_Model_Order $order)
    {
        // load application
        $application = Mage::getModel('space48_bpf/application')->loadByOrder($order);
        
        // can only dispatch a notification that has not been sent before
        if ( $application->getSentDispatchNotification() ) {
            return $this;
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
        
        // exit it out if unexpected response
        if ( ! ( $response instanceof Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatchResponse ) ) {
            return $this;
        }
        
        // exit out if there are any errors
        if ( $response->getResult()->hasErrors() ) {
            return $this;
        }
        
        /**
         * @todo are we implementing some better error checking functionality
         * here?
         */
        
        // dispatch notification has been sent
        $application->sentDispatchNotification();
        
        // store comment
        $order->addStatusHistoryComment( Mage::helper('space48_bpf')->__('Dispatch notification sent automatically.') )->save();
        
        return $this;
    }
    
    /**
     * get orders
     *
     * @return Mage_Sales_Model_Resource_Order_Collection
     */
    protected function _getOrders()
    {
        // get order collection
        $collection = Mage::getResourceModel('sales/order_collection');
        
        // get select object
        $select = $collection->getSelect();
        
        // join application table and filter by applications
        // where a notification has not been sent
        $table = $collection->getTable('space48_bpf/application');
        $select->join(array('application' => $table), 'main_table.entity_id = application.order_id', array());
        
        // add state filter
        $select->where('main_table.state = ?', Mage_Sales_Model_Order::STATE_PROCESSING);
        
        // add status filter
        $select->where('main_table.status = ?', Space48_BarclaysPartnerFinance_Model_Application::STATUS_DISPATCHED);
        
        // add dispatch notification filter
        $select->where('application.sent_dispatch_notification = ?', 0);
        
        return $collection;
    }
}
