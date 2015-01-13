<?php

class Space48_BarclaysPartnerFinance_Helper_Soap extends Mage_Core_Helper_Abstract
{
    /**
     * soap client
     *
     * @var Space48_BarclaysPartnerFinance_Soap_Client
     */
    protected $_client;
    
    /**
     * get client
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client
     */
    public function getClient()
    {
        if ( is_null($this->_client) ) {
            $this->_client = new Space48_BarclaysPartnerFinance_Soap_Client();
        }
        
        return $this->_client;
    }
    
    /**
     * get user credentials
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials
     */
    public function getUserCredentials()
    {
        $name = Mage::getStoreConfig('payment/space48_bpf_method/login_name');
        $pass = Mage::getStoreConfig('payment/space48_bpf_method/password');
        
        $credentials = new Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials();
        $credentials->setLoginName($name);
        $credentials->setPassword($pass);
        
        return $credentials;
    }
    
    /**
     * get proposal short
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_ProposalShort
     */
    public function getProposalShort(Mage_Sales_Model_Order $order)
    {
        $proposal = new Space48_BarclaysPartnerFinance_Soap_Client_ProposalShort();
        $proposal->setClientReference($this->getClientReference($order));
        $proposal->setCashPrice($this->toDecimal($order->getGrandTotal()));
        
        return $proposal;
    }
    
    /**
     * get proposal id
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return string
     */
    public function getProposalId(Mage_Sales_Model_Order $order)
    {
        return $this->getApplicationFromOrder($order)->getProposalId();
    }
    
    /**
     * get client reference
     * this is to ensure that we always get one reference
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return string
     */
    public function getClientReference(Mage_Sales_Model_Order $order)
    {
        return $order->getIncrementId();
    }
    
    /**
     * get balance to finance
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return float
     */
    public function getBalanceToFinance(Mage_Sales_Model_Order $order)
    {
        return $this->toDecimal($order->getGrandTotal());
    }
    
    /**
     * get batch reference
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return string
     */
    public function getBatchReference(Mage_Sales_Model_Order $order)
    {
        return 'BATCH'.$this->getClientReference($order);
    }
    
    /**
     * get customer
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_Customer
     */
    public function getCustomer(Mage_Sales_Model_Order $order)
    {
        $customer = new Space48_BarclaysPartnerFinance_Soap_Client_Customer();
        $customer->setTitle($order->getCustomerPrefix());
        $customer->setForename($order->getCustomerFirstname());
        
        if ( $initial = $this->getInitial($order->getCustomerMiddlename()) ) {
            $customer->setInitial($initial);
        }
        
        $customer->setSurname($order->getCustomerLastname());
        $customer->setEmailAddress($order->getCustomerEmail());
        
        return $customer;
    }
    
    /**
     * get address
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_Address
     */
    public function getAddress(Mage_Sales_Model_Order $order)
    {
        $billingAddress = $order->getBillingAddress();
        
        $address = new Space48_BarclaysPartnerFinance_Soap_Client_Address();
        $address->setStreet($billingAddress->getStreet1());
        $address->setDistrict($billingAddress->getStreet2());
        $address->setTown($billingAddress->getCity());
        $address->setCounty($billingAddress->getRegion());
        $address->setPostcode($billingAddress->getPostcode());
        
        return $address;
    }
    
    /**
     * get goods
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return array
     */
    public function getGoods(Mage_Sales_Model_Order $order)
    {
        $goods = array();
        
        $items = $order->getAllVisibleItems();
        
        foreach ( $items as $item ) {
            $goods[] = $this->getGood($item);
        }
        
        return $goods;
    }
    
    /**
     * get good
     *
     * @param  Mage_Sales_Model_Order_Item $item 
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_TypeOfGoods
     */
    public function getGood(Mage_Sales_Model_Order_Item $item)
    {
        $good = new Space48_BarclaysPartnerFinance_Soap_Client_TypeOfGoods();
        $good->setDescription($item->getName());
        $good->setQuantity($this->toInt($item->getQtyOrdered()));
        $good->setType($this->getAssetType());
        
        return $good;
    }
    
    /**
     * get new application data short
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $userCredentials
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_ProposalShort $proposalShort
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_Customer $customer
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_Address $address
     * @param  array $goods
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Request_SubmitNewApplicationShort
     */
    public function getNewApplicationDataShort(
        Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $userCredentials,
        Space48_BarclaysPartnerFinance_Soap_Client_ProposalShort $proposalShort,
        Space48_BarclaysPartnerFinance_Soap_Client_Customer $customer,
        Space48_BarclaysPartnerFinance_Soap_Client_Address $address,
        array $goods
        )
    {
        // build the request with elements
        $data = new Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataShort();
        $data->setUserCredentials($userCredentials);
        $data->setProposalShort($proposalShort);
        $data->setCustomer($customer);
        $data->setAddress($address);
        $data->addTypeOfGoodsArray($goods);
        
        return $data;
    }
    
