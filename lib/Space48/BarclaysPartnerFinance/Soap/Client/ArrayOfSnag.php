<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfSnag
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * error detail
     *
     * @var array
     */
    public $Snag;
    
    /**
     * get snags
     *
     * @return array
     */
    public function getSnag()
    {
        return $this->Snag;
    }
    
    /**
     * alias for "getSnag"
     *
     * @return array
     */
    public function getSnags()
    {
        return $this->getSnag();
    }
}

