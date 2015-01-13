<?php

class Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShort
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataShort
     */
    public $newApplicationDataShort;
    
    /**
     * set new application data short
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataShort $data
     */
    public function setNewApplicationDataShort(Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataShort $data)
    {
        $this->newApplicationDataShort = $data;
        return $this;
    }
    
    /**
     * get new application data short
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataShort
     */
    public function getNewApplicationDataShort()
    {
        return $this->newApplicationDataShort;
    }
}
