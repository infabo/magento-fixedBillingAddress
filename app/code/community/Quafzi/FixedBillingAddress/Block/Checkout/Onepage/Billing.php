<?php

class Quafzi_FixedBillingAddress_Block_Checkout_Onepage_Billing extends Mage_Checkout_Block_Onepage_Billing
{
    public function getAddressesHtmlSelect($type)
    {
        if ($this->isCustomerLoggedIn()) {
            if ('billing' !== $type
                || false === Mage::helper('quafzi_fixedbillingaddress/data')->isBillingAddressFixed()
            ) {
                return parent::getAddressesHtmlSelect($type);
            }

            if (Mage::helper('quafzi_fixedbillingaddress')->isBillingAddressSelectable()) {
                $options = array();
                foreach ($this->getCustomer()->getAddresses() as $address) {
                    $options[] = array(
                        'value' => $address->getId(),
                        'label' => $address->format('oneline')
                    );
                }

                $addressId = $this->getAddress()->getCustomerAddressId();
                if (empty($addressId)) {
                    $address = $this->getCustomer()->getPrimaryBillingAddress();
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
                $selectId = 'billing-address-select';
                $js = '<script type="text/javascript">$("' . $selectId . '").parentElement.previousElementSibling.hide()</script>';

                return '<input id="' . $selectId . '" type="hidden" value="' . $this->getAddress()->getAddressId() . '">'
                . $this->_getBillingAddressHtml() . $js;
            }
        }

        return '';
    }

    protected function _getBillingAddressHtml()
    {
        $address = $this->getCustomer()->getPrimaryBillingAddress();
        if ($address instanceof Varien_Object) {
            return $address->format('html');
        }
    }
}
