<?php

class AnattaDesign_AwesomeCheckout_Model_Paypal_Config extends Mage_Paypal_Model_Config {

	/**
	 * BN code getter
	 * override method
	 *
	 * @param string $countryCode ISO 3166-1
	 */
	public function getBuildNotationCode($countryCode = null) {
		if (Mage::helper('anattadesign_awesomecheckout/edition')->isMageEnterprise()) {
			$newBnCode = 'AnattaDesign_SI_MagentoEE';
		} elseif (Mage::helper('anattadesign_awesomecheckout/edition')->isMageCommunity()) {
			$newBnCode = 'AnattaDesign_SI_MagentoCE';
		} else{
			$newBnCode = 'AnattaDesign_SI_Custom';
		}
		//if you would like to retain the product and country code
		//E.g., Company_Test_EC_US
		//$bnCode = parent::getBuildNotationCode($countryCode);
		//$newBnCode = str_replace('Varien_Cart','Prjoect_Test',$bnCode);
		return $newBnCode;
	}

}
