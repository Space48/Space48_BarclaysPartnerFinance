<?php

class Space48_BarclaysPartnerFinance_IndexController extends Space48_BarclaysPartnerFinance_Controller_Front_Abstract
{
    /**
     * redirect action
     *
     * @return void
     */
    public function redirectAction()
    {
        try {
            // get order
            $order = $this->_getOrder();
            
            // application
            $application = Mage::getModel('space48_bpf/application')->init($order);
            
            // to carry data from/to event
            $transport = new Varien_Object();
            
            // dispatch event
            Mage::dispatchEvent('space48_bpf_new_application', array(
                'application' => $application,
                'order'       => $order,
                'transport'   => $transport,
            ));
            
            // get response from transport
            $response = $transport->getResponse();
            
            // throw exception if no response object
            if ( ! ( $response instanceof Space48_BarclaysPartnerFinance_Soap_Client_SubmitNewApplicationShortResponse ) ) {
                $this->_exception('Invalid response object.');
            }
            
            // get result from response
            $result = $response->getResult();
            
            // check if response has errors
            if ( ! $result->hasErrors() ) {
                
                // get token
                $token      = $result->getToken();
                $proposalId = $result->getProposalId();
                
                // store information in application
                $application
                  ->setToken($token)
                  ->setProposalId($proposalId)
                  ->save();
                
                // add history comment
                $order->addStatusHistoryComment('<b>(BPF)</b> Awaiting user to complete finance application.');
                $order->save();
                
                // send new order email before redirecting
                $order->sendNewOrderEmail();
                
                // get the redirect url
                $url = $application->getRedirectUrl();
                
                // redirect to url
                $this->_redirectUrl($url);
                
                return;
            } else {
                // at this point we have errors
                $errors = $result->getErrors();
                
                $message = '<b>(BPF Error)</b>';
                
                // add status history
                foreach ( $errors as $error ) {
                    $message .= '<br />'.$error->getFullMessage();
                }
                
                // save order
                $order->addStatusHistoryComment($message);
                $order->save();
                
                // throw exception
                $this->_exception('Response has errors, please view order log.');
            }
        } catch (Exception $e) {
            // log the exception
            $this->_helper()->logException($e);
            
            // add error message
            $this->_addError('An unknown error occured, please try again later.');
            
            // check if customer logged in
            if ( $this->_getCustomerSession()->isLoggedIn() ) {
                // redirect to home
                $this->_redirect('customer/account/index');
            } else {
                // redirect to home
                $this->_redirect('/');
            }
        }
    }
}
