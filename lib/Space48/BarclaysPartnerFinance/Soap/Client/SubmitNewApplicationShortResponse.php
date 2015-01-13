<?php

class Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShortResponse
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataResponse
     */
    public $SubmitNewApplicationShortResult;
    
    /**
     * get submit new application short result
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataResponse
     */
    public function getSubmitNewApplicationShortResult()
    {
        return $this->SubmitNewApplicationShortResult;
    }
    
    /**
     * alias for "getSubmitNewApplicationShortResult"
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataResponse
     */
    public function getResult()
    {
        return $this->getSubmitNewApplicationShortResult();
    }
}
