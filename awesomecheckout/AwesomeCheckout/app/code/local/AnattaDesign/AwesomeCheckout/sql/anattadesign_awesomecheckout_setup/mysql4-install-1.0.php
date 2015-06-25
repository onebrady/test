<?php

$installer = $this;
$installer->startSetup();

Mage::getModel( 'adminnotification/inbox' )
		->setSeverity( Mage_AdminNotification_Model_Inbox::SEVERITY_NOTICE )
		->setTitle( 'The "Awesome Checkout" extension has been installed successfully.' )
		->setDateAdded( gmdate( 'Y-m-d H:i:s' ) )
		->setUrl( 'http://www.awesomecheckout.com' )
		->setDescription( 'The "Awesome Checkout" extension has been installed successfully. You can configure this extension from: System / Configuration / ANATTA DESIGN / Awesome Checkout' )
		->save();

$installer->endSetup();

Mage::helper( 'anattadesign_awesomecheckout' )->ping();