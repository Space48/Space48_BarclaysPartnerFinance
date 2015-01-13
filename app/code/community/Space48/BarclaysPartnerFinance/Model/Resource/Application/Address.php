<?php

class Space48_BarclaysPartnerFinance_Model_Resource_Application_Address extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * construct
     */
    protected function _construct()
    {
        $this->_init('space48_bpf/application_address', 'address_id');
    }
    
    /**
     * load by application/application id
     * 
     * @param  Space48_BarclaysPartnerFinance_Model_Application_Address $address
     * @param  int|Space48_BarclaysPartnerFinance_Model_Application $application
     *
     * @return $this
     */
    public function loadByApplication(Space48_BarclaysPartnerFinance_Model_Application_Address $address, $application)
    {
        // get application id
        $applicationId = $application instanceof Space48_BarclaysPartnerFinance_Model_Application
            ? $application->getId()
            : $application;
        
        // application id should be numeric
        if ( ! is_numeric($applicationId) ) {
            return $this;
        }

        $read = $this->_getReadAdapter();
        
        if ( $read ) {
            $table = $this->getMainTable();
            $applicationField = $read->quoteIdentifier(sprintf('%s.%s', $table, 'application_id'));
            
            $select = $read->select()
                ->from($table)
                ->where($applicationField . ' = ?', $applicationId);
            
            $data = $read->fetchRow($select);

            if ( $data ) {
                $address->setData($data);
            }
        }

        $this->unserializeFields($address);
        
        $this->_afterLoad($address);

        return $this;
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
}
