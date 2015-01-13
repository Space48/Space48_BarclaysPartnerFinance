<?php
/**
 * this class is not mapped because there are
 * elements and complext types with the same
 * name which cause issues. therefore this
 * is a custom made class to allow calling
 * the proposal enquiry service.
 */
class Space48_BarclaysPartnerFinance_Soap_Client_SubmitProposalEnquiry
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData
     */
    public $proposalEnquiryData;
    
    /**
     * set proposal enquiry data
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData $data
     */
    public function setProposalEnquiryData(Space48_BarclaysPartnerFinance_Soap_Client_ProposalEnquiryData $data)
    {
        $this->proposalEnquiryData = $data;
        return $this;
    }
}
