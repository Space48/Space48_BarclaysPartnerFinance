<?php

class Space48_BarclaysPartnerFinance_Model_Observer_Email extends Space48_BarclaysPartnerFinance_Model_Observer_Abstract
{
    const ACCEPTED_EMAIL  = 'accepted_email';
    const REFERRED_EMAIL  = 'referred_email';
    const DECLINED_EMAIL  = 'declined_email';
    const CANCELLED_EMAIL = 'cancelled_email';
    
    /**
     * can send email
     *
     * @param  string $email
     *
     * @return bool
     */
    protected function _canSend($email, Mage_Sales_Model_Order $order)
    {
        $canSend = $this->_getConfig("{$email}_send", $order->getStoreId());
        
        if ( ! $canSend ) {
            return false;
        }
        
        if ( ( $canSend * 1 ) < 1 ) {
            return false;
        }
        
        if ( ! $this->_getTemplate($email, $order) ) {
            return false;
        }
        
        return true;
    }
    
    /**
     * get email template
     *
     * @param  string $email
     *
     * @return string
     */
    protected function _getTemplate($email, Mage_Sales_Model_Order $order)
    {
        return $this->_getConfig("{$email}_template", $order->getStoreId());
    }
    
    /**
     * get sender details
     *
     * @return array
     */
    protected function _getSenderDetails(Mage_Sales_Model_Order $order)
    {
        return array(
            'sender_name'  => Mage::getStoreConfig('trans_email/ident_support/name', $order->getStoreId()),
            'sender_email' => Mage::getStoreConfig('trans_email/ident_support/email', $order->getStoreId()),
        );
    }
    
    /**
     * get recipients
     *
     * @param  string $email
     *
     * @return array
     */
    protected function _getRecipients($email, Mage_Sales_Model_Order $order)
    {
        $recipients = $this->_getConfig("{$email}_recipients", $order->getStoreId());
        
        if ( ! $recipients ) {
            return array();
        }
        
        $recipients = explode(PHP_EOL, $recipients);
        
        $return = array();
        
        foreach ( $recipients as $recipient ) {
            if ( Zend_Validate::is($recipient, 'EmailAddress') ) {
                $return[] = $recipient;
            }
        }
        
        return $return;
    }
    
    /**
     * get customer email address
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return string
     */
    protected function _getEmailAddress(Mage_Sales_Model_Order $order)
    {
        return $order->getCustomerEmail();
    }
    
    /**
     * get email name
     *
     * @param  Mage_Sales_Model_Order $order
     *
     * @return string
     */
    protected function _getEmailName(Mage_Sales_Model_Order $order)
    {
        $prefix     = $order->getCustomerPrefix();
        $firstname  = $order->getCustomerFirstname();
        $middlename = $order->getCustomerMiddlename();
        $lastname   = $order->getCustomerLastname();
        $suffix     = $order->getCustomerSuffix();
        
        $name = "";
        $name .= $prefix     ? $prefix . ' ' : '';
        $name .= $firstname  ? ucfirst($firstname) . ' ' : '';
        $name .= $middlename ? ucfirst($middlename) . ' ' : '';
        $name .= $lastname   ? ucfirst($lastname) . ' ' : '';
        $name .= $suffix     ? $suffix . ' ' : '';
        
        return trim($name);
    }
    
    /**
     * send email
     *
     * @param  string $email
     * @param  Mage_Sales_Model_Order $order
     *
     * @return $this
     */
    protected function _sendEmail($email, Mage_Sales_Model_Order $order)
    {
        // if sending of accepted emails is turned off then nothing
        // to do
        if ( ! $this->_canSend($email, $order) ) {
            return $this;
        }
        
        // init model
        $template = Mage::getModel('core/email_template');
        
        // load default
        $template->loadDefault( $this->_getTemplate($email, $order) );
        
        // add sender details
        $template->addData( $this->_getSenderDetails($order) );
        
        // add all recipients (bcc)
        foreach ( $this->_getRecipients($email, $order) as $bcc ) {
            $template->addBcc($bcc);
        }
        
        // send email
        $template->send(
            $this->_getEmailAddress($order),
            $this->_getEmailName($order),
            array(
                'order' => $order,
                'store' => $order->getStore(),
            )
        );
        
        return $this;
    }
    
