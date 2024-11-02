<?php
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 (cindy@vinosdefrutastropicales.com).
// Copyright (C) 2018-2022, Vinos de Frutas Tropicales.  All rights reserved.
//
// Last updated: OPC v2.4.2/Bootstrap v5.0.0
//
if ($_SESSION['opc']->isGuestCheckout()) {
    $cancel_title = 'title="' . BUTTON_CANCEL_CHANGES_TITLE . '"';
    $save_title = 'title="' . BUTTON_SAVE_CHANGES_TITLE . '"';
    
    $email_field_len = zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40');
    $email_required = ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0) ? ' required' : '';
    $email_value = $_SESSION['opc']->getGuestEmailAddress();

    $telephone_field_len = zen_set_field_length(TABLE_CUSTOMERS, 'customers_telephone', '40');
    $telephone_required = ((int)ENTRY_TELEPHONE_MIN_LENGTH > 0) ? ' required' : '';
    $telephone_value = $_SESSION['opc']->getGuestTelephone();
    
    $dob_value = $_SESSION['opc']->getGuestDateOfBirth();
?>
<div id="checkoutOneGuestInfo" class="card mb-3">
    <h4 id="contact-info-heading" class="card-header"><?php echo TITLE_CONTACT_INFORMATION; ?></h4>
    <div class="card-body" aria-labelledby="contact-info-heading">
        <p><?php echo TEXT_CONTACT_INFORMATION; ?></p>

        <div class="form-floating mb-3">
            <?php echo zen_draw_input_field('email_address', $email_value, $email_field_len . ' id="opc-guest-email" placeholder="' . ENTRY_EMAIL_ADDRESS . '" class="form-control"' . $email_required, 'email'); ?>
            <label class="form-label" for="opc-guest-email"><?php echo ENTRY_EMAIL_ADDRESS; ?><?php echo $email_required ? '<span class="text-danger">*</span>' : ''; ?></label>
        </div>
<?php
    if (CHECKOUT_ONE_GUEST_EMAIL_CONFIRMATION === 'true') {
?>
        <div class="form-floating mb-3">
            <?php echo zen_draw_input_field('email_address_conf', $email_value, $email_field_len . ' id="opc-guest-email-conf" placeholder="' . ENTRY_EMAIL_ADDRESS_CONF . '" class="form-control"' . $email_required, 'email'); ?>
            <label class="form-label" for="opc-guest-email-conf"><?php echo ENTRY_EMAIL_ADDRESS_CONF; ?><?php echo $email_required ? '<span class="text-danger">*</span>' : ''; ?></label>
        </div>
<?php
    }
?>
        <div class="form-floating mb-3">
            <?php echo zen_draw_input_field('telephone', $telephone_value, $telephone_field_len . ' id="telephone" placeholder="' . ENTRY_TELEPHONE_NUMBER . '" class="form-control"' . $telephone_required, 'tel'); ?>
            <label class="form-label" for="telephone"><?php echo ENTRY_TELEPHONE_NUMBER; ?><?php echo $telephone_required ? '<span class="text-danger">*</span>' : ''; ?></label>
        </div>
<?php
    if (ACCOUNT_DOB === 'true') {
        $dob_required = (((int)ENTRY_DOB_MIN_LENGTH) > 0) ? ' required' : '';
?>
        <div class="form-floating mb-3">
            <?php echo zen_draw_input_field('dob', $dob_value, 'id="dob" placeholder="' . ENTRY_DATE_OF_BIRTH . '" class="form-control"' . $dob_required); ?>
            <label class="form-label" for="dob"><?php echo ENTRY_DATE_OF_BIRTH; ?><?php echo $dob_required ? '<span class="text-danger">*</span>' : ''; ?></label>
        </div>
<?php
    }
?>
       <div class="opc-buttons d-flex justify-content-end mt-3">
            <div id="opc-guest-cancel" class="me-2"><?php echo zen_image_button(BUTTON_IMAGE_CANCEL, BUTTON_CANCEL_CHANGES_ALT, $cancel_title, 'btn btn-outline-secondary'); ?></div>
            <div id="opc-guest-save"><?php echo zen_image_button(BUTTON_IMAGE_UPDATE, BUTTON_SAVE_CHANGES_ALT, $save_title, 'btn btn-primary'); ?></div>
        </div>
        <div id="messages-guest"></div>
    </div>
</div>
<?php
}
