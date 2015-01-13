<?php

class Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatch
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData
     */
    public $notificationData;
    
    /**
     * set notification data
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_NotificationData $data
     */
    public function setNotificationData(Space48_BarclaysPartnerFinance_Soap_Client_NotificationData $data)
    {
        $this->notificationData = $data;
        return $this;
    }
}
