<?php

class AnattaDesign_AwesomeCheckout_Block_Onepage extends Mage_Checkout_Block_Onepage_Abstract {

	public function getSteps() {
		$steps = array( );

		if ( Mage::helper( 'anattadesign_awesomecheckout' )->isVirtualOnly() ) {
			$stepCodes = array( 'billing', 'payment', 'review' );

			// Show billing step first
			$this->getCheckout()->setStepData( 'billing', 'allow', true );
		} else {
			$stepCodes = array( 'shipping', 'shipping_method', 'payment', 'review' );

			// Show shipping step first
			$this->getCheckout()->setStepData( 'shipping', 'allow', true );
		}

		foreach ( $stepCodes as $step ) {
			$steps[$step] = $this->getCheckout()->getStepData( $step );
		}

		return $steps;
	}

	public function getActiveStep() {
		if ( Mage::helper( 'anattadesign_awesomecheckout' )->isVirtualOnly() ) {
			return 'billing';
		}
		return 'shipping';
	}

}