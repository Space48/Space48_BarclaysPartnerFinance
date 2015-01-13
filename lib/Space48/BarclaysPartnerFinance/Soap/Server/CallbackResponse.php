<?php

class Space48_BarclaysPartnerFinance_Soap_Server_CallbackResponse
    extends Space48_BarclaysPartnerFinance_Soap_Server_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Server_CallbackResult
     */
    public $CallbackResult;
    
    /**
     * set callback result
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Server_CallbackResult $result
     */
    public function setCallbackResult(Space48_BarclaysPartnerFinance_Soap_Server_CallbackResult $result)
    {
        $this->CallbackResult = $result;
        return $this;
    }
    
    /**
     * get callback result
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Server_CallbackResult
     */
    public function getCallbackResult()
    {
        return $this->CallbackResult;
    }
    
    /**
     * alias for "setCallbackResult"
     */
    public function setResult(Space48_BarclaysPartnerFinance_Soap_Server_CallbackResult $result)
    {
        return $this->setCallbackResult($result);
    }
    
    /**
     * alias for "getCallbackResult"
     */
    public function getResult()
    {
        return $this->getCallbackResult();
    }
}

