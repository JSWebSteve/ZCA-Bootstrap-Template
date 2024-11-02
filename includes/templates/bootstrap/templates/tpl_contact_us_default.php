<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * Loaded automatically by index.php?main_page=contact_us.<br />
 * Displays contact us page form.
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rbarbour zcadditions.com 2019 Jul 22 Modified in v1.5.7 $
 */
?>
<div id="contactUsDefault" class="centerColumn">
<?php
if (CONTACT_US_STORE_NAME_ADDRESS === '1') {
?>
    <address><?php echo nl2br(STORE_NAME_ADDRESS); ?></address>
<?php
}

if (isset($_GET['action']) && $_GET['action'] === 'success') {
?>
    <div id="contactUsDefault-content" class="content"><?php echo TEXT_SUCCESS; ?></div>

    <div id="contactUsDefault-btn-toolbar" class="d-flex justify-content-end my-3" role="toolbar">
        <?php echo zca_back_link(); ?>
    </div>
<?php
} else {
    // -----
    // If configured, include the define-page for the contact_us page.
    //
    if (DEFINE_CONTACT_US_STATUS === '1' || DEFINE_CONTACT_US_STATUS === '2') {
?>
    <div id="contactUsDefault-defineContent" class="defineContent">
        <?php require $define_page; ?>
    </div>
<?php
    }

    if ($messageStack->size('contact') > 0) {
        echo $messageStack->output('contact');
    }
?>
    <?php echo zen_draw_form('contact_us', zen_href_link(FILENAME_CONTACT_US, 'action=send', 'SSL')); ?>
    <div id="contactUs-card" class="card">
        <h2 id="contactUs-card-header" class="card-header"><?php echo HEADING_TITLE; ?></h2>
        <div id="contactUs-card-body" class="card-body" aria-labelledby="contactUs-card-header">
            <div id="contactUs-required-info" class="required-info text-end my-3"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<?php
    // show dropdown if set
    if (CONTACT_US_LIST !== '') {
?>
            <div class="form-floating mb-3">
                <?php echo zen_draw_pull_down_menu('send_to',  $send_to_array, $send_to_default, 'id="send-to" class="form-select" required size="' . count($send_to_array) . '"'); ?>
                <label for="send-to"><?php echo SEND_TO_TEXT; ?><span class="text-danger">*</span></label>
            </div>
<?php
    }
?>
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('contactname', $name, 'id="contactname" class="form-control" placeholder="' . ENTRY_NAME . '" required'); ?>
                <label for="contactname"><?php echo ENTRY_NAME; ?><span class="text-danger">*</span></label>
            </div>

            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('email', ($email_address), 'id="email-address" class="form-control" autocomplete="off" placeholder="' . ENTRY_EMAIL . '" required', 'email'); ?>
                <label for="email-address"><?php echo ENTRY_EMAIL; ?><span class="text-danger">*</span></label>
            </div>

            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('telephone', ($telephone), 'id="telephone" class="form-control" autocomplete="off" placeholder="' . ENTRY_TELEPHONE_NUMBER . '"', 'tel'); ?>
                <label for="telephone"><?php echo ENTRY_TELEPHONE_NUMBER; ?></label>
            </div>

            <div class="form-floating mb-3">
                <?php echo zen_draw_textarea_field('enquiry', '30', '7', $enquiry, 'id="enquiry" class="form-control" style="height: 200px;" placeholder=" " required'); ?>
                <label for="enquiry"><?php echo ENTRY_ENQUIRY; ?><span class="text-danger">*</span></label>
            </div>

            <?php echo zen_draw_input_field($antiSpamFieldName, '', 'id="CUAS" style="visibility:hidden; display:none;" autocomplete="off"'); ?>

            <div id="contactUs-btn-toolbar" class="d-flex justify-content-end mt-3" role="toolbar">
                <?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT, '', 'btn btn-primary'); ?>
            </div>
        </div>
    </div>

    <div id="contactUsDefault-btn-toolbar" class="d-flex justify-content-start my-3" role="toolbar">
        <?php echo zca_back_link(); ?>
    </div>
    <?php echo '</form>'; ?>
<?php
}
?>
</div>
