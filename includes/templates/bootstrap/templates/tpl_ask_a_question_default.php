<?php
/**
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Scott C Wilson 2022 Jan 22 Modified in v1.5.8-alpha $
 */
// -----
// zc158b+ creates a new variables in support of a question asked of a "call for price"
// product.  Since this template supports zc157 and the full zc158 family, honor those
// variables, if set, but default to the legacy values if not.
//
if (!isset($heading_title)) {
    $heading_title = HEADING_TITLE;
}
if (!isset($form_title)) {
    $form_title = FORM_TITLE;
}
?>
<div id="askAQuestion" class="centerColumn">
    <?php echo zen_draw_form('ask_a_question', zen_href_link(FILENAME_ASK_A_QUESTION, 'action=send&pid=' . (int)$_GET['pid'], 'SSL'), 'post', 'class="needs-validation" novalidate'); ?>

<?php
if (CONTACT_US_STORE_NAME_ADDRESS === '1') {
?>
    <address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
<?php
}
?>
    <h1><?php echo $heading_title . $product_details['products_name']; ?></h1>

<?php
if (isset($_GET['action']) && ($_GET['action'] === 'success')) {
?>
    <div class="alert alert-success" role="alert"><?php echo TEXT_SUCCESS; ?></div>

    <div class="d-flex justify-content-start my-3" role="toolbar">
        <?php echo zca_button_link(zen_back_link(true), BUTTON_BACK_ALT, 'button_back'); ?>
    </div>

<?php
} else {
?>
    <a href="<?php echo zen_href_link(zen_get_info_page((int)$_GET['pid']), 'products_id=' . (int)$_GET['pid'], 'SSL'); ?>">
        <?php echo zen_image(DIR_WS_IMAGES . $product_details['products_image'], $product_details['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT); ?>
    </a>

    <div id="contactUsNoticeContent" class="content">
<?php
/**
 * require html_define for the contact_us page
 */
require $define_page;
?>
    </div>
<?php
if ($messageStack->size('contact') > 0) {
    echo $messageStack->output('contact');
}
?>
    <div id="contactUsForm" class="card">
        <h2 id="contactUsForm-card-header" class="card-header"><?php echo $form_title; ?></h2>
        <div id="contactUsForm-card-body" class="card-body" aria-labelledby="contactUsForm-card-header">
            <div class="required-info text-end mb-3"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<?php
// show dropdown if set
    if (CONTACT_US_LIST !== '') {
?>
            <div class="form-floating mb-3">
                <?php echo zen_draw_pull_down_menu('send_to',  $send_to_array, 0, 'id="send-to" class="form-select" required aria-label="' . SEND_TO_TEXT . '"'); ?>
                <label class="form-label" for="send-to"><?php echo SEND_TO_TEXT; ?></label>
            </div>
<?php
    }

    // -----
    // zc158 adds a new definition for telephone-number labels; use that if present, otherwise
    // fall-back to the previous definition.
    //
    $telephone_label = (defined('ENTRY_TELEPHONE_NUMBER')) ? ENTRY_TELEPHONE_NUMBER : ENTRY_TELEPHONE;
?>
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('contactname', $name, 'id="contactname" placeholder="' . ENTRY_NAME . '" class="form-control" required'); ?>
                <label class="form-label" for="contactname"><?php echo ENTRY_NAME; ?><span class="text-danger">*</span></label>
            </div>

            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('email', ($email_address), 'id="email-address" placeholder="' . ENTRY_EMAIL . '" class="form-control" required', 'email'); ?>
                <label class="form-label" for="email-address"><?php echo ENTRY_EMAIL; ?><span class="text-danger">*</span></label>
            </div>

            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('telephone', ($telephone), 'id="telephone" placeholder="' . $telephone_label . '" class="form-control" required', 'tel'); ?>
                <label class="form-label" for="telephone"><?php echo $telephone_label; ?><span class="text-danger">*</span></label>
            </div>

            <div class="form-floating mb-3">
                <?php echo zen_draw_textarea_field('enquiry', '30', '7', $enquiry, 'id="enquiry" class="form-control" style="height: 200px;" placeholder=" " required'); ?>
                <label for="enquiry"><?php echo ENTRY_ENQUIRY; ?><span class="text-danger">*</span></label>
            </div>

            <?php echo zen_draw_input_field($antiSpamFieldName, '', ' id="CUAS" style="visibility:hidden; display:none;" autocomplete="off"'); ?>
            
            <div class="d-flex justify-content-end mt-3" role="toolbar">
                <?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT, 'btn btn-primary'); ?>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-start my-3" role="toolbar">
        <?php echo zca_button_link(zen_back_link(true), BUTTON_BACK_ALT, 'button_back'); ?>
    </div>
<?php
}
?>
    <?php echo '</form>'; ?>
</div>
