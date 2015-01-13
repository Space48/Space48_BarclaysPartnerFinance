<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ProposalShort
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $ClientReference;
    
    /**
     * @var float
     */
    public $CashPrice;
    
    /**
     * set
     *
     * @param string $ref
     */
    public function setClientReference($ref)
    {
        $this->ClientReference = $ref;
        return $this;
    }
    
    /**
     * set
     *
     * @param float $price
     */
    public function setCashPrice($price)
    {
        $this->CashPrice = $price;
        return $this;
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
     * @return float
     */
    public function getCashPrice()
    {
        return $this->CashPrice;
    }
    
}
