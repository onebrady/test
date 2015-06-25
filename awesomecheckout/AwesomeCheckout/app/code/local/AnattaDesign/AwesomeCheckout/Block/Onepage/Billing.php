<?php

class AnattaDesign_AwesomeCheckout_Block_Onepage_Billing extends Mage_Checkout_Block_Onepage_Billing {

	/**
	 * Get quote billing address
	 *
	 * @return Mage_Sales_Model_Quote_Address
	 */
	public function getAddress() {
		return $this->getQuote()->getBillingAddress();
	}

	public function getCountryOptions() {
		$options = false;
		$useCache = Mage::app()->useCache( 'config' );
		if ( $useCache ) {
			$cacheId = 'DIRECTORY_COUNTRY_SELECT_STORE_' . Mage::app()->getStore()->getCode();
			$cacheTags = array( 'config' );
			if ( $optionsCache = Mage::app()->loadCache( $cacheId ) ) {
				$options = unserialize( $optionsCache );
			}
		}

		if ( $options == false ) {
			$options = $this->getCountryCollection()->toOptionArray( FALSE );
			if ( $useCache ) {
				Mage::app()->saveCache( serialize( $options ), $cacheId, $cacheTags );
			}
		}
		return $options;
	}

}