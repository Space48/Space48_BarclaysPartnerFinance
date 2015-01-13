<?php

class Space48_BarclaysPartnerFinance_Model_Resource_Application_Checklist extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * construct
     */
    protected function _construct()
    {
        $this->_init('space48_bpf/application_checklist', 'checklist_id');
    }
    
    /**
     * load by application/application id and type/type string
     * 
     * @param  Space48_BarclaysPartnerFinance_Model_Application_Checklist $checklist
     * @param  int|Space48_BarclaysPartnerFinance_Model_Application $application
     * @param  int|Space48_BarclaysPartnerFinance_Soap_Client_ChecklistCondition $type
     *
     * @return $this
     */
    public function loadByApplicationAndType(Space48_BarclaysPartnerFinance_Model_Application_Checklist $checklist, $application, $type)
    {
        // get application id
        $applicationId = $application instanceof Space48_BarclaysPartnerFinance_Model_Application
            ? $application->getId()
            : $application;
        
        // get type id
        $typeId = $type instanceof Space48_BarclaysPartnerFinance_Soap_Client_ChecklistCondition
            ? $type->getType()
            : $type;
        
        // application id should be numeric
        if ( ! is_numeric($applicationId) ) {
            return $this;
        }
        
        // type id should be something
        if ( ! $typeId ) {
            return $this;
        }

        $read = $this->_getReadAdapter();
        
        if ( $read ) {
            $table = $this->getMainTable();
            $applicationField = $read->quoteIdentifier(sprintf('%s.%s', $table, 'application_id'));
            $typeField = $read->quoteIdentifier(sprintf('%s.%s', $table, 'type'));
            
            $select = $read->select()
                ->from($table)
                ->where($applicationField . ' = ?', $applicationId)
                ->where($typeField . ' = ?', $typeId);
            
            $data = $read->fetchRow($select);

            if ( $data ) {
                $checklist->setData($data);
            }
        }

        $this->unserializeFields($checklist);
        
        $this->_afterLoad($checklist);

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
