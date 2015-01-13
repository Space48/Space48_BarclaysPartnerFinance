<?php

class Space48_BarclaysPartnerFinance_Model_Application extends Mage_Core_Model_Abstract
{
    // pending
    const STATUS_AWAITING_CUSTOMER     = 'bpf_awaiting_customer';
    const STATUS_ACCEPTED              = 'bpf_accepted';
    const STATUS_REFERRED              = 'bpf_referred';
    const STATUS_INTRODUCER_PENDING    = 'bpf_introducer_pending';
    const STATUS_DOCUMENTS_RECIEVED    = 'bpf_documents_recieved';
    const STATUS_SNAGGED               = 'bpf_snagged';
    const STATUS_PARKED                = 'bpf_parked';
    
    // processing
    const STATUS_READY_TO_DELIVER      = 'bpf_ready_to_deliver';
    const STATUS_DISPATCHED            = 'bpf_dispatched';
    const STATUS_READY_FOR_LIVE        = 'bpf_ready_for_live';
    const STATUS_ACTIVE                = 'bpf_active';
    
    // complete
    const STATUS_LIVE                  = 'bpf_live';
    
    // canceled
    const STATUS_DECLINED              = 'bpf_declined';
    const STATUS_NOT_TAKEN_UP          = 'bpf_not_taken_up';
    const STATUS_BPF_CANCELLED         = 'bpf_bpf_cancelled';
    const STATUS_CUSTOMER_CANCELLED    = 'bpf_customer_cancelled';
    const STATUS_THIRD_PARTY_CANCELLED = 'bpf_third_party_cancelled';
    
    /**
     * holds order
     *
     * @var Mage_Sales_Model_Order
     */
    protected $_order;
    
    /**
     * holds checklist
     *
     * @var Space48_BarclaysPartnerFinance_Model_Resource_Application_Checklist_Collection
     */
    protected $_checklists;
    
    /**
     * holds sangs
     *
     * @var Space48_BarclaysPartnerFinance_Model_Resource_Application_Snag_Collection
     */
    protected $_snags;
    
    /**
     * get address
     *
     * @var Space48_BarclaysPartnerFinance_Model_Application_Address
     */
    protected $_address;
    
    /**
     * construct
     */
    protected function _construct()
    {
        $this->_init('space48_bpf/application');
    }
    
    /**
     * init
     *
     * @param Mage_Sales_Model_Order $order
     */
    public function init(Mage_Sales_Model_Order $order)
    {
        $this->loadByOrder($order);
        $this->setOrder($order);
        
        if ( ! $this->getId() ) {
            $this->save();
        }
        
        return $this;
    }
    
    /**
     * load by order model or order id
     *
     * @param  int|Mage_Sales_Model_Order $orderId
     *
     * @return $this
     */
    public function loadByOrder($orderId)
    {
        if ( $orderId instanceof Mage_Sales_Model_Order ) {
            $orderId = $orderId->getId();
        }
        
        return $this->load($orderId, 'order_id');
    }
    
    /**
     * set order
     *
     * @param Mage_Sales_Model_Order $order
     */
    public function setOrder(Mage_Sales_Model_Order $order)
    {
        // set order to application
        $this->_order = $order;
        $this->setOrderId($order->getId());
        
        // set application to order
        $order->setData('__application', $this);
        
        return $this;
    }
    
    /**
     * has order
     *
     * @return bool
     */
    public function hasOrder()
    {
        return $this->getOrder()->getId() ? true : false;
    }
    
    /**
     * get order
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        // if is null the order, set it
        if ( is_null($this->_order) ) {
            $this->_order = Mage::getModel('space48_bpf/sales_order');
        }
        
        // if we have an order id, load it
        if ( ! $this->_order->getId() ) {
            if ( $id = $this->getOrderId() ) {
                $this->_order->load($id);
            }
        }
        
        // set this application to order
        if ( ! $this->_order->getData('__application') ) {
            $this->_order->setData('__application', $this);
        }
        
        return $this->_order;
    }
    
    /**
     * get redirect url
     *
     * @return string
     */
    public function getRedirectUrl()
    {
        $url  = Mage::getStoreConfig('payment/space48_bpf_method/redirect_url');
        $url .= '?token='.$this->getToken();
        
        return $url;
    }
    
    /**
     * get checklist collection
     *
     * @return Space48_BarclaysPartnerFinance_Model_Resource_Application_Checklist_Collection
     */
    public function getChecklists()
    {
        if ( is_null($this->_checklists) ) {
            $collection = Mage::getResourceModel('space48_bpf/application_checklist_collection');
            $collection->setApplicationFilter($this);
            
            $this->_checklists = $collection;
        }
        
        return $this->_checklists;
    }
    
    /**
     * has checklist
     *
     * @return bool
     */
    public function hasChecklists()
    {
        return $this->getChecklists()->count() > 0;
    }
    
    /**
     * get address
     *
     * @return Space48_BarclaysPartnerFinance_Model_Application_Address
     */
    public function getAddress()
    {
        if ( is_null($this->_address) ) {
            $this->_address = Mage::getModel('space48_bpf/application_address')->load($this->getId(), 'application_id');
        }
        
        return $this->_address;
    }
    
    /**
     * has address
     *
     * @return bool
     */
    public function hasAddress()
    {
        return (bool) $this->getAddress()->getId();
    }
    
    /**
     * purge snags
     *
     * @return $this
     */
    public function purgeSnags()
    {
        $this->getResource()->purgeSnags($this);
        return $this;
    }
    
    /**
     * get snags
     *
     * @return Space48_BarclaysPartnerFinance_Model_Resource_Application_Snag_Collection
     */
    public function getSnags()
    {
        if ( is_null($this->_snags) ) {
            $collection = Mage::getResourceModel('space48_bpf/application_snag_collection');
            $collection->setApplicationFilter($this);
            
            $this->_snags = $collection;
        }
        
        return $this->_snags;
    }
    
    /**
     * has snags
     *
     * @return bool
     */
    public function hasSnags()
    {
        return $this->getSnags()->count() > 0;
    }
    
    /**
     * update accepted email sent flag
     *
     * @return $this
     */
    public function sentAcceptedEmail()
    {
        return $this->_updateSentStatus('sent_accepted_email');
    }
    
    /**
     * update referred email sent flag
     *
     * @return $this
     */
    public function sentReferredEmail()
    {
        return $this->_updateSentStatus('sent_referred_email');
    }
    
    /**
     * update declined email sent flag
     *
     * @return $this
     */
    public function sentDeclinedEmail()
    {
        return $this->_updateSentStatus('sent_declined_email');
    }
    
    /**
     * update cancelled email sent flag
     *
     * @return $this
     */
    public function sentCancelledEmail()
    {
        return $this->_updateSentStatus('sent_cancelled_email');
    }
    
    /**
     * update sent dispatch notification flag
     *
     * @return $this
     */
    public function sentDispatchNotification()
    {
        return $this->_updateSentStatus('sent_dispatch_notification');
    }
    
    /**
     * update sent status of emails
     *
     * @param  string $key
     *
     * @return $this
     */
    protected function _updateSentStatus($key)
    {
        // nothing to do if already sent
        if ( $this->getData($key) ) {
            return $this;
        }
        
        $this->setData($key, 1);
        $this->save();
        
        return $this;
    }
}
