<?php

class AnattaDesign_AwesomeCheckout_Block_Onepage_Progress extends Mage_Checkout_Block_Onepage_Progress {

	public function _beforeToHtml() {
		$section = $this->getRequest()->getParam( 'section', false );
		switch( $section ) {
			case 'shipping':
				$this->getCheckout()->setStepData( 'shipping', 'complete', false );
			case 'billing':
				$this->getCheckout()->setStepData( 'billing', 'complete', false );
			case 'payment':
				$this->getCheckout()->setStepData( 'payment', 'complete', false );
				$this->getCheckout()->setStepData( 'shipping', 'complete', true );
		}
	}

	public function getActive() {
		if( Mage::helper( 'anattadesign_awesomecheckout' )->isVirtualOnly() ) {
			$active = $this->getRequest()->getParam( 'section', 'billing' );
		} else {
			$active = $this->getRequest()->getParam( 'section', 'shipping' );
		}

		return $active;
	}

	public function getShippingAddressHtml() {
		$address = $this->getShipping();
		$data = array(
			Mage::helper( 'anattadesign_awesomecheckout' )->getFullname( $address ),
			$address->getStreetFull(),
			$address->getCity() . ', ' . $address->getCountryModel()->getIso3Code() . ' ' . $address->getPostcode()
		);

		return join( '<br/>', $data );
	}

}