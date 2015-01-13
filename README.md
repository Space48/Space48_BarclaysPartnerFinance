Space48_BarclaysPartnerFinance
==============================

Description
-----------
The enables the store to allow payment via Barclays Partner Finance.

We present a new payment method that once selected forwards the user to the Barclays website to complete a finance application form.

The module also manages the order process as per the Barclays Partner Finance order flow.

Requirements
------------
- PHP >= 5.3.0
- Mage_Core


Compatibility
-------------
- Magento CE >= 1.9
- Magento EE >= 1.13

May also be compatible with older versions too, however this should be subject to testing.

Installation Instructions
-------------------------
Just copy and place the contents of this respository into your Magento root folder.

Be mindful that app/code/community/Space48/BarclaysPartnerFinance/misc/efinance258.wsdl and app/code/community/Space48/BarclaysPartnerFinance/misc/wsdl.local.xml do not exist. You need to create a symbolic link in your environment for the relative files:

    app/code/community/Space48/BarclaysPartnerFinance/misc/efinance258.local.wsdl
    app/code/community/Space48/BarclaysPartnerFinance/misc/efinance258.production.wsdl
    app/code/community/Space48/BarclaysPartnerFinance/misc/efinance258.staging.wsdl

    app/code/community/Space48/BarclaysPartnerFinance/misc/wsdl.local.wsdl
    app/code/community/Space48/BarclaysPartnerFinance/misc/wsdl.production.wsdl
    app/code/community/Space48/BarclaysPartnerFinance/misc/wsdl.staging.wsdl

Uninstallation
--------------
For now, its best just to disable the payment gateway in the system configuration until we can confirm that an uninstallation will not cause issues for legacy orders.


Copyright
---------
(c) 2015 Space48
