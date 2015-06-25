<?php

class AnattaDesign_AwesomeCheckout_Block_GiftMessage_Message_Inline extends Mage_GiftMessage_Block_Message_Inline {

	protected function _construct() {
		parent::_construct();
		$this->setTemplate('anattadesign/awesomecheckout/onepage/giftmessage/inline.phtml');
	}
}