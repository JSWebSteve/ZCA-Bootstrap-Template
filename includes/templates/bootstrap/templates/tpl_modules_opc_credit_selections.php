<?php
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 (cindy@vinosdefrutastropicales.com).
// Copyright (C) 2013-2024, Vinos de Frutas Tropicales.  All rights reserved.
//
// Last updated: OPC v2.5.0/Bootstrap v3.6.4
//
// -----
// Process the "credit-selection", e.g. coupon-code entry, gift-voucher redeem-code, block(s) for the active
// order-totals -- so long as there is a shipping method available.
//
if ($shipping_module_available) {
    $credit_selection =  $order_total_modules->credit_selection();
    foreach ($credit_selection as $current_selection) {
        // -----
        // Check with the overall OPC controller to ensure that the current credit-selection is
        // valid for the current checkout-environment (e.g. is it allowed during guest checkout).
        //
        // Note that some credit-selection type ot-modules (like zc156's ot_gv.php) might return
        // an empty array if not available.
        //
        if (empty($current_selection) || !$_SESSION['opc']->enableCreditSelection($current_selection['id'])) {
            continue;
        }

        if (isset($_GET['credit_class_error_code']) && $_GET['credit_class_error_code'] == $current_selection['id']) {
?>
<div class="messageStackError">
    <?= zen_output_string_protected($_GET['credit_class_error']) ?>
</div>
<?php
        }

        // -----
        // Determine which parameter needs to be submitted on the button-formatting to include a common class to which
        // a jQuery event handler binds.  When CSS buttons are used, the "secondary class" input must be used; otherwise,
        // the class is submitted to the function as part of the to-be-created parameter list.
        //
        $ot_class = str_replace('ot_', '', $current_selection['id']);
        if (strtolower(IMAGE_USE_CSS_BUTTONS) === 'yes') {
            $secondary_class = 'opc-cc-submit';
            $additional_parms = '';
        } else {
            $secondary_class = '';
            $additional_parms = 'name="apply_' . $ot_class . '"' . ' class="opc-cc-submit"';
        }

        foreach ($current_selection['fields'] as $current_field) {
?>
<div class="checkoutOne<?= ucfirst($ot_class) ?> card mb-3">
    <h4 class="card-header"><?= $current_selection['module'] ?></h4>
    <div class="card-body">
        <?= $current_selection['redeem_instructions'] ?>
        <div class="gvBal larger">
            <?= (!empty($current_selection['checkbox'])) ? $current_selection['checkbox'] : '' ?>
        </div>
        <label class="inputLabel"<?= (!empty($current_field['tag'])) ? (' for="' . $current_field['tag'] . '"') : '' ?>>
            <?= $current_field['title'] ?>
        </label>
        <?= $current_field['field'] ?? '' ?>
<?php
            if (!empty($current_selection['checkbox']) || !empty($current_field['field'])) {
?>
        <div class="mt-3 text-right">
            <?= zen_image_button(BUTTON_IMAGE_SUBMIT, ALT_TEXT_APPLY_DEDUCTION, $additional_parms, $secondary_class) ?>
        </div>
<?php
            }
?>
    </div>
</div>
<?php
        }
    }
}
