<?php
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 (cindy@vinosdefrutastropicales.com).
// Copyright (C) 2013-2022, Vinos de Frutas Tropicales.  All rights reserved.
//
// Last updated: OPC v2.4.4/Bootstrap v5.0.0
//
// -----
// Don't display the conditions' block unless there is a shipping method available
// and the payment-related address is validated.
//
if ($shipping_module_available === true && $display_payment_block === true) {
    if ($_SESSION['opc']->isGuestCheckout() && DISPLAY_PRIVACY_CONDITIONS === 'true') {
?>
<div id="privacy-div" class="card mb-3">
    <h4 id="privacy-heading" class="card-header"><?php echo TABLE_HEADING_PRIVACY_CONDITIONS; ?></h4>
    <div class="card-body" aria-labelledby="privacy-heading">
        <div class="information mb-2"><?php echo TEXT_PRIVACY_CONDITIONS_DESCRIPTION;?></div>
        <div class="form-check">
            <?php echo zen_draw_checkbox_field('privacy_conditions', '1', false, 'id="privacy" class="form-check-input" required aria-label="' . TEXT_PRIVACY_CONDITIONS_CONFIRM . '"'); ?>
            <label class="form-check-label" for="privacy"><?php echo TEXT_PRIVACY_CONDITIONS_CONFIRM; ?></label>
        </div>
    </div>
</div>
<?php
    }

    if (DISPLAY_CONDITIONS_ON_CHECKOUT === 'true') {
?>
<div id="conditions-div" class="card mb-3">
    <h4 id="conditions-heading" class="card-header"><?php echo TABLE_HEADING_CONDITIONS; ?></h4>
    <div class="card-body" aria-labelledby="conditions-heading">
        <div class="mb-2"><?php echo TEXT_CONDITIONS_DESCRIPTION;?></div>
        <div class="form-check">
            <?php echo zen_draw_checkbox_field('conditions', '1', false, 'id="conditions" class="form-check-input" required aria-label="' . TEXT_CONDITIONS_CONFIRM . '"'); ?>
            <label class="form-check-label" for="conditions"><?php echo TEXT_CONDITIONS_CONFIRM; ?></label>
        </div>
    </div>
</div>
<?php
    }
}
