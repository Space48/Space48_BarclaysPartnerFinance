<?php

class Space48_BarclaysPartnerFinance_Model_Application_Snag extends Mage_Core_Model_Abstract
{
    /**
     * @var Space48_BarclaysPartnerFinance_Model_Application
     */
    protected $_application;
    
    /**
     * construct
     */
    protected function _construct()
    {
        $this->_init('space48_bpf/application_snag');
    }
    
    /**
     * set application
     *
     * @param Space48_BarclaysPartnerFinance_Model_Application $application
     */
    public function setApplication(Space48_BarclaysPartnerFinance_Model_Application $application)
    {
        $this->_application = $application;
        $this->setApplicationId($application->getId());
        return $this;
    }
    
    /**
     * get application
     *
     * @return Space48_BarclaysPartnerFinance_Model_Application
     */
    public function getApplication()
    {
        // instantiate model if is null
        if ( is_null( $this->_application ) ) {
            $this->_application = Mage::getModel('space48_bpf/application');
        }
        
        // if model is not loaded...
        if ( ! $this->_application->getId() ) {
            // ...and we have an id...
            if ( $id = $this->getApplicationId() ) {
                // ... then load it
                $this->_application->load($id);
            }
        }
        
        return $this->_application;
    }
    
    /**
     * apply checklist response object to model
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_Snag $checklist
     */
    public function applySnagObject(Space48_BarclaysPartnerFinance_Soap_Client_Snag $snag)
    {
        $this->setDescription( $snag->getDescription() );
        $this->setNote(        $snag->getNote()        );
        $this->setType(        $snag->getType()        );
        return $this;
    }
}