    /**
     * get proposal enquiry data
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $credentials
     * @param  string $proposalId
     * @param  string $clientReference
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData
     */
    public function getProposalEnquiryData(Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $userCredentials, $proposalId, $clientReference)
    {
        // build data
        $data = new Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData();
        $data->setUserCredentials($userCredentials);
        $data->setProposalId($proposalId);
        $data->setClientReference($clientReference);
        
        return $data;
    }
    
    /**
     * get notification data
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $userCredentials
     * @param  string $proposalId
     * @param  string $clientReference
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_NotificationData
     */
    public function getNotificationData(
        Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $userCredentials,
        Space48_BarclaysPartnerFinance_Soap_Client_NotificationBatch $notificationBatch
        )
    {
        $data = new Space48_BarclaysPartnerFinance_Soap_Client_NotificationData();
        $data->setUserCredentials($userCredentials);
        $data->setNotificationBatch($notificationBatch);
        
        return $data;
    }
    
    /**
     * get notification
     *
     * @param  string $clientReference
     * @param  string $balanceToFinance
     * @param  string $proposalId
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_Notification
     */
    public function getNotification($clientReference, $balanceToFinance, $proposalId)
    {
        $notification = new Space48_BarclaysPartnerFinance_Soap_Client_Notification();
        $notification->setClientReference($clientReference);
        $notification->setBalanceToFinance($balanceToFinance);
        $notification->setProposalID($proposalId);
        
        return $notification;
    }
    
    /**
     * get notification batch
     *
     * @param  string $batchReference
     * @param  array  $notifications
     *
     * @return 
     */
    public function getNotificationBatch($batchReference, array $notifications)
    {
        $batch = new Space48_BarclaysPartnerFinance_Soap_Client_NotificationBatch();
        $batch->setBatchReference($batchReference);
        
        foreach ( $notifications as $notification ) {
            if ( $notification instanceof Space48_BarclaysPartnerFinance_Soap_Client_Notification ) {
                $batch->addNotification($notification);
            }
        }
        
        return $batch;
    }
    
    /**
     * get submit notification batch
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_NotificationData $data
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatch
     */
    public function getSubmitNotificationBatch(Space48_BarclaysPartnerFinance_Soap_Client_NotificationData $data)
    {
        $submitNotificationBatch = new Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatch();
        $submitNotificationBatch->setNotificationData($data);
        
        return $submitNotificationBatch;
    }
    
    /**
     * get submit new application short
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataShort $data
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShort
     */
    public function getSubmitNewApplicationShort(Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataShort $data)
    {
        $short = new Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShort();
        $short->setNewApplicationDataShort($data);
        
        return $short;
    }
    
    /**
     * get submit proposal enquiry
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData $data
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_SubmitProposalEnquiry
     */
    public function getSubmitProposalEnquiry(Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData $data)
    {
        $enquiry = new Space48_BarclaysPartnerFinance_Soap_Client_SubmitProposalEnquiry();
        $enquiry->setProposalEnquiryData($data);
        
        return $enquiry;
    }
    
    /**
     * get application from order
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return Space48_BarclaysPartnerFinance_Model_Application
     */
    public function getApplicationFromOrder(Mage_Sales_Model_Order $order)
    {
        return Mage::helper('space48_bpf')->getApplicationFromOrder($order);
    }
    
    /**
     * get asset type
     *
     * @return string
     */
    public function getAssetType()
    {
        $type = Mage::getStoreConfig('payment/space48_bpf_method/asset_type');
        
        if ( ! $type ) {
            return 'BD2';
        }
        
        return $type;
    }
    
    /**
     * get initial
     *
     * @param  string $value
     *
     * @return string
     */
    public function getInitial($value)
    {
        return strtoupper(substr($value, 0, 1));
    }
    
    /**
     * format number to decimals, will be string
     *
     * @param  int|float|string $value
     *
     * @return string
     */
    public function toDecimal($value)
    {
        return number_format($value * 1, 2, '.', '');
    }
    
    /**
     * convert to int
     *
     * @param  int|float|string $value
     *
     * @return int
     */
    public function toInt($value)
    {
        return intval($value);
    }
}
