<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfNote
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * note
     *
     * @var array
     */
    public $Note;
    
    /**
     * get notes
     *
     * @return array
     */
    public function getNote()
    {
        return $this->Note;
    }
    
    public function getNotes()
    {
        return $this->getNote();
    }
}

