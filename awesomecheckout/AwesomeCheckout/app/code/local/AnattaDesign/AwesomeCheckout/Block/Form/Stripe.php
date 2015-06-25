<?php

class AnattaDesign_Awesomecheckout_Block_Form_Stripe extends Radweb_Stripe_Block_Form
{
    /**
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('anattadesign/awesomecheckout/stripe/form.phtml');
    }

}

?>