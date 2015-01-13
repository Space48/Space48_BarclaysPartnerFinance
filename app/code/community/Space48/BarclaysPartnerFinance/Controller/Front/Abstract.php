<?php

class Space48_BarclaysPartnerFinance_Controller_Front_Abstract extends Mage_Core_Controller_Front_Action
{
    /**
     * get session
     *
     * @return Mage_Core_Model_Session
     */
    protected function _getSession($type = 'core')
    {
        return Mage::getSingleton($type.'/session');
    }
    
    /**
     * get checkout session
     *
     * @return Mage_Checkout_Model_Session
     */
    protected function _getCheckoutSession()
    {
        return $this->_getSession('checkout');
    }
    
    /**
     * get customer session
     *
     * @return Mage_Customer_Model_Session
     */
    protected function _getCustomerSession()
    {
        return $this->_getSession('customer');
    }
    
    /**
     * add error message
     *
     * @param string $msg
     */
    protected function _addError($msg)
    {
        $this->_getSession()->addError( $this->_helper()->__($msg) );
        return $this;
    }
    
    /**
     * add success message
     *
     * @param string $msg
     */
    protected function _addSuccess($msg)
    {
        $this->_getSession()->addSuccess( $this->_helper()->__($msg) );
        return $this;
    }
    
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
     * get last/current order id
     *
     * @return int
     */
    protected function _getOrderId()
    {
        return $this->_getCheckoutSession()->getLastOrderId();
    }
    
    /**
     * get order model
     *
     * @return Mage_Sales_Model_Order|bool
     */
    protected function _getOrder()
    {
        // get order id
        $orderId = $this->_getOrderId();
        
        // there must be an order ID
        if ( ! $orderId ) {
            $this->_exception('Unable to locate order ID.');
        }
        
        // load order model
        $order = Mage::getModel('space48_bpf/sales_order')->load($orderId);
        
        // there must be an order record
        if ( ! $order || ! $order->getId() ) {
            $this->_exception('Unable to locate order information.');
        }
        
        // yay!
        return $order;
    }
}
