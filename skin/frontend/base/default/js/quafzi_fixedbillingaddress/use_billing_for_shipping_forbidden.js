jQuery(document).ready(function () {
    //Billing step
    jQuery('#billing:use_for_shipping_yes').prop('checked', false)(); //uncheck "Ship to this address"
    jQuery('#billing:use_for_shipping_yes').hide();
    jQuery('#billing:use_for_shipping_no').prop('checked', true)(); //check "Ship to different address"
    jQuery('#billing:use_for_shipping_no').hide();

    //Shipping step
    jQuery('#shipping:same_as_billing').prop('checked', false)(); //uncheck "Use billing address"
    jQuery('#shipping:same_as_billing').hide();
});