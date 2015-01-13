<?php

class Space48_BarclaysPartnerFinance_Soap_Client_Note
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * @var string
     */
    public $NoteText;
    
    /**
     * @var string
     */
    public $DateTime;
    
    /**
     * @var string
     */
    public $User;
    
    /**
     * @var string
     */
    public $Type;
    
    /**
     * get value
     *
     * @return string
     */
    public function getNoteText()
    {
        return $this->NoteText;
    }
    
    /**
     * get value
     *
     * @return string
     */
    public function getDateTime()
    {
        return $this->DateTime;
    }
    
    /**
     * get value
     *
     * @return string
     */
    public function getUser()
    {
        return $this->User;
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
