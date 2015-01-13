<?php

class Space48_BarclaysPartnerFinance_Model_Observer_Adminhtml_Sales_Order
{
    /**
     * add submit enquiry button to initiate a
     * proposal enquiry
     *
     * @param Varien_Event_Observer $observer
     */
    public function addSubmitEnquiryButton(Varien_Event_Observer $observer)
    {
        // get block
        $block = $observer->getEvent()->getBlock();
        
        // should be instance of "Mage_Adminhtml_Block_Sales_Order_View"
        if ( ! ( $block instanceof Mage_Adminhtml_Block_Sales_Order_View ) ) {
            return $this;
        }
        
        // get request, controller action
        $request    = Mage::app()->getRequest();
        $controller = $request->getControllerName();
        $action     = $request->getActionName();
        
        // controller should be "sales_order"
        if ( ! $controller == 'sales_order' ) {
            return $this;
        }
        
        // action should be "view"
        if ( ! $action == 'view' ) {
            return $this;
        }
        
        // get current order
        $order = Mage::registry('current_order');
        
        // order must not be in state we should
        // not proceed from
        switch ( $order->getState() ) {
            case Mage_Sales_Model_Order::STATE_COMPLETE:
            case Mage_Sales_Model_Order::STATE_CLOSED:
            case Mage_Sales_Model_Order::STATE_CANCELED:
            case Mage_Sales_Model_Order::STATE_HOLDED:
            case Mage_Sales_Model_Order::STATE_PAYMENT_REVIEW:
                return $this;
            break;
        }
        
        // try load application
        $application = Mage::getModel('space48_bpf/application')->loadByOrder($order);
        
        // if there is no application then this is
        // not a financed order
        if ( ! $application->getId() ) {
            return $this;
        }
        
        // confirm message
        $message = Mage::helper('space48_bpf')->__('Are you sure you want to perform this action?');
        
        // url
        $url = $block->getUrl('adminhtml/bpf_index/proposal');
        
        // add button
        $block->addButton('proposal_enquiry', array(
            'label'   => Mage::helper('space48_bpf')->__('Submit Proposal Enquiry'),
            'onclick' => "confirmSetLocation('{$message}', '{$url}');",
            'class'   => 'go',
        ));
        
        return $this;
    }
    
    /**
     * add dispatch notification button to
     *
     * @param Varien_Event_Observer $observer
     */
    public function addDispatchNotificationButton(Varien_Event_Observer $observer)
    {
        // get block
        $block = $observer->getEvent()->getBlock();
        
        // should be instance of "Mage_Adminhtml_Block_Sales_Order_View"
        if ( ! ( $block instanceof Mage_Adminhtml_Block_Sales_Order_View ) ) {
            return $this;
        }
        
        // get request, controller action
        $request    = Mage::app()->getRequest();
        $controller = $request->getControllerName();
        $action     = $request->getActionName();
        
        // controller should be "sales_order"
        if ( ! $controller == 'sales_order' ) {
            return $this;
        }
        
        // action should be "view"
        if ( ! $action == 'view' ) {
            return $this;
        }
        
        // get current order
        $order = Mage::registry('current_order');
        
        // order must not be in state we should
        // not proceed from
        switch ( $order->getStatus() ) {
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DISPATCHED:
                // do nothing
            break;
            default:
                return $this;
            break;
        }
        
        // try load application
        $application = Mage::getModel('space48_bpf/application')->loadByOrder($order);
        
        // if there is no application then this is
        // not a financed order
        if ( ! $application->getId() ) {
            return $this;
        }
        
        // can only dispatch a notification that has not been sent before
        if ( $application->getSentDispatchNotification() ) {
            return $this;
        }
        
        // confirm message
        $message = Mage::helper('space48_bpf')->__('Are you sure you want to perform this action?');
        
        // url
        $url = $block->getUrl('adminhtml/bpf_index/notification');
        
        // add button
        $block->addButton('notification', array(
            'label'   => Mage::helper('space48_bpf')->__('Submit Dispatch Notification'),
            'onclick' => "confirmSetLocation('{$message}', '{$url}');",
            'class'   => 'go',
        ));
        
        return $this;
    }
}
