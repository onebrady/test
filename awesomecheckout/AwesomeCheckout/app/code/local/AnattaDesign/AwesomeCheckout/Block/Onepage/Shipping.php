<?php

class AnattaDesign_AwesomeCheckout_Block_Onepage_Shipping extends Mage_Checkout_Block_Onepage_Shipping {

	protected $_addressId;

	/**
	 * Get address from quote, get by address id or determine by GeoIP
	 *
	 * @return Mage_Sales_Model_Quote_Address
	 */
	public function getAddress() {
		$session = Mage::getSingleton( 'customer/session' );
		$address = null;

		if ( $session->isLoggedIn() ) {
			if ( $this->_addressId ) {
				$address = $session->getCustomer()->getAddressById( $this->_addressId );
			}
			if ( !$address ) {
				$address = $session->getCustomer()->getDefaultShippingAddress();
			}
		}

		if ( !$address ) {
			$address = $this->getQuote()->getShippingAddress();
			// Ignore default country(System/Configuration/General/Countries Options/Default Country) and use one from GeoIP
			$geoip = Mage::helper( 'anattadesign_awesomecheckout' )->getGeoipRecord();
			if ( $geoip ) {
				$address->setCountryId( $geoip->country_code );
			}
		}

		return $address;
	}

	/**
	 * Set address id
	 *
	 * @param int $id
	 * @return AnattaDesign_AwesomeCheckout_Block_Onepage_Shipping
	 */
	public function setAddressId( $id ) {
		$this->_addressId = (int) $id;
		return $this;
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

	public function getCountryHtmlSelect( $type ) {
		$countryId = $this->getAddress()->getCountryId();
		if ( is_null( $countryId ) ) {
			$countryId = Mage::helper( 'core' )->getDefaultCountry();
		}
		$select = $this->getLayout()->createBlock( 'core/html_select' )->setName( $type . '[country_id]' )->setId( $type . ':country_id' )->setTitle( Mage::helper( 'checkout' )->__( 'Country' ) )->setClass( 'validate-select' )->setValue( $countryId )->setOptions( $this->getCountryOptions() );

		return $select->getHtml();
	}

}