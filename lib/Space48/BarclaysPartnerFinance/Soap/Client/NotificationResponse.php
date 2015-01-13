<?php

class Space48_BarclaysPartnerFinance_Soap_Client_NotificationResponse
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_Errors
     */
    public $Errors;
    
    /**
     * @var int
     */
    public $BatchID;
    
    /**
     * @var int
     */
    public $NumberOfNotificationsAccepted;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_NotificationRejections
     */
    public $NotificationRejections;
    
    /**
     * get
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_Errors
     */
    protected function _getErrors()
    {
        return $this->Errors;
    }
    
    /**
     * has errors
     *
     * @return bool
     */
    public function hasErrors()
    {
        $errors = $this->_getErrors();
        
        if ( ! $errors ) {
            return false;
        }
        
        return $errors->hasErrors();
    }
    
    /**
     * return array of errors
     *
     * @return array
     */
    public function getErrors()
    {
        if ( ! $this->hasErrors() ) {
            return array();
        }
        
        $errors = $this->_getErrors();
        
        if ( ! $errors ) {
            return array();
        }
        
        return $errors->getErrors();
    }
    
    /**
     * get
     *
     * @return int
     */
    public function getBatchID()
    {
        return $this->BatchID;
    }
    
    /**
     * get
     *
     * @return int
     */
    public function getNumberOfNotificationsAccepted()
    {
        return $this->NumberOfNotificationsAccepted;
    }
    
    /**
     * get
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_NotificationRejections
     */
    public function getNotificationRejections()
    {
        return $this->NotificationRejections;
    }
}
