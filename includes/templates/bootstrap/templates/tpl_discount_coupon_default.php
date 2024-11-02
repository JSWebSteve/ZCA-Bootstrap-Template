<?php
/**
 * Page Template
 *
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: lat9 2019 Aug 23 Modified in v1.5.7 $
 */
?>
<div id="discountCouponDefault" class="centerColumn">
    <h1 id="discountCouponDefault-pageHeading" class="pageHeading"><?php echo HEADING_TITLE; ?></h1>

    <div id="discountCouponDefault-defineContent" class="defineContent mb-3">
<?php
if ((DEFINE_DISCOUNT_COUPON_STATUS === '1' || DEFINE_DISCOUNT_COUPON_STATUS === '2') && $text_coupon_help === '') {
    require $define_page;
 } else {
    echo $text_coupon_help;
}
?>
    </div>

    <?php echo zen_draw_form('discount_coupon', zen_href_link(FILENAME_DISCOUNT_COUPON, 'action=lookup', 'SSL', false), 'post', 'class="needs-validation" novalidate'); ?>

        <div id="lookupDiscountCoupon-card" class="card">
            <h4 id="lookupDiscountCoupon-card-header" class="card-header"><?php echo TEXT_DISCOUNT_COUPON_ID_INFO; ?></h4>
            <div id="lookupDiscountCoupon-card-body" class="card-body p-3" aria-labelledby="lookupDiscountCoupon-card-header">
                <div class="form-floating mb-3">
                    <?php echo zen_draw_input_field('lookup_discount_coupon', isset($_POST['lookup_discount_coupon']) ? $_POST['lookup_discount_coupon'] : '', 'id="lookup-discount-coupon" class="form-control" placeholder="' . TEXT_DISCOUNT_COUPON_ID . '" autocomplete="off" required', 'search'); ?>
                    <label class="form-label" for="lookup-discount-coupon"><?php echo TEXT_DISCOUNT_COUPON_ID; ?></label>
                </div>

                <div id="lookupDiscountCoupon-btn-toolbar" class="d-flex justify-content-end mt-3" role="toolbar">
<?php
if ($text_coupon_help === '') {
    echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_LOOKUP_ALT, '', 'btn btn-primary');
} else {
    echo '<a href="' . zen_href_link(FILENAME_DISCOUNT_COUPON) . '" class="btn btn-outline-secondary" role="button">' . BUTTON_CANCEL_ALT . '</a>';
    echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_LOOKUP_ALT, '', 'btn btn-primary ms-2');
}
?>
                </div>
            </div>
        </div>

        <div id="discountCouponDefault-btn-toolbar" class="d-flex justify-content-start my-3" role="toolbar">
            <?php echo zca_back_link(); ?>
        </div>

    <?php echo '</form>'; ?>
</div>
