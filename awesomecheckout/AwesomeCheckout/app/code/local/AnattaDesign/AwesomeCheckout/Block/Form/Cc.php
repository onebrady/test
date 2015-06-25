<?php

class AnattaDesign_AwesomeCheckout_Block_Form_Cc extends Mage_Payment_Block_Form_Cc {

	protected function _construct() {
		parent::_construct();

		// Only replace the template on frontend side else we lose the ability to place orders from magento admin (The condition we are using doesn't work for all pages example like Magento connect pages, but definitely works in our context)
		if ( ! Mage::app()->getStore()->isAdmin() )
			$this->setTemplate( 'anattadesign/awesomecheckout/onepage/payment/form/cc.phtml' );
	}

}