<?php

/**
 * Magento edition helper for determining if the current magento install is an Enterprise, Professional or Community Edition.
 *
 * This class was initially taken from an external source whose link has been provided here but may also have some modifications to the actual source.
 *
 * @source https://gist.github.com/jayelkaake/1541793
 */
class AnattaDesign_AwesomeCheckout_Helper_Edition extends Mage_Core_Helper_Abstract {

	/**
	 * True if the version of Magento currently being run is Enterprise Edition, false otherwise
	 *
	 * @return boolean
	 */
	public function isMageEnterprise() {
		return Mage::getConfig()->getModuleConfig( 'Enterprise_Enterprise' ) && Mage::getConfig()->getModuleConfig( 'Enterprise_AdminGws' ) && Mage::getConfig()->getModuleConfig( 'Enterprise_Checkout' ) && Mage::getConfig()->getModuleConfig( 'Enterprise_Customer' );
	}


	/**
	 * True if the version of Magento currently being run is Professional Edition, false otherwise
	 *
	 * @return boolean
	 */
	public function isMageProfessional() {
		return Mage::getConfig()->getModuleConfig( 'Enterprise_Enterprise' ) && !Mage::getConfig()->getModuleConfig( 'Enterprise_AdminGws' ) && !Mage::getConfig()->getModuleConfig( 'Enterprise_Checkout' ) && !Mage::getConfig()->getModuleConfig( 'Enterprise_Customer' );
	}



	/**
	 * True if the version of Magento currently being run is Community Edition, false otherwise
	 *
	 * @return boolean
	 */
	public function isMageCommunity() {
		return !$this->isMageEnterprise() && !$this->isMageProfessional();
	}

	public function isExtensionEnabled( $name ) {
		$modules = (array) Mage::getConfig()->getNode( 'modules' )->children();
		return in_array( $name, array_keys( $modules ) ) && $modules[ $name ]->is( 'active' );
	}
}