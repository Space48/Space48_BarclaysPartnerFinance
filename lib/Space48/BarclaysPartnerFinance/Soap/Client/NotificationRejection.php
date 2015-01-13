<?php

class Space48_BarclaysPartnerFinance_Soap_Client_NotificationRejection
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $Reason;
    
    /**
     * @var string
     */
    public $ProposalID;
    
    /**
     * @var string
     */
    public $AgreementNumber;
    
    /**
     * @var string
     */
    public $ClientReference;
    
    /**
     * get value
     *
     * @return string
     */
    public function getReason()
    {
        return $this->Reason;
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
    public function getAgreementNumber()
    {
        return $this->AgreementNumber;
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
