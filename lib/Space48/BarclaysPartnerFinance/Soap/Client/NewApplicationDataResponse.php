<?php

class Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataResponse
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_Errors
     */
    public $Errors;
    
    /**
     * @var string
     */
    public $Token;
    
    /**
     * @var string
     */
    public $ProposalID;
    
    /**
     * @var string
     */
    public $ClientReference;
    
    /**
     * get
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_Errors
     */
    protected function _getErrors()
    {
        return $this->Errors;
    }
    
    /**
     * has errors
     *
     * @return bool
     */
    public function hasErrors()
    {
        $errors = $this->_getErrors();
        
        if ( ! $errors ) {
            return false;
        }
        
        return $errors->hasErrors();
    }
    
    /**
     * return array of errors
     *
     * @return array
     */
    public function getErrors()
    {
        if ( ! $this->hasErrors() ) {
            return array();
        }
        
        $errors = $this->_getErrors();
        
        if ( ! $errors ) {
            return array();
        }
        
        return $errors->getErrors();
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getToken()
    {
        return $this->Token;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getProposalId()
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
}
