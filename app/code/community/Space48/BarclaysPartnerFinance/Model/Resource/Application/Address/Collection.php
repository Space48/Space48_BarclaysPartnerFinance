<?php

class Space48_BarclaysPartnerFinance_Model_Resource_Application_Checklist_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * construct
     */
    protected function _construct()
    {
        $this->_init('space48_bpf/application_checklist');
    }
    
    /**
     * set application filter
     *
     * @param int|Space48_BarclaysPartnerFinance_Model_Application $application
     */
    public function setApplicationFilter($application)
    {
        // get application id
        $applicationId = $application instanceof Space48_BarclaysPartnerFinance_Model_Application
            ? $application->getId()
            : $application;
        
        if ( $applicationId ) {
            $this->getSelect()->where('application_id = ?', $applicationId);
        }
        
        return $this;
    }
}
