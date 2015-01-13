<?php
/**
 * @internal this class does not override any core class or functionality.
 * it is only used within this module to allow us to set protected states
 * at will or to allow any other functionality that is within the scope of
 * this module only.
 */
class Space48_BarclaysPartnerFinance_Model_Sales_Order extends Mage_Sales_Model_Order
{
    /**
     * Order state setter.
     * If status is specified, will add order status history with specified comment
     * the setData() cannot be overriden because of compatibility issues with resource model
     *
     * @param string $state
     * @param string|bool $status
     * @param string $comment
     * @param bool $isCustomerNotified
     * 
     * @return Mage_Sales_Model_Order
     */
    public function setCustomState($state, $status = false, $comment = '', $isCustomerNotified = null)
    {
        return $this->_setState($state, $status, $comment, $isCustomerNotified, false);
    }
}
