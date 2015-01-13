<?php

class Space48_BarclaysPartnerFinance_Model_Application_Address extends Mage_Core_Model_Abstract
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
        $this->_init('space48_bpf/application_address');
    }
    
    /**
     * load by application
     *
     * @param  int|Space48_BarclaysPartnerFinance_Model_Application $application
     *
     * @return $this
     */
    public function loadByApplication($application)
    {
        $this->getResource()->loadByApplication($this, $application);
        return $this;
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
     * set address response object
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_Address $address
     */
    public function setAddressResponseObject(Space48_BarclaysPartnerFinance_Soap_Client_Address $address)
    {
        $this->setHouseNumber(  $address->getHouseNumber()  );
        $this->setHouseName(    $address->getHouseName()    );
        $this->setFlat(         $address->getFlat()         );
        $this->setStreet(       $address->getStreet()       );
        $this->setDistrict(     $address->getDistrict()     );
        $this->setTown(         $address->getTown()         );
        $this->setCounty(       $address->getCounty()       );
        $this->setPostcode(     $address->getPostcode()     );
        
        return $this;
    }
}
