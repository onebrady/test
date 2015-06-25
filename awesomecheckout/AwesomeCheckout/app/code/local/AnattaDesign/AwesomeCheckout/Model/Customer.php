<?php

class AnattaDesign_AwesomeCheckout_Model_Customer extends Mage_Customer_Model_Customer {

	const EXCEPTION_INVALID_EMAIL = 4;
	const EXCEPTION_INVALID_PASSWORD = 5;

	/**
	 * Authenticate customer
	 *
	 * @param  string $login
	 * @param  string $password
	 * @throws Mage_Core_Exception
	 * @return true
	 *
	 */
	public function authenticate( $login, $password ) {
		$this->loadByEmail( $login );
		if ( $this->getConfirmation() && $this->isConfirmationRequired() ) {
			throw Mage::exception( 'Mage_Core', Mage::helper( 'customer' )->__( 'This account is not confirmed.' ), self::EXCEPTION_EMAIL_NOT_CONFIRMED
			);
		}
		if ( !$this->getEmail() ) {
			throw Mage::exception( 'Mage_Core', Mage::helper( 'customer' )->__( 'Invalid email.' ), self::EXCEPTION_INVALID_EMAIL
			);
		}
		if ( !$this->validatePassword( $password ) ) {
			throw Mage::exception( 'Mage_Core', Mage::helper( 'customer' )->__( 'Invalid password.' ), self::EXCEPTION_INVALID_PASSWORD
			);
		}
		Mage::dispatchEvent( 'customer_customer_authenticated', array(
			'model' => $this,
			'password' => $password,
		) );

		return true;
	}

}