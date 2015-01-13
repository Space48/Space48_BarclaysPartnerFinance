<?php

class Space48_BarclaysPartnerFinance_Soap_Client_TypeOfGoods
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $Description;
    
    /**
     * @var string
     */
    public $Quantity;
    
    /**
     * @var string
     */
    public $Type;
    
    /**
     * set
     *
     * @param string $value
     */
    public function setDescription($value)
    {
        $this->Description = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setQuantity($value)
    {
        $this->Quantity = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setType($value)
    {
        $this->Type = $value;
        return $this;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getQuantity()
    {
        return $this->Quantity;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }
}
