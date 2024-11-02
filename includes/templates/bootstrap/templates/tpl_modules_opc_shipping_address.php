<?php
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 (cindy@vinosdefrutastropicales.com).
// Copyright (C) 2013-2022, Vinos de Frutas Tropicales.  All rights reserved.
//
// Last updated: OPC v2.4.2/Bootstrap v5.0.0
//
// -----
// Display shipping-address information **only if** the order contains at least one physical product (i.e. it's not virtual).
//
if ($is_virtual_order === true) {
    echo zen_draw_checkbox_field('shipping_billing', '1', false, 'id="shipping_billing" style="display: none;"');
} else {
    if (CHECKOUT_ONE_ENABLE_SHIPPING_BILLING === 'false') {
        echo zen_draw_checkbox_field('shipping_billing', '1', false, 'id="shipping_billing" style="display: none;"');
    } else {
?>
<div id="checkoutOneShippingFlag" class="form-check form-switch mb-3" style="display: none;">
    <?php echo zen_draw_checkbox_field('shipping_billing', '1', $shipping_billing, 'id="shipping_billing" class="form-check-input"');?>
    <label class="form-check-label" for="shipping_billing"><?php echo TEXT_USE_BILLING_FOR_SHIPPING; ?></label>
</div>
<?php
    }
?>
<div id="checkoutOneShipto" class="card mb-3">
    <h4 id="shipping-address-heading" class="card-header"><?php echo TITLE_SHIPPING_ADDRESS; ?></h4>
    <div class="card-body" aria-labelledby="shipping-address-heading">
<?php
    $opc_address_type = 'ship';
    $opc_disable_address_change = !$editShippingButtonLink;
    require $template->get_template_dir('tpl_modules_opc_address_block.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_opc_address_block.php';

    if ($editShippingButtonLink === true) {
        $cancel_title = 'title="' . BUTTON_CANCEL_CHANGES_TITLE . '"';
        $save_title = 'title="' . BUTTON_SAVE_CHANGES_TITLE . '"';
        $show_add_address = $_SESSION['opc']->showAddAddressField();
        $parameters = ($show_add_address) ? '' : ' class="visually-hidden"';
?>
        <div class="opc-buttons">
<?php
        if ($show_add_address === true) {
?>
            <div class="form-check">
                <?php echo zen_draw_checkbox_field("add_address['ship']", '1', false, 'id="opc-add-ship"' . $parameters . ' class="form-check-input"'); ?>
                <label class="form-check-label" for="opc-add-ship" title="<?php echo TITLE_ADD_TO_ADDRESS_BOOK; ?>"><?php echo TEXT_ADD_TO_ADDRESS_BOOK; ?></label>
            </div>
<?php
        }
?>
            <div class="d-flex justify-content-around mt-2">
                <div id="opc-ship-cancel"><?php echo zen_image_button(BUTTON_IMAGE_CANCEL, BUTTON_CANCEL_CHANGES_ALT, $cancel_title, 'btn btn-outline-secondary'); ?></div>
                <div id="opc-ship-save"><?php echo zen_image_button(BUTTON_IMAGE_UPDATE, BUTTON_SAVE_CHANGES_ALT, $save_title, 'btn btn-primary'); ?></div>
            </div>
        </div>
<?php 
    } 
?>
    </div>
</div>
<?php
}
