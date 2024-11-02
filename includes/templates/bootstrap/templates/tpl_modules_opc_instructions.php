<?php
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 (cindy@vinosdefrutastropicales.com).
// Copyright (C) 2013-2017, Vinos de Frutas Tropicales.  All rights reserved.
//
// Last updated: OPC v2.4.2/Bootstrap v5.0.0
//
if (TEXT_CHECKOUT_ONE_INSTRUCTIONS !== '') {
?>
<div id="instructions" class="card mb-3">
<?php
    if (TEXT_CHECKOUT_ONE_INSTRUCTION_LABEL !== '') {
?>
    <h4 id="instructions-heading" class="card-header"><?php echo TEXT_CHECKOUT_ONE_INSTRUCTION_LABEL; ?></h4>
<?php
    }
?>
    <div class="card-body" <?php echo (TEXT_CHECKOUT_ONE_INSTRUCTION_LABEL !== '') ? 'aria-labelledby="instructions-heading"' : ''; ?>>
        <p><?php echo TEXT_CHECKOUT_ONE_INSTRUCTIONS; ?></p>
    </div>
</div>
<?php
}
