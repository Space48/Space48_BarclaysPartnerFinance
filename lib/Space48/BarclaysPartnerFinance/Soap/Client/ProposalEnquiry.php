<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiry
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $Status;
    
    /**
     * @var bool
     */
    public $IsParked;
    
    /**
     * get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->Status;
    }
    
    /**
     * get status
     *
     * @return bool
     */
    public function getIsParked()
    {
        return $this->IsParked;
    }
    
    /**
     * set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->Status = $status;
        return $this;
    }
    
    /**
     * set is parked
     *
     * @param bool $parked
     */
    public function setIsParked($parked)
    {
        $this->IsParked = (bool) $parked;
        return $this;
    }
}

