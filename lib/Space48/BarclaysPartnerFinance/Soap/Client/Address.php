<?php

class Space48_BarclaysPartnerFinance_Soap_Client_Address
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $HouseNumber;
    
    /**
     * @var string
     */
    public $HouseName;
    
    /**
     * @var string
     */
    public $Flat;
    
    /**
     * @var string
     */
    public $Street;
    
    /**
     * @var string
     */
    public $District;
    
    /**
     * @var string
     */
    public $Town;
    
    /**
     * @var string
     */
    public $County;
    
    /**
     * @var string
     */
    public $Postcode;
    
    /**
     * set
     *
     * @param string $value
     */
    public function setHouseNumber($value)
    {
        $this->HouseNumber = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setHouseName($value)
    {
        $this->HouseName = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setFlat($value)
    {
        $this->Flat = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setStreet($value)
    {
        $this->Street = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setDistrict($value)
    {
        $this->District = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setTown($value)
    {
        $this->Town = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setCounty($value)
    {
        $this->County = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setPostcode($value)
    {
        $this->Postcode = $value;
        return $this;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getHouseNumber()
    {
        return $this->HouseNumber;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getHouseName()
    {
        return $this->HouseName;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getFlat()
    {
        return $this->Flat;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->Street;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getDistrict()
    {
        return $this->District;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getTown()
    {
        return $this->Town;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getCounty()
    {
        return $this->County;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->Postcode;
    }
    
}
