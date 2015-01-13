<?php

class Space48_BarclaysPartnerFinance_Model_Resource_Application extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * construct
     */
    protected function _construct()
    {
        $this->_init('space48_bpf/application', 'application_id');
    }
    
    /**
     * Perform actions before object save
     *
     * @param Varien_Object $object
     * @return Mage_Core_Model_Resource_Db_Abstract
     */
    protected function _beforeSave(Mage_Core_Model_Abstract $object)
    {
        // get current timestamp
        $now = Mage::helper('space48_bpf')->now();
        
        // set updated at now
        $object->setUpdatedAt($now);
        
        // if no created at date, then
        // this is new, set it to now
        if ( ! $object->getCreatedAt() ) {
            $object->setCreatedAt($now);
        }
        
        // return parent response
        return parent::_beforeSave($object);
    }
    
    /**
     * purge snags
     *
     * @return $this
     */
    public function purgeSnags(Space48_BarclaysPartnerFinance_Model_Application $application)
    {
        if ( ! $application->getId() ) {
            return $this;
        }
        
        $table = $this->getTable('space48_bpf/application_snag');
        $this->_getWriteAdapter()->delete($table, array('application_id = ?' => $application->getId()));
        
        return $this;
    }
}
