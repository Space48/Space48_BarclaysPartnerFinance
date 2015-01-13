<?php

class Space48_BarclaysPartnerFinance_Soap_Client extends SoapClient
{
    /**
     * constructor
     */
    public function __construct()
    {
        parent::__construct($this->_getClientWsdlPath(), array(
            'soap_version' => $this->_getClientSoapVersion(),
            'cache_wsdl'   => $this->_getClientCacheWsdl(),
            'features'     => $this->_getClientFeatures(),
            'classmap'     => $this->_getClientClassmap(),
        ));
    }
    
    /**
     * get client wsdl
     *
     * @return string
     */
    protected function _getClientWsdlPath()
    {
        return Mage::getBaseDir().DS.'app'.DS.'code'.DS.'community'.DS.'Space48'.DS.'BarclaysPartnerFinance'.DS.'misc'.DS.'efinance258.wsdl';
    }
    
    /**
     * get class map
     */
    protected function _getClientClassmap()
    {
        return array(
            'Address'                           => 'Space48_BarclaysPartnerFinance_Soap_Client_Address',
            'ArrayOfChecklistCondition'         => 'Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfChecklistCondition',
            'ArrayOfErrorDetail'                => 'Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfErrorDetail',
            'ArrayOfNote'                       => 'Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfNote',
            'ArrayOfSnag'                       => 'Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfSnag',
            'ChecklistCondition'                => 'Space48_BarclaysPartnerFinance_Soap_Client_ChecklistCondition',
            'Customer'                          => 'Space48_BarclaysPartnerFinance_Soap_Client_Customer',
            'Delivery'                          => 'Space48_BarclaysPartnerFinance_Soap_Client_Delivery',
            'ErrorDetail'                       => 'Space48_BarclaysPartnerFinance_Soap_Client_ErrorDetail',
            'Errors'                            => 'Space48_BarclaysPartnerFinance_Soap_Client_Errors',
            'NewApplicationDataResponse'        => 'Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataResponse',
            'NewApplicationDataShort'           => 'Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataShort',
            'Note'                              => 'Space48_BarclaysPartnerFinance_Soap_Client_Note',
            'Notification'                      => 'Space48_BarclaysPartnerFinance_Soap_Client_Notification',
            'NotificationBatch'                 => 'Space48_BarclaysPartnerFinance_Soap_Client_NotificationBatch',
            'NotificationData'                  => 'Space48_BarclaysPartnerFinance_Soap_Client_NotificationData',
            'NotificationRejection'             => 'Space48_BarclaysPartnerFinance_Soap_Client_NotificationRejection',
            'NotificationRejections'            => 'Space48_BarclaysPartnerFinance_Soap_Client_NotificationRejections',
            'NotificationResponse'              => 'Space48_BarclaysPartnerFinance_Soap_Client_NotificationResponse',
            'ProposalEnquiry'                   => 'Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiry',
            'ProposalEnquiryData'               => 'Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData',
            'ProposalEnquiryResponse'           => 'Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponse',
            'ProposalShort'                     => 'Space48_BarclaysPartnerFinance_Soap_Client_ProposalShort',
            'Snag'                              => 'Space48_BarclaysPartnerFinance_Soap_Client_Snag',
            'SubmitNewApplicationShort'         => 'Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShort',
            'SubmitNewApplicationShortResponse' => 'Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShortResponse',
            'SubmitNotificationBatch'           => 'Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatch',
            'SubmitNotificationBatchResponse'   => 'Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatchResponse',
            'TypeOfGoods'                       => 'Space48_BarclaysPartnerFinance_Soap_Client_TypeOfGoods',
            'UserCredentials'                   => 'Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials',
        );
    }
    
    /**
     * get client features
     *
     * @return string
     */
    protected function _getClientFeatures()
    {
        return SOAP_SINGLE_ELEMENT_ARRAYS;
    }
    
    /**
     * get client soap version
     *
     * @return string
     */
    protected function _getClientSoapVersion()
    {
        return SOAP_1_1;
    }
    
    /**
     * get cache mechanism
     *
     * @return string
     */
    protected function _getClientCacheWsdl()
    {
        // return WSDL_CACHE_NONE;
        // return WSDL_CACHE_DISK;
        // return WSDL_CACHE_MEMORY;
        return WSDL_CACHE_BOTH;
    }
    
    /******************************************************\
     * Below lie service calls
    \******************************************************/
    
    /**
     * submit new application short
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShort $params
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShortResponse
     */
    public function callSubmitNewApplicationShort(Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShort $params)
    {
        return $this->__soapCall('SubmitNewApplicationShort', array('parameters' => $params));
    }
    
    /**
     * call proposal enquiry
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_SubmitProposalEnquiry $params
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponse
     */
    public function callProposalEnquiry(Space48_BarclaysPartnerFinance_Soap_Client_SubmitProposalEnquiry $params)
    {
        return $this->__soapCall('ProposalEnquiry', array('parameters' => $params));
    }
    
    /**
     * call submit notification batch
     *
     * @param  Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatch $params
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_NotificationBatchResponse
     */
    public function callSubmitNotificationBatch(Space48_BarclaysPartnerFinance_Soap_Client_SubmitNotificationBatch $params)
    {
        return $this->__soapCall('SubmitNotificationBatch', array('parameters' => $params));
    }
}
