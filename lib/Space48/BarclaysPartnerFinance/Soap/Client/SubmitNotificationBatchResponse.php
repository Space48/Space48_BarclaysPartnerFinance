<?php

class Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatchResponse
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * notifications
     *
     * @var Space48_BarclaysPartnerFinance_Soap_Client_NotificationResponse
     */
    public $SubmitNotificationBatchResult;
    
    /**
     * get submit notification batch result
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_NotificationResponse
     */
    public function getSubmitNotificationBatchResult()
    {
        return $this->SubmitNotificationBatchResult;
    }
    
    /**
     * alias for "getSubmitNotificationBatchResult()"
     *
     * @return NotificationResponse
     */
    public function getResult()
    {
        return $this->getSubmitNotificationBatchResult();
    }
}
