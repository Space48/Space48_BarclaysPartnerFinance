<?php

class Space48_BarclaysPartnerFinance_Model_Resource_Application_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * construct
     */
    protected function _construct()
    {
        $this->_init('space48_bpf/application');
    }
}
