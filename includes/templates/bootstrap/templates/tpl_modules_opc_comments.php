<?php
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 (cindy@vinosdefrutastropicales.com).
// Copyright (C) 2013-2022, Vinos de Frutas Tropicales.  All rights reserved.
//
// Last updated: OPC v2.4.2/Bootstrap v5.0.0
//
?>
<div id="checkoutComments" class="card mb-3">
    <h4 id="comments-title" class="card-header"><?php echo TABLE_HEADING_COMMENTS; ?></h4>
    <div class="card-body" aria-labelledby="comments-title">
        <div class="form-floating mb-3">
            <?php echo zen_draw_textarea_field('comments', '45', '3', '', 'id="comments" class="form-control" style="height: 100px;" placeholder=" "'); ?>
            <label for="comments"><?php echo TABLE_HEADING_COMMENTS; ?></label>
        </div>
    </div>
</div>
