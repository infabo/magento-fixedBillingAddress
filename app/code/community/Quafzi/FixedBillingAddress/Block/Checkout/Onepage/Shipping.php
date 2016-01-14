<?php

/**
 * This file is part of Quafzi_FixedBillingAddress for Magento.
 *
 * @package     Quafzi_FixedBillingAddress
 * @copyright   Copyright (c) 2016 Newtown-Web OG (http://www.newtown.at)
 * @author      Ingo Fabbri <if@newtown.at>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Quafzi_FixedBillingAddress_Block_Checkout_Onepage_Shipping extends Mage_Checkout_Block_Onepage_Shipping
{
    public function getAddressesHtmlSelect($type)
    {
        if ($this->isCustomerLoggedIn()) {
            if ('shipping' !== $type
                || false === Mage::helper('quafzi_fixedbillingaddress/data')->isShippingAddressFixed()
            ) {
                return parent::getAddressesHtmlSelect($type);
            }

            if (Mage::helper('quafzi_fixedbillingaddress')->isShippingAddressSelectable()) {
                $options = array();
                foreach ($this->getCustomer()->getAddresses() as $address) {
                    $options[] = array(
                        'value' => $address->getId(),
                        'label' => $address->format('oneline')
                    );
                }

                $addressId = $this->getAddress()->getCustomerAddressId();
                if (empty($addressId)) {
                    $address = $this->getCustomer()->getPrimaryShippingAddress();
                    if ($address) {
                        $addressId = $address->getId();
                    }
                }

                $select = $this->getLayout()->createBlock('core/html_select')
                    ->setName($type . '_address_id')
                    ->setId($type . '-address-select')
                    ->setClass('address-select')
                    ->setExtraParams('onchange="' . $type . '.newAddress(!this.value)"')
                    ->setValue($addressId)
                    ->setOptions($options);

                return $select->getHtml();
            } else {
                $selectId = $type . '-address-select';
                $js = '<script type="text/javascript">$("' . $selectId . '").parentElement.previousElementSibling.hide()</script>';

                return '<input id="' . $selectId . '" type="hidden" value="' . $this->getAddress()->getAddressId() . '">'
                . $this->_getShippingAddressHtml() . $js;
            }
        }

        return '';
    }

    protected function _getShippingAddressHtml()
    {
        $address = $this->getCustomer()->getPrimaryShippingAddress();
        if ($address instanceof Varien_Object) {
            return $address->format('html');
        }
    }
}