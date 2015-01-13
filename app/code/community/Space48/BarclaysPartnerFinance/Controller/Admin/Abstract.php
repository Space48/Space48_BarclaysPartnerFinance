<?php

class Space48_BarclaysPartnerFinance_Controller_Admin_Abstract extends Mage_Adminhtml_Controller_Action
{
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
        return $this->getRequest()->getParam('order_id');
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
