<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ErrorDetail
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $Code;
    
    /**
     * @var string
     */
    public $Message;
    
    /**
     * get
     *
     * @return string
     */
    public function getCode()
    {
        return $this->Code;
    }
    /**
     * get
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->Message;
    }
    
    /**
     * get full message
     *
     * @return string
     */
    public function getFullMessage()
    {
        return $this->getCode().': '.$this->getMessage();
    }
}

