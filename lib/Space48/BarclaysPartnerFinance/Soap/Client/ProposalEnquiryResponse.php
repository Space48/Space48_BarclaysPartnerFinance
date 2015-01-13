<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponse
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData
     */
    public $ProposalEnquiryResult;
    
    /**
     * get proposal enquiry result
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData
     */
    public function getProposalEnquiryResult()
    {
        if ( ! ( $this->ProposalEnquiryResult instanceof Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData ) ) {
            $data = new Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData();
            
            foreach (get_object_vars($this->ProposalEnquiryResult) as $key => $value) {
                if ( $key != 'ProposalEnquiryResult') {
                    $data->$key = $value;
                }
            }
            
            $this->ProposalEnquiryResult = $data;
        }
        
        return $this->ProposalEnquiryResult;
    }
    
    /**
     * set proposal enquiry response object
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $result
     */
    public function setProposalEnquiryResult(Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $result)
    {
        $this->ProposalEnquiryResult = $result;
        return $this;
    }
    
    /**
     * alias for "getProposalEnquiryResult"
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData
     */
    public function getResult()
    {
        return $this->getProposalEnquiryResult();
    }
    
    /**
     * alias to "setProposalEnquiryResult"
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $result
     */
    public function setResult(Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryResponseData $result)
    {
        return $this->setProposalEnquiryResult($result);
    }
}
