<?php

class Space48_BarclaysPartnerFinance_Soap_Client_ArrayOfChecklistCondition
    extends Space48_BarclaysPartnerFinance_Soap_Client_Abstract
{
    /**
     * checklist conditions
     *
     * @var array
     */
    public $ChecklistCondition;
    
    /**
     * get conditions
     *
     * @return array
     */
    public function getChecklistCondition()
    {
        return $this->ChecklistCondition;
    }
    
    /**
     * alias to "getChecklistCondition"
     *
     * @return array
     */
    public function getChecklistConditions()
    {
        return $this->getChecklistCondition();
    }
    
    /**
     * add checklist condition
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_ChecklistCondition $condition [description]
     */
    public function addChecklistCondition(Space48_BarclaysPartnerFinance_Soap_Client_ChecklistCondition $condition)
    {
        // must be an array
        if ( is_null($this->ChecklistCondition) ) {
            $this->ChecklistCondition = array();
        }
        
        // append to array
        $this->ChecklistCondition[] = $condition;
        
        return $this;
    }
    
    /**
     * alias for "addChecklistCondition"
     *
     * @param Space48_BarclaysPartnerFinance_Soap_Client_ChecklistCondition $condition [description]
     */
    public function addCondition(Space48_BarclaysPartnerFinance_Soap_Client_ChecklistCondition $condition)
    {
        return $this->addChecklistCondition($condition);
    }
}

