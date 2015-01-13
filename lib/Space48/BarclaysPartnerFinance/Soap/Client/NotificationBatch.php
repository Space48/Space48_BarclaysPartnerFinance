<?php

class Space48_BarclaysPartnerFinance_Soap_Client_NotificationBatch
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * notifications
     *
     * @var array
     */
    public $Notification = array();
    
    /**
     * batch reference
     *
     * @var string
     */
    public $BatchReference;
    
    /**
     * add notification
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_Notification $notification
     */
    public function addNotification(Space48_BarclaysPartnerFinance_Soap_Client_Notification $notification)
    {
        $this->Notification[] = $notification;
        return $this;
    }
    
    /**
     * set batch reference
     *
     * @param string $reference
     */
    public function setBatchReference($reference)
    {
        $this->BatchReference = $reference;
        return $this;
    }
}
