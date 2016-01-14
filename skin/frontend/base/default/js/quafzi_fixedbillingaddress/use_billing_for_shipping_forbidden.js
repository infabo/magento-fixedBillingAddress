jQuery(document).ready(function () {
    //Billing step
    jQuery('#billing\\:use_for_shipping_yes').prop('checked', false); //uncheck "Ship to this address"
    jQuery('#billing\\:use_for_shipping_yes').hide(); //hide radio
    jQuery("label[for='billing\\:use_for_shipping_yes']").remove(); //remove the according label element

    jQuery('#billing\\:use_for_shipping_no').prop('checked', true); //check "Ship to different address"
    jQuery('#billing\\:use_for_shipping_no').hide(); //hide radio
    jQuery("label[for='billing\\:use_for_shipping_no']").remove(); //remove the according label element

    //Shipping step
    jQuery('#shipping\\:same_as_billing').prop('checked', false); //uncheck "Use billing address"
    jQuery('#shipping\\:same_as_billing').hide(); //hide radio
    jQuery("label[for='shipping\\:same_as_billing']").remove(); //remove the according label element
});