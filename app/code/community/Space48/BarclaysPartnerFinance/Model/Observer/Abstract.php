<?php

abstract class Space48_BarclaysPartnerFinance_Model_Observer_Abstract
{
    /**
     * get helper
     *
     * @return Space48_BarclaysPartnerFinance_Helper_Data
     */
    protected function _helper($helper = 'space48_bpf')
    {
        return Mage::helper($helper);
    }
    
    /**
     * throw exception
     *
     * @param  string $msg
     *
     * @return void
     */
    protected function _exception($msg)
    {
        Mage::throwException( $this->_helper()->__($msg) );
    }
    
    /**
     * get order from observer
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return Mage_Sales_Model_Order
     */
    protected function _getOrderFromObserver(Varien_Event_Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();
        
        if ( ! ( $order instanceof Mage_Sales_Model_Order ) ) {
            $this->_exception('Invalid order model or no order model exists.');
        }
        
        if ( ! $order || ! $order->getId() ) {
            $this->_exception('Invalid order model or no order model exists.');
        }
        
        return $order;
    }
    
    /**
     * get application from observer
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return Space48_BarclaysPartnerFinance_Model_Application
     */
    protected function _getApplicationFromObserver(Varien_Event_Observer $observer)
    {
        $application = $observer->getEvent()->getApplication();
        
        if ( ! ( $application instanceof Space48_BarclaysPartnerFinance_Model_Application ) ) {
            $this->_exception('Invalid application model or application not initiated.');
        }
        
        if ( ! $application || ! $application->getId() ) {
            $this->_exception('Invalid application model or application not initiated.');
        }
        
        return $application;
    }
    
    /**
     * get transport object from observer
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return Varien_Object
     */
    protected function _getTransportFromObserver(Varien_Event_Observer $observer)
    {
        $transport = $observer->getEvent()->getTransport();
        
        // if there is no object, then
        // we'll create a dummy one anyway
        if ( ! $transport ) {
            $transport = new Varien_Object();
        }
        
        return $transport;
    }
    
    /**
     * get config
     *
     * @param  string $key
     *
     * @return string
     */
    protected function _getConfig($key, $storeId = null)
    {
        return Mage::getStoreConfig('payment/space48_bpf_method/'.$key, $storeId);
    }
}
