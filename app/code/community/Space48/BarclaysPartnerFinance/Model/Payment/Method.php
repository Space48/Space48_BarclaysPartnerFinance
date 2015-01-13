<?php
 
class Space48_BarclaysPartnerFinance_Model_Payment_Method extends Mage_Payment_Model_Method_Abstract
{
    /**
     * payment method code
     *
     * @var string
     */
    protected $_code = 'space48_bpf_method';
    
    /**
     * payment methods vars
     */
    protected $_isInitializeNeeded      = true;
    protected $_canUseInternal          = false;
    protected $_canUseForMultishipping  = false;
    
    /**
     * block types
     *
     * @var string
     */
    protected $_formBlockType = 'space48_bpf/payment_form';
    protected $_infoBlockType = 'space48_bpf/payment_info';
    
    /**
     * get redirect URL when clicking on "place order"
     * on front end
     *
     * @return string
     */
    public function getOrderPlaceRedirectUrl()
    {
        return Mage::getUrl('bpf/index/redirect', array(
            '_secure' => true
        ));
    }
    
    /**
     * on initialize
     *
     * @param  string $paymentAction
     * @param  Varien_Object $stateObject
     *
     * @return $this
     */
    public function initialize($paymentAction, $stateObject)
    {
        $stateObject->setState(Mage_Sales_Model_Order::STATE_PENDING_PAYMENT);
        $stateObject->setStatus(Space48_BarclaysPartnerFinance_Model_Application::STATUS_AWAITING_CUSTOMER);
        $stateObject->setIsNotified(false);
        return $this;
    }
    
    /**
     * is payment method available
     *
     * @return bool
     */
    public function isAvailable($quote = null)
    {
        // get quote total
        $total = Mage::helper('checkout')->getQuote()->getGrandTotal() * 1;
        
        // if total is less than minimum accepted
        // then return false
        if ( $total < ( $this->getConfigData('min') * 1 ) ) {
            return false;
        }
        
        return parent::isAvailable($quote);
    }
}
