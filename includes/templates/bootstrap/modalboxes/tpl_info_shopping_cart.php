<?php
/**
 * Override Modal for info_shopping_cart
 * 
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
zca_load_language_for_modal('info_shopping_cart');
?>
<!-- Modal -->
<div id="cartHelpModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="cartHelpModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="cartHelpModalLabel" class="modal-title"><?php echo HEADING_TITLE_CART_MODAL; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo TEXT_MODAL_CLOSE; ?>"></button>
            </div>
            <div class="modal-body">
                <h2><?php echo SUB_HEADING_TITLE_1; ?></h2>
                <p><?php echo SUB_HEADING_TEXT_1; ?></p>
                <h2><?php echo SUB_HEADING_TITLE_2; ?></h2>
                <p><?php echo SUB_HEADING_TEXT_2; ?></p>
                <h2><?php echo SUB_HEADING_TITLE_3; ?></h2>
                <p><?php echo SUB_HEADING_TEXT_3; ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo TEXT_MODAL_CLOSE; ?></button>
            </div>
        </div>
    </div>
</div>
