<?php

/**
 * @category   Customer
 * @package    Quafzi_FixedBillingAddress
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Thomas Birke <tbirke@netextreme.de>
 * @author     Ingo Fabbri <if@newtown.at>
 */
class Quafzi_FixedBillingAddress_Model_Customer_Address extends Mage_Customer_Model_Address
{
    public function setIsDefaultBilling($value)
    {
        if (false === $this->_isBillingFixed()) {
            parent::setIsDefaultBilling($value);
        }

        return $this;
    }

    public function setIsDefaultShipping($value)
    {
        if (false === $this->_isShippingFixed()) {
            parent::setIsDefaultShipping($value);
        }

        return $this;
    }

    protected function _isBillingFixed()
    {
        return Mage::helper('quafzi_fixedbillingaddress/data')->isBillingAddressFixed();
    }

    protected function _isShippingFixed()
    {
        return Mage::helper('quafzi_fixedbillingaddress/data')->isShippingAddressFixed();
    }
}
