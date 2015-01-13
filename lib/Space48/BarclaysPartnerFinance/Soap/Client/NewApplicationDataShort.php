<?php

class Space48_BarclaysPartnerFinance_Soap_Client_NewApplicationDataShort
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials
     */
    public $UserCredentials;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_ProposalShort
     */
    public $ProposalShort;
    
    /**
     * @var array
     */
    public $Goods = array();
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_Customer
     */
    public $Customer;
    
    /**
     * @var Space48_BarclaysPartnerFinance_Soap_Client_Address
     */
    public $Address;
    
    /**
     * add typeofgood good
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_TypeOfGoods $good
     */
    public function addTypeOfGoods(Space48_BarclaysPartnerFinance_Soap_Client_TypeOfGoods $good)
    {
        $this->Goods[] = $good;
        return $this;
    }
    
    /**
     * add goods array
     *
     * @param array $goods
     */
    public function addTypeOfGoodsArray(array $goods)
    {
        foreach ( $goods as $good ) {
            $this->addTypeOfGoods($good);
        }
        
        return $this;
    }
    
    /**
     * set user credentials
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $credentials
     */
    public function setUserCredentials(Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials $credentials)
    {
        $this->UserCredentials = $credentials;
        return $this;
    }
    
    /**
     * set proposal
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_ProposalShort $proposal
     */
    public function setProposalShort(Space48_BarclaysPartnerFinance_Soap_Client_ProposalShort $proposal)
    {
        $this->ProposalShort = $proposal;
        return $this;
    }
    
    /**
     * set customer
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_Customer $customer
     */
    public function setCustomer(Space48_BarclaysPartnerFinance_Soap_Client_Customer $customer)
    {
        $this->Customer = $customer;
        return $this;
    }
    
    /**
     * set address
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_Address $address
     */
    public function setAddress(Space48_BarclaysPartnerFinance_Soap_Client_Address $address)
    {
        $this->Address = $address;
        return $this;
    }
}


