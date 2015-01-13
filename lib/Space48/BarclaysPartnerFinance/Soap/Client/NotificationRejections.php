<?php

class Space48_BarclaysPartnerFinance_Soap_Client_NotificationRejections
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var array
     */
    public $Rejection;
    
    /**
     * @var int
     */
    public $NumberOfRejections;
    
    /**
     * get rejections
     *
     * @return array
     */
    public function getRejection()
    {
        return $this->Rejection;
    }
    
    /**
     * alias for "getRejection"
     *
     * @return array
     */
    public function getRejections()
    {
        return $this->getRejection();
    }
    
    /**
     * get number of rejections
     *
     * @return int
     */
    public function getNumberOfRejections()
    {
        return $this->NumberOfRejections;
    }
}
