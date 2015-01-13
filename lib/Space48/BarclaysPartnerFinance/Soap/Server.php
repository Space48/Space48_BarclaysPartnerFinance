<?php

class Space48_BarclaysPartnerFinance_Soap_Server extends SoapServer
{
    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct($this->_getServerWsdlPath(), array(
            'soap_version' => $this->_getServerSoapVersion(),
            'cache_wsdl'   => $this->_getServerCacheWsdl(),
            'features'     => $this->_getServerFeatures(),
            'classmap'     => $this->_getServerClassmap(),
        ));
    }
    
    /**
     * get client wsdl
     *
     * @return string
     */
    protected function _getServerWsdlPath()
    {
        return Mage::getBaseDir().DS.'app'.DS.'code'.DS.'community'.DS.'Space48'.DS.'BarclaysPartnerFinance'.DS.'misc'.DS.'wsdl.xml';
    }
    
    /**
     * get class map
     */
    protected function _getServerClassmap()
    {
        return array(
            'Address'                   => 'Space48_BarclaysPartnerFinance_Soap_Server_Address',
            'ArrayOfChecklistCondition' => 'Space48_BarclaysPartnerFinance_Soap_Server_ArrayOfChecklistCondition',
            'ArrayOfSnag'               => 'Space48_BarclaysPartnerFinance_Soap_Server_ArrayOfSnag',
            'Callback'                  => 'Space48_BarclaysPartnerFinance_Soap_Server_Callback',
            'CallbackResponse'          => 'Space48_BarclaysPartnerFinance_Soap_Server_CallbackResponse',
            'CallbackResult'            => 'Space48_BarclaysPartnerFinance_Soap_Server_CallbackResult',
            'ChecklistCondition'        => 'Space48_BarclaysPartnerFinance_Soap_Server_ChecklistCondition',
            'ProposalEnquiry'           => 'Space48_BarclaysPartnerFinance_Soap_Server_ProposalEnquiry',
            'Snag'                      => 'Space48_BarclaysPartnerFinance_Soap_Server_Snag',
        );
    }
    
    /**
     * get client features
     *
     * @return string
     */
    protected function _getServerFeatures()
    {
        return SOAP_SINGLE_ELEMENT_ARRAYS;
    }
    
    /**
     * get client soap version
     *
     * @return string
     */
    protected function _getServerSoapVersion()
    {
        return SOAP_1_1;
    }
    
    /**
     * get cache mechanism
     *
     * @return string
     */
    protected function _getServerCacheWsdl()
    {
        // return WSDL_CACHE_NONE;
        // return WSDL_CACHE_DISK;
        // return WSDL_CACHE_MEMORY;
        return WSDL_CACHE_BOTH;
    }
}
