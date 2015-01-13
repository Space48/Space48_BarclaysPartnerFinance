<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials
     */
    public $UserCredentials;
    
    /**
     * @var string
     */
    public $ProposalID;
    
    /**
     * @var string
     */
    public $ClientReference;
    
    /**
     * set user credentials
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $value
     */
    public function setUserCredentials(Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $value)
    {
        $this->UserCredentials = $value;
        return $this;
    }
    
    /**
     * set value
     *
     * @param string $value
     */
    public function setProposalID($value)
    {
        $this->ProposalID = $value;
        return $this;
    }
    
    /**
     * set value
     *
     * @param string $value
     */
    public function setClientReference($value)
    {
        $this->ClientReference = $value;
        return $this;
    }
    
    /**
     * get value
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials
     */
    public function getUserCredentials()
    {
        return $this->UserCredentials;
    }
    
    /**
     * get value
     *
     * @return string
     */
    public function getProposalID()
    {
        return $this->ProposalID;
    }
    
    /**
     * get value
     *
     * @return string
     */
    public function getClientReference()
    {
        return $this->ClientReference;
    }
}
