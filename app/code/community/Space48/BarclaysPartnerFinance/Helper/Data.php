<?php

class Space48_BarclaysPartnerFinance_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     * whether this module is enabled or not
     *
     * @return bool
     */
    public function isEnabled()
    {
        return (bool) Mage::getStoreConfig('payment/space48_bpf_method/active');
    }
    
    /**
     * this method basically mimics Mage::logException
     * except that it allows us to place it in a custom
     * location
     *
     * @return $this
     */
    public function logException(Exception $e, $filename = 'bpf-exceptions.log')
    {
        Mage::log($e->getMessage(), null, $filename, true);
        return $this;
    }
    
    /**
     * get magento status given bpf status
     *
     * @param  string $status
     *
     * @return string
     */
    public function getMagentoStatusByBpfStatus($status)
    {
        // clean it up just in case
        $status = trim($status);
        $status = strtolower($status);
        
        switch ( $status ) {
            // awaiting customer
            case 'awaiting customer':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_AWAITING_CUSTOMER;
            break;
            
            // accepted
            case 'accepted':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACCEPTED;
            break;
            
            // referred
            case 'referred':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_REFERRED;
            break;
            
            // introducer pending
            case 'introducer pending':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_INTRODUCER_PENDING;
            break;
            
            // documents recieved
            case 'documents recieved':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_DOCUMENTS_RECIEVED;
            break;
            
            // snagged
            case 'snagged':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED;
            break;
            
            // parked
            case 'parked':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED;
            break;
            
            /**
             * processing from this point forward
             */
            
            // ready to deliver
            case 'ready to deliver':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER;
            break;
            
            // ready for live
            case 'ready for live':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE;
            break;
            
            // active
            case 'active':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE;
            break;
            
            /**
             * complete from this point forward
             */
            
            // live
            case 'live':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE;
            break;
            
            /**
             * cancelled from this point forward
             */
            
            // declined
            case 'declined':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED;
            break;
            
            // not taken up
            case 'not taken up':
            case 'ntu':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP;
            break;
            
            // bpf cancelled
            case 'bpf cancelled':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED;
            break;
            
            // customer cancelled
            case 'customer cancelled':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED;
            break;
            
            // third party cancelled
            case 'third party cancelled':
                return Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED;
            break;
        }
        
        return '';
    }
    
    /**
     * is valid status
     *
     * @param  string $status
     *
     * @return bool
     */
    public function isValidStatus($status)
    {
        switch ( $status ) {
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_AWAITING_CUSTOMER:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACCEPTED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_REFERRED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_INTRODUCER_PENDING:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DOCUMENTS_RECIEVED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DISPATCHED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                return true;
            break;
        }
        
        return false;
    }
    
    /**
     * is status newer
     *
     * @param  string $oldStatus the old status
     * @param  string $newStatus the new status
     *
     * @return bool
     */
    public function isStatusNewer($oldStatus, $newStatus)
    {
        switch ( $oldStatus ) {
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_AWAITING_CUSTOMER:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACCEPTED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_REFERRED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_INTRODUCER_PENDING:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DOCUMENTS_RECIEVED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACCEPTED:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_INTRODUCER_PENDING:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DOCUMENTS_RECIEVED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_REFERRED:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_INTRODUCER_PENDING:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DOCUMENTS_RECIEVED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_INTRODUCER_PENDING:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DOCUMENTS_RECIEVED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DOCUMENTS_RECIEVED:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DOCUMENTS_RECIEVED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_PARKED:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_SNAGGED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DISPATCHED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DISPATCHED:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
                switch ( $newStatus ) {
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                    case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                        return true;
                    break;
                }
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                // at this point, agreement is read only
                return false;
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED:
                // at this point, order has been cancelled, no further action
                // can be taken
                return false;
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
                // at this point, order has been cancelled, no further action
                // can be taken
                return false;
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
                // at this point, order has been cancelled, no further action
                // can be taken
                return false;
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
                // at this point, order has been cancelled, no further action
                // can be taken
                return false;
            break;
            
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
                // at this point, order has been cancelled, no further action
                // can be taken
                return false;
            break;
        }
        
        return false;
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
        // try get application from order
        $application = $order->getData('__application');
        
        // return application
        if ( $application instanceof Space48_BarclaysPartnerFinance_Model_Application ) {
            return $application;
        }
        
        // try load application by order id
        $application = Mage::getModel('space48_bpf/application')->load($order->getId(), 'order_id');
        
        // if it does not exist then this order
        // is not a finance application order
        if ( ! $application->getId() ) {
            return false;
        }
        
        // set order
        $application->setOrder($order);
        
        return $application;
    }
    
    /**
     * get now timestamp
     *
     * @return int
     */
    public function now()
    {
        return Mage::getModel('core/date')->timestamp() * 1;
    }
}
