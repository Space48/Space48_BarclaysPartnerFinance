<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfErrorDetail
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * error detail
     *
     * @var array
     */
    public $ErrorDetail;
    
    /**
     * get error detail
     *
     * @return array
     */
    public function getErrorDetail()
    {
        return $this->ErrorDetail;
    }
}

