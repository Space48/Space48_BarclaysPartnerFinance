<?php

class Space48_BarclaysPartnerFinance_Soap_Client_Delivery
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $DeliveryAddress;
    
    /**
     * @var string
     */
    public $DeliveryOption;
    
    /**
     * set delivery address
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_Address $address
     */
    public function setDeliveryAddress(Space48_BarclaysPartnerFinance_Soap_Client_Address $address)
    {
        $this->DeliveryAddress = $address;
        return $this;
    }
    
    /**
     * get delivery address
     *
     * @return Space48_BarclaysPartnerFinance_Soap_Client_Address
     */
    public function getDeliveryAddress()
    {
        return $this->DeliveryAddress;
    }
    
    /**
     * set delivery option
     *
     * @param string $option
     */
    public function setDeliveryOption($option)
    {
        $this->DeliveryOption = $option;
        return $this;
    }
    
    /**
     * get delivery option
     *
     * @return string
     */
    public function getDeliveryOption()
    {
        return $this->DeliveryOption;
    }
}
