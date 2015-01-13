<?php

class Space48_BarclaysPartnerFinance_Soap_Client_NotificationData
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * user credentials
     *
     * @var Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials
     */
    public $UserCredentials;
    
    /**
     * notification batch
     *
     * @var Space48_BarclaysPartnerFinance_Soap_Client_NotificationBatch
     */
    public $NotificationBatch;
    
    /**
     * set user credentials
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $usercredentials
     */
    public function setUserCredentials(Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $usercredentials)
    {
        $this->UserCredentials = $usercredentials;
        return $this;
    }
    
    /**
     * set notification batch
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_NotificationBatch $notificationbatch
     */
    public function setNotificationBatch(Space48_BarclaysPartnerFinance_Soap_Client_NotificationBatch $notificationbatch)
    {
        $this->NotificationBatch = $notificationbatch;
        return $this;
    }
}
