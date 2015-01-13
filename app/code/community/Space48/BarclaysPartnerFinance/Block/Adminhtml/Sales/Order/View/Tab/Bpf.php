<?php

class Space48_BarclaysPartnerFinance_Block_Adminhtml_Sales_Order_View_Tab_Bpf
    extends Mage_Adminhtml_Block_Sales_Order_Abstract
        implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * constructor
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('space48/bpf/sales/order/view/tab/bpf.phtml');
    }
    
    /**
     * Retrieve order model instance
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        return Mage::registry('current_order');
    }
    
    /**
     * get application
     *
     * @return Space48_BarclaysPartnerFinance_Model_Application
     */
    public function getApplication()
    {
        return Mage::getModel('space48_bpf/application')->loadByOrder($this->getOrder());
    }
    
    /**
     * has checklist conditions
     *
     * @return bool
     */
    public function hasChecklists()
    {
        return $this->getApplication()->hasChecklists();
    }
    
    /**
     * get checklists
     *
     * @return Space48_BarclaysPartnerFinance_Model_Resource_Application_Checklist_Collection
     */
    public function getChecklists()
    {
        return $this->getApplication()->getChecklists();
    }
    
    /**
     * get formatted satisfied on date
     *
     * @param  Space48_BarclaysPartnerFinance_Model_Application_Checklist $checklist
     *
     * @return string
     */
    public function getChecklistSatisfiedOn(Space48_BarclaysPartnerFinance_Model_Application_Checklist $checklist)
    {
        // get date
        $date = $checklist->getSatisfiedOn();
        
        // if not date, then return dash only
        if ( ! $date ) {
            return '-';
        }
        
        // substr will remove the '00:00:00'
        return substr($date, 0, 10);
    }
    
    /**
     * has snags
     *
     * @return bool
     */
    public function hasSnags()
    {
        return $this->getApplication()->hasSnags();
    }
    
    /**
     * get snags
     *
     * @return Space48_BarclaysPartnerFinance_Model_Resource_Application_Snag_Collection
     */
    public function getSnags()
    {
        return $this->getApplication()->getSnags();
    }
    
    /**
     * has application
     *
     * @return bool
     */
    public function hasApplication()
    {
        return (bool) $this->getApplication()->getId();
    }
    
    /**
     * has address
     *
     * @return bool
     */
    public function hasAddress()
    {
        return $this->getApplication()->hasAddress();
    }
    
    /**
     * get address
     *
     * @return Space48_BarclaysPartnerFinance_Model_Application_Address
     */
    public function getAddress()
    {
        return $this->getApplication()->getAddress();
    }

    /**
     * Retrieve source model instance
     *
     * @return Mage_Sales_Model_Order
     */
    public function getSource()
    {
        return $this->getOrder();
    }
    
    /**
     * get tab label
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('sales')->__('Barclays Partner Finance');
    }
    
    /**
     * get tab title
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('sales')->__('Barclays Partner Finance');
    }
    
    /**
     * can show tab
     *
     * @return bool
     */
    public function canShowTab()
    {
        if ( ! $this->hasApplication() ) {
            return false;
        }
        
        return true;
    }
    
    /**
     * is hidden
     *
     * @return bool
     */
    public function isHidden()
    {
        return false;
    }
}
