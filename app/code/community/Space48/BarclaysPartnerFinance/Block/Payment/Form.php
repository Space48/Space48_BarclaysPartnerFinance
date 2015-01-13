<?php

class Space48_BarclaysPartnerFinance_Block_Payment_Form extends Mage_Payment_Block_Form
{
    /**
     * constructor
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('space48/bpf/payment/form.phtml');
    }
}
