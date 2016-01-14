<?php

/**
 * @category   Customer
 * @package    Quafzi_FixedBillingAddress
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 * @author     Thomas Birke <tbirke@netextreme.de>
 * @author     Ingo Fabbri <if@newtown.at>
 */
class Quafzi_FixedBillingAddress_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function isBillingAddressFixed()
    {
        $isAdmin = Mage::getSingleton('admin/session')->isLoggedIn();
        $hasBillingAddress = $this->_hasBillingAddress();
        $isChangeable = (bool)(int)Mage::getStoreConfig('customer/address/change_billing_allowed');

        return (false === $isAdmin && false === $isChangeable && true === $hasBillingAddress);
    }

    public function isShippingAddressFixed()
    {
        $isAdmin = Mage::getSingleton('admin/session')->isLoggedIn();
        $hasShippingAddress = $this->_hasShippingAddress();
        $isChangeable = (bool)(int)Mage::getStoreConfig('customer/address/change_shipping_allowed');

        return (false === $isAdmin && false === $isChangeable && true === $hasShippingAddress);
    }

    public function isBillingAddressSelectable()
    {
        $isAdmin = Mage::getSingleton('admin/session')->isLoggedIn();
        $hasBillingAddress = $this->_hasBillingAddress();
        $isSelectable = (bool)(int)Mage::getStoreConfig('customer/address/select_billing_allowed') && !(bool)(int)Mage::getStoreConfig('customer/address/change_billing_allowed');

        return (false === $isAdmin && true === $isSelectable && true === $hasBillingAddress);
    }

    public function isShippingAddressSelectable()
    {
        $isAdmin = Mage::getSingleton('admin/session')->isLoggedIn();
        $hasShippingAddress = $this->_hasShippingAddress();
        $isSelectable = (bool)(int)Mage::getStoreConfig('customer/address/select_shipping_allowed') && !(bool)(int)Mage::getStoreConfig('customer/address/change_shipping_allowed');

        return (false === $isAdmin && true === $isSelectable && true === $hasShippingAddress);
    }

    public function canUseBillingAddressForShipping()
    {
        $isAdmin = Mage::getSingleton('admin/session')->isLoggedIn();
        $isForbidden = (bool)(int)Mage::getStoreConfig('customer/address/use_billing_for_shipping_forbidden');

        return (false === $isAdmin && false === $isForbidden);
    }

    public function isCreateOrModifyAdditionalAddressAllowed()
    {
        $isAdmin = Mage::getSingleton('admin/session')->isLoggedIn();
        $isAllowed = (bool)(int)Mage::getStoreConfig('customer/address/create_modify_additional_address_allowed');

        return (false === $isAdmin && true === $isAllowed);
    }

    public function isDeleteAdditionalAddressAllowed()
    {
        $isAdmin = Mage::getSingleton('admin/session')->isLoggedIn();
        $isAllowed = (bool)(int)Mage::getStoreConfig('customer/address/delete_additional_address_allowed');

        return (false === $isAdmin && true === $isAllowed);
    }

    /**
     * if customer already has a billing address
     *
     * @return bool
     */
    protected function _hasBillingAddress()
    {
        return (bool)$this->_getCustomer()->getDefaultBilling();
    }

    /**
     * if customer already has a shipping address
     *
     * @return bool
     */
    protected function _hasShippingAddress()
    {
        return (bool)$this->_getCustomer()->getDefaultShipping();
    }

    /**
     * get current user
     *
     * @return Mage_Customer_Model_Customer
     */
    protected function _getCustomer()
    {
        return Mage::getSingleton('customer/session')->getCustomer();
    }
}
