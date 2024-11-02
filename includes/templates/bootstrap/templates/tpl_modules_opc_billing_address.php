<?php
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 (cindy@vinosdefrutastropicales.com).
// Copyright (C) 2013-2022, Vinos de Frutas Tropicales.  All rights reserved.
//
// Last updated: OPC v2.4.2/Bootstrap v5.0.0
//
?>
<div id="checkoutOneBillto" class="card mb-3<?php echo ($flagDisablePaymentAddressChange) ? ' opc-base' : ''; ?>">
    <h4 id="opc-billing-title" class="card-header"><?php echo ($shipping_billing) ? TITLE_BILLING_SHIPPING_ADDRESS : TITLE_BILLING_ADDRESS; ?></h4>
    <div class="card-body" aria-labelledby="opc-billing-title">

<?php
$opc_address_type = 'bill';
$opc_disable_address_change = $flagDisablePaymentAddressChange;
require $template->get_template_dir('tpl_modules_opc_address_block.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_opc_address_block.php';

if (!$flagDisablePaymentAddressChange) {
    $cancel_title = 'title="' . BUTTON_CANCEL_CHANGES_TITLE . '"';
    $save_title = 'title="' . BUTTON_SAVE_CHANGES_TITLE . '"';
    $show_add_address = $_SESSION['opc']->showAddAddressField();
    $parameters = ($show_add_address) ? '' : ' class="d-none"';
?>
        <div class="opc-buttons">
<?php
    if ($show_add_address === true) {
?>
            <div class="form-check">
                <?php echo zen_draw_checkbox_field("add_address['bill']", '1', false, 'id="opc-add-bill"' . $parameters . ' class="form-check-input"'); ?>
                <label class="form-check-label" for="opc-add-bill" title="<?php echo TITLE_ADD_TO_ADDRESS_BOOK; ?>"><?php echo TEXT_ADD_TO_ADDRESS_BOOK; ?></label>
            </div>
<?php
    }
?>
            <div class="d-flex justify-content-around mt-3">
                <div id="opc-bill-cancel"><?php echo zen_image_button(BUTTON_IMAGE_CANCEL, BUTTON_CANCEL_CHANGES_ALT, $cancel_title, 'btn btn-secondary'); ?></div>
                <div id="opc-bill-save"><?php echo zen_image_button(BUTTON_IMAGE_UPDATE, BUTTON_SAVE_CHANGES_ALT, $save_title, 'btn btn-primary'); ?></div>
            </div>
        </div>
<?php 
} 
?>
    </div>
    <div class="opc-overlay<?php echo ($flagDisablePaymentAddressChange) ? ' active' : ''; ?>"></div>
</div>
<?php
// -----
// If not in guest-checkout, see if the checkout is on behalf of a registered-account
// that doesn't currently have a primary address.  If so, include an HTML indicator (used by
// the plugin's jQuery) to 'force' the customer to enter their primary address.
//
if (!zen_in_guest_checkout() && $_SESSION['opc']->customerAccountNeedsPrimaryAddress()) {
?>
<span id="opc-need-primary-address" class="visually-hidden">&nbsp;</span>
<?php
}
