<?php
/**
 * Override Modal for popup_image
 * 
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
?>
<!-- Modal -->
<div id="image-modal-lg" class="modal fade image-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="myLargeModalLabel" class="modal-title"><?php echo $products_name; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo TEXT_MODAL_CLOSE; ?>"></button>
            </div>
            <div id="productLargeImageModal" class="modal-body"><?php echo zen_image($products_image_large, $products_name, '', '', 'class="img-fluid"'); ?></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo TEXT_MODAL_CLOSE; ?></button>
            </div>
        </div>
    </div>
</div>
