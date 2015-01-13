<?php

class Space48_BarclaysPartnerFinance_Block_Payment_Info extends Mage_Payment_Block_Info
{
    /**
     * constructor
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('space48/bpf/payment/info.phtml');
    }
    
    /**
     * to pdf
     *
     * @return string
     */
    public function toPdf()
    {
        $this->setTemplate('space48/bpf/payment/pdf/info.phtml');
        return $this->toHtml();
    }
}
