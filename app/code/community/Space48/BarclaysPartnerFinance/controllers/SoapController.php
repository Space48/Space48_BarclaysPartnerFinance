<?php

class Space48_BarclaysPartnerFinance_SoapController extends Space48_BarclaysPartnerFinance_Controller_Front_Abstract
{
    /**
     * update action
     *
     * @return void
     */
    public function updateAction()
    {
        $server = new Space48_BarclaysPartnerFinance_Soap_Server();
        $server->setClass('Space48_BarclaysPartnerFinance_Model_Soap');
        $server->handle();
    }
}
