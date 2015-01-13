<?php

class Space48_BarclaysPartnerFinance_Soap_Client_Customer
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $Title;
    
    /**
     * @var string
     */
    public $Forename;
    
    /**
     * @var string
     */
    public $Initial;
    
    /**
     * @var string
     */
    public $Surname;
    
    /**
     * @var string
     */
    public $EmailAddress;
    
    /**
     * set
     *
     * @param string $value
     */
    public function setTitle($value)
    {
        $this->Title = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setForename($value)
    {
        $this->Forename = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setInitial($value)
    {
        $this->Initial = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setSurname($value)
    {
        $this->Surname = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setEmailAddress($value)
    {
        $this->EmailAddress = $value;
        return $this;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->Title;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getForename()
    {
        return $this->Forename;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getInitial()
    {
        return $this->Initial;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->Surname;
    }
    
    /**
     * get
     *
     * @return string
     */
    public function getEmailAddress()
    {
        return $this->EmailAddress;
    }
}
