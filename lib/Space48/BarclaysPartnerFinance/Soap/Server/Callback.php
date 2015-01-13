<?php

class Space48_BarclaysPartnerFinance_Soap_Server_Callback
    extends Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData
{
    /**
     * @var int
     */
    public $ProposalID;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Server_ProposalEnquiry
     */
    public $ProposalStatus;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Server_Address
     */
    public $CustomerAddress;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Server_ArrayOfSnag
     */
    public $Snags;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Server_ArrayOfChecklistCondition
     */
    public $ChecklistConditions;
    
    /**
     * @var string
     */
    public $ClientReference;
    
    
    /**
     * set value
     *
     * @param $value
     */
    public function setProposalID($value)
    {
        $this->ProposalID = $value;
        return $this;
    }
    
    /**
     * set status
     *
     * @param $status
     */
    public function setProposalStatus(Space48_BarclaysPartnerFinance_Soap_Server_ProposalEnquiry $status)
    {
        $this->ProposalStatus = $status;
        return $this;
    }
    
    /**
     * set address
     *
     * @param $address
     */
    public function setCustomerAddress(Space48_BarclaysPartnerFinance_Soap_Server_Address $address)
    {
        $this->CustomerAddress = $address;
        return $this;
    }
    
    /**
     * set snags
     *
     * @param $snags
     */
    public function setSnags(Space48_BarclaysPartnerFinance_Soap_Server_ArrayOfSnag $snags)
    {
        $this->Snags = $snags;
        return $this;
    }
    
    /**
     * set conditions
     *
     * @param $conditions
     */
    public function setChecklistConditions(Space48_BarclaysPartnerFinance_Soap_Server_ArrayOfChecklistCondition $conditions)
    {
        $this->ChecklistConditions = $conditions;
        return $this;
    }
    
    /**
     * set reference
     *
     * @param $reference
     */
    public function setClientReference($reference)
    {
        $this->ClientReference = $reference;
        return $this;
    }
}