    /**
     * send application accepted email
     * 
     * listens to "space48_bpf_proposal_enquiry_update_status_after"
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function sendApplicationAcceptedEmail(Varien_Event_Observer $observer)
    {
        $order = $this->_getOrderFromObserver($observer);
        $transport = $this->_getTransportFromObserver($observer);
        $application = $this->_helper()->getApplicationFromOrder($order);
        
        if ( $application->getSentAcceptedEmail() ) {
            return $this;
        }
        
        switch ( $transport->getState() ) {
            case Mage_Sales_Model_Order::STATE_PENDING_PAYMENT:
            case Mage_Sales_Model_Order::STATE_PROCESSING:
            case Mage_Sales_Model_Order::STATE_COMPLETE:
                // do nothing
            break;
            default:
                return $this;
            break;
        }
        
        switch ( $transport->getStatus() ) {
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACCEPTED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_TO_DELIVER:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_READY_FOR_LIVE:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_ACTIVE:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_LIVE:
                // do nothing
            break;
            default:
                return $this;
            break;
        }
        
        try {
            $this->_sendEmail(self::ACCEPTED_EMAIL, $order);
        } catch (Exception $e) {
            // do nothing, fail silently
        }
        
        // update application
        $application->sentAcceptedEmail();
        
        return $this;
    }
    
    /**
     * send application referred email
     * 
     * listens to "space48_bpf_proposal_enquiry_update_status_after"
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function sendApplicationReferredEmail(Varien_Event_Observer $observer)
    {
        $order = $this->_getOrderFromObserver($observer);
        $transport = $this->_getTransportFromObserver($observer);
        $application = $this->_helper()->getApplicationFromOrder($order);
        
        if ( $application->getSentReferredEmail() ) {
            return $this;
        }
        
        if ( $transport->getState() != Mage_Sales_Model_Order::STATE_PENDING_PAYMENT ) {
            return $this;
        }
        
        if ( $transport->getStatus() != Space48_BarclaysPartnerFinance_Model_Application::STATUS_REFERRED ) {
            return $this;
        }
        
        try {
            $this->_sendEmail(self::REFERRED_EMAIL, $order);
        } catch (Exception $e) {
            // do nothing, fail silently
        }
        
        // update application
        $application->sentReferredEmail();
        
        return $this;
    }
    
    /**
     * send application declined email
     * 
     * listens to "space48_bpf_proposal_enquiry_update_status_after"
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function sendApplicationDeclinedEmail(Varien_Event_Observer $observer)
    {
        $order = $this->_getOrderFromObserver($observer);
        $transport = $this->_getTransportFromObserver($observer);
        $application = $this->_helper()->getApplicationFromOrder($order);
        
        if ( $application->getSentDeclinedEmail() ) {
            return $this;
        }
        
        if ( $transport->getState() != Mage_Sales_Model_Order::STATE_CANCELED ) {
            return $this;
        }
        
        if ( $transport->getStatus() != Space48_BarclaysPartnerFinance_Model_Application::STATUS_DECLINED ) {
            return $this;
        }
        
        try {
            $this->_sendEmail(self::DECLINED_EMAIL, $order);
        } catch (Exception $e) {
            // do nothing, fail silently
        }
        
        // update application
        $application->sentDeclinedEmail();
        
        return $this;
    }
    
    /**
     * send application cancelled email
     * 
     * listens to "space48_bpf_proposal_enquiry_update_status_after"
     *
     * @param  Varien_Event_Observer $observer
     *
     * @return $this
     */
    public function sendApplicationCancelledEmail(Varien_Event_Observer $observer)
    {
        $order = $this->_getOrderFromObserver($observer);
        $transport = $this->_getTransportFromObserver($observer);
        $application = $this->_helper()->getApplicationFromOrder($order);
        
        if ( $application->getSentCancelledEmail() ) {
            return $this;
        }
        
        if ( $transport->getState() != Mage_Sales_Model_Order::STATE_CANCELED ) {
            return $this;
        }
        
        switch ( $transport->getStatus() ) {
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_NOT_TAKEN_UP:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_BPF_CANCELLED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_CUSTOMER_CANCELLED:
            case Space48_BarclaysPartnerFinance_Model_Application::STATUS_THIRD_PARTY_CANCELLED:
            break;
            default:
                return $this;
            break;
        }
        
        try {
            $this->_sendEmail(self::CANCELLED_EMAIL, $order);
        } catch (Exception $e) {
            // do nothing, fail silently
        }
        
        // update application
        $application->sentCancelledEmail();
        
        return $this;
    }
}
