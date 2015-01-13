<?php

class Space48_BarclaysPartnerFinance_Soap_Client_Notification
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $ClientReference;
    
    /**
     * @var string
     */
    public $BalanceToFinance;
    
    /**
     * @var string
     */
    public $ProposalID;
    
    /**
     * @var string
     */
    public $AgreementNumber;
    
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
     * set value
     *
     * @param string $value
     */
    public function setBalanceToFinance($value)
    {
        $this->BalanceToFinance = $value;
        return $this;
    }
    
    /**
     * set value
     *
     * @param string $value
     */
    public function setProposalId($value)
    {
        $this->ProposalID = $value;
        return $this;
    }
    
    /**
     * set value
     *
     * @param string $value
     */
    public function setAgreementNumber($value)
    {
        $this->AgreementNumber = $value;
        return $this;
    }
}
