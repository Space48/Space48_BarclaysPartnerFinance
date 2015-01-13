<?php

class Space48_BarclaysPartnerFinance_Soap_Client_Snag
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $Description;
    
    /**
     * @var string
     */
    public $Note;
    
    /**
     * @var string
     */
    public $Type;
    
    
    /**
     * get value
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->Description;
    }
    
    /**
     * get value
     *
     * @return string
     */
    public function getNote()
    {
        return $this->Note;
    }
    
    /**
     * get value
     *
     * @return string
     */
    public function getType()
    {
        return $this->Type;
    }
}
