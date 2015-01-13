<?php

class Space48_BarclaysPartnerFinance_Soap_Client_Errors
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $ErrorDetails;
    
    /**
     * @var bool
     */
    public $IsError;
    
    /**
     * get
     *
     * @return string
     */
    public function getErrorDetails()
    {
        return $this->ErrorDetails;
    }
    
    /**
     * get
     *
     * @return bool
     */
    public function hasErrors()
    {
        $errors = $this->getErrors();
        
        if ( ! $errors ) {
            return false;
        }
        
        if ( ! count($errors) ) {
            return false;
        }
        
        return true;
    }
    
    /**
     * get errors
     *
     * @return array
     */
    public function getErrors()
    {
        return $this->getErrorDetails()->getErrorDetail();
    }
}
