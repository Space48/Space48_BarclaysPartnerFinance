<?php

class Space48_BarclaysPartnerFinance_Soap_Client_UserCredentials
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $LoginName;
    
    /**
     * @var string
     */
    public $Password;
    
    /**
     * set
     *
     * @param string $value
     */
    public function setLoginName($value)
    {
        $this->LoginName = $value;
        return $this;
    }
    
    /**
     * set
     *
     * @param string $value
     */
    public function setPassword($value)
    {
        $this->Password = $value;
        return $this;
    }
    
    /**
     * get
     *
     * @return string 
     */
    public function getLoginName()
    {
        return $this->LoginName;
    }
    
    /**
     * get
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->Password;
    }
}
