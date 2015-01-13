<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ChecklistCondition
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $Status;
    
    /**
     * @var boolean
     */
    public $Satisfied;
    
    /**
     * @var string
     */
    public $SatisfiedOn;
    
    /**
     * @var string
     */
    public $Type;
    
    /**
     * get value
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->Status;
    }
    
    /**
     * get value
     *
     * @return bool
     */
    public function getSatisfied()
    {
        return $this->Satisfied;
    }
    
    /**
     * get value
     *
     * @return string
     */
    public function getSatisfiedOn()
    {
        return $this->SatisfiedOn;
    }
    
    /**
     * get satisfied on timestamp
     *
     * @return int
     */
    public function getSatisfiedOnTimestamp()
    {
        // get date
        $date = $this->getSatisfiedOn();
        
        // if we haven't got a date,
        // this has not been satisfied
        if ( ! $date ) {
            return 0;
        }
        
        // create date from format
        $date = DateTime::createFromFormat('d/m/Y', $date);
        
        // must be DateTime object
        if ( ! $date ) {
            return 0;
        }
        
        // we don't need the time
        $date->setTime(0, 0, 0);
        
        // get timestamp
        return $date->getTimestamp();
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
    
    /**
     * set status
     *
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->Status = $status;
        return $this;
    }
    
    /**
     * set satisfied
     *
     * @param bool $satisfied
     */
    public function setSatisfied($satisfied)
    {
        $this->Satisfied = (bool) $satisfied;
        return $this;
    }
    
    /**
     * set satisfied on date
     *
     * @param string $date d/m/Y
     */
    public function setSatisfiedOn($date)
    {
        $this->SatisfiedOn = $date;
        return $this;
    }
    
    /**
     * set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->Type = $type;
        return $this;
    }
}
