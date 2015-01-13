<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_Errors
     */
    public $Errors;
    
    /**
     * @var string
     */
    public $ProposalID;
    
    /**
     * @var string
     */
    public $ClientReference;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiry
     */
    public $ProposalStatus;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_Address
     */
    public $CustomerAddress;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfSnag
     */
    public $Snags;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfChecklistCondition
     */
    public $ChecklistConditions;
    
    /**
     * @var string
     */
    public $Notes;
    
    /**
     * get
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_Errors
     */
    public function getErrors()
    {
        return $this->Errors;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getProposalID()
    {
        return $this->ProposalID;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getClientReference()
    {
        return $this->ClientReference;
    }
    
    /**
     * get
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiry
     */
    public function getProposalStatus()
    {
        return $this->ProposalStatus;
    }
    
    /**
     * get actual status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->getProposalStatus()->getStatus();
    }
    
    /**
     * get
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_Address
     */
    public function getCustomerAddress()
    {
        return $this->CustomerAddress;
    }
    
    /**
     * get
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfSnag
     */
    public function getSnags()
    {
        $snags = $this->Snags;
        
        if ( ! $snags ) {
            return array();
        }
        
        $snags = $snags->getSnags();
        
        if ( ! $snags || ! count($snags) ) {
            return array();
        }
        
        return $snags;
    }
    
    /**
     * get
     *
     * @return array
     */
    public function getChecklistConditions()
    {
        $conditions = $this->ChecklistConditions;
        
        if ( ! $conditions ) {
            return array();
        }
        
        $conditions = $conditions->getChecklistConditions();
        
        if ( ! $conditions || ! count($conditions) ) {
            return array();
        }
        
        return $conditions;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getNotes()
    {
        return $this->Notes;
    }
}
