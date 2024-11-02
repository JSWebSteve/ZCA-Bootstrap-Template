<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9
 * Copyright (C) 2017-2022, Vinos de Frutas Tropicales.  All rights reserved.
 *
 * Last updated: OPC v2.4.2/Bootstrap v5.0.0
 */
?>
<div id="registerDefault" class="centerColumn">

    <h1 id="createAcctDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<?php
echo zen_draw_form('create_account', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_register_form();"') . zen_draw_hidden_field('action', 'register') . zen_draw_hidden_field('email_pref_html', 'email_format'); 
?>
    <div id="registerDefaultLoginLink"><?php echo sprintf(TEXT_INSTRUCTIONS, zen_href_link(FILENAME_LOGIN, '', 'SSL')); ?></div>
<?php
if ($messageStack->size('create_account') > 0) {
    echo $messageStack->output('create_account');
}
?>
    <div class="required-info text-end mb-3"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<?php
if (DISPLAY_PRIVACY_CONDITIONS === 'true') {
?>
    <div id="privacyConditions-card" class="card mb-3 w-100">
        <h4 id="privacyConditions-card-header" class="card-header"><?php echo TABLE_HEADING_PRIVACY_CONDITIONS; ?></h4>
        <div id="privacyConditions-card-body" class="card-body" aria-labelledby="privacyConditions-card-header">
            <div class="information"><?php echo TEXT_PRIVACY_CONDITIONS_DESCRIPTION;?></div>
            <div class="form-check mb-3 mt-2">
                <?php echo zen_draw_checkbox_field('privacy_conditions', '1', false, 'id="privacy" class="form-check-input" required'); ?>
                <label class="form-check-label" for="privacy"><?php echo TEXT_PRIVACY_CONDITIONS_CONFIRM;?></label>
            </div>
        </div>
    </div>
<?php
}

if (ACCOUNT_COMPANY === 'true') {
?>
    <div id="company-card" class="card mb-3">
        <h4 id="company-card-header" class="card-header"><?php echo CATEGORY_COMPANY; ?></h4>
        <div id="company-card-body" class="card-body" aria-labelledby="company-card-header">
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('company', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_company', '40') . ' id="company" placeholder="' . ENTRY_COMPANY_TEXT . '" class="form-control"' . ((int)ENTRY_COMPANY_MIN_LENGTH !== 0 ? ' required' : '')); ?>
                <label for="company"><?php echo ENTRY_COMPANY; ?><?php echo ((int)ENTRY_COMPANY_MIN_LENGTH !== 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
            </div>
        </div>
    </div>
<?php
}
?>
    <div id="contactDetails-card" class="card mb-3">
        <h4 id="contactDetails-card-header" class="card-header"><?php echo HEADING_CONTACT_DETAILS; ?></h4>
        <div id="contactDetails-card-body" class="card-body" aria-labelledby="contactDetails-card-header">
<?php
if (ACCOUNT_GENDER === 'true') {
?>
        <div class="mb-3">
            <label class="form-label"><?php echo ENTRY_GENDER; ?></label>
            <div class="form-check form-check-inline">
                <?php echo zen_draw_radio_field('gender', 'm', '', 'id="gender-male" class="form-check-input"'); ?>
                <label class="form-check-label" for="gender-male"><?php echo MALE; ?></label>
            </div>
            <div class="form-check form-check-inline">
                <?php echo zen_draw_radio_field('gender', 'f', '', 'id="gender-female" class="form-check-input"'); ?>
                <label class="form-check-label" for="gender-female"><?php echo FEMALE; ?></label>
            </div>
        </div>
<?php
}
?>
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('firstname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '40') . ' id="firstname" placeholder="' . ENTRY_FIRST_NAME_TEXT . '" class="form-control"' . ((int)ENTRY_FIRST_NAME_MIN_LENGTH > 0 ? ' required' : '')); ?>
                <label for="firstname"><?php echo ENTRY_FIRST_NAME; ?><?php echo ((int)ENTRY_FIRST_NAME_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
            </div>
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('lastname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '40') . ' id="lastname" placeholder="' . ENTRY_LAST_NAME_TEXT . '" class="form-control"' . ((int)ENTRY_LAST_NAME_MIN_LENGTH > 0 ? ' required' : '')); ?>
                <label for="lastname"><?php echo ENTRY_LAST_NAME; ?><?php echo ((int)ENTRY_LAST_NAME_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
            </div>
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('telephone', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_telephone', '40') . ' id="telephone" placeholder="' . ENTRY_TELEPHONE_NUMBER_TEXT . '" class="form-control"' . ((int)ENTRY_TELEPHONE_MIN_LENGTH > 0 ? ' required' : ''), 'tel'); ?>
                <label for="telephone"><?php echo ENTRY_TELEPHONE_NUMBER; ?><?php echo ((int)ENTRY_TELEPHONE_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
            </div>
<?php
if (ACCOUNT_DOB === 'true') {
?>
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('dob','', 'id="dob" placeholder="' . ENTRY_DATE_OF_BIRTH_TEXT . '" class="form-control"' . (ACCOUNT_DOB == 'true' && (int)ENTRY_DOB_MIN_LENGTH != 0 ? ' required' : '')); ?>
                <label for="dob"><?php echo ENTRY_DATE_OF_BIRTH; ?><?php echo (ACCOUNT_DOB == 'true' && (int)ENTRY_DOB_MIN_LENGTH != 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
            </div>
<?php
}

if ($display_nick_field === true) {
?>
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('nick','', 'id="nickname" placeholder="' . ENTRY_NICK_TEXT . '" class="form-control"'); ?>
                <label for="nickname"><?php echo ENTRY_NICK; ?></label>
            </div>
<?php
}
?>
        </div>
    </div>

    <div id="loginDetails-card" class="card mb-3">
        <h4 id="loginDetails-card-header" class="card-header"><?php echo TABLE_HEADING_LOGIN_DETAILS; ?></h4>
        <div id="loginDetails-card-body" class="card-body" aria-labelledby="loginDetails-card-header">
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address" placeholder="' . ENTRY_EMAIL_ADDRESS_TEXT . '" class="form-control"' . ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? ' required' : ''), 'email'); ?>
                <label for="email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?><?php echo ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
            </div>
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('email_address_confirm', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address-confirm" placeholder="' . ENTRY_EMAIL_ADDRESS_TEXT . '" class="form-control"' . ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? ' required' : ''), 'email'); ?>
                <label for="email-address-confirm"><?php echo ENTRY_EMAIL_ADDRESS_CONFIRM; ?><?php echo ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
            </div>
            <div class="mb-3">
                <label class="form-label"><?php echo ENTRY_EMAIL_FORMAT; ?></label>
                <div class="form-check form-check-inline">
                    <?php echo zen_draw_radio_field('email_format', 'HTML', ($email_format === 'HTML'), 'id="email-format-html" class="form-check-input"'); ?>
                    <label class="form-check-label" for="email-format-html"><?php echo ENTRY_EMAIL_HTML_DISPLAY; ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <?php echo zen_draw_radio_field('email_format', 'TEXT', ($email_format === 'TEXT'), 'id="email-format-text" class="form-check-input"'); ?>
                    <label class="form-check-label" for="email-format-text"><?php echo ENTRY_EMAIL_TEXT_DISPLAY; ?></label>
                </div>
            </div>
            <div class="form-floating mb-3">
                <?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-new" placeholder="' . ENTRY_PASSWORD_TEXT . '" class="form-control"' . ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? ' required' : ''), 'autocomplete="new-password"'); ?>
                <label for="password-new"><?php echo ENTRY_PASSWORD; ?><?php echo ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
            </div>
            <div class="form-floating mb-3">
                <?php echo zen_draw_password_field('confirmation', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-confirm" placeholder="' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '" class="form-control"' . ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? ' required' : ''), 'autocomplete="new-password"'); ?>
                <label for="password-confirm"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?><?php echo ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
            </div>
        </div>
    </div>
    
<?php
if (ACCOUNT_NEWSLETTER_STATUS !== '0') {
?>
    <div id="newsletterDetails-card" class="card mb-3">
        <h4 id="newsletterDetails-card-header" class="card-header"><?php echo ENTRY_EMAIL_PREFERENCE; ?></h4>
        <div id="newsletterDetails-card-body" class="card-body" aria-labelledby="newsletterDetails-card-header">
            <div class="form-check form-switch">
                <?php echo zen_draw_checkbox_field('newsletter', '1', $newsletter, 'class="form-check-input" id="newsletter-checkbox"'); ?>
                <label class="form-check-label" for="newsletter-checkbox"><?php echo ENTRY_NEWSLETTER; ?></label>
                <?php echo (!empty(ENTRY_NEWSLETTER_TEXT)) ? '<span class="alert">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''; ?>
            </div>
        </div>
    </div>
<?php 
} 

if (CUSTOMERS_REFERRAL_STATUS === '2') {
?>
    <div id="referralDetails-card" class="card mb-3">
        <h4 id="referralDetails-card-header" class="card-header"><?php echo TABLE_HEADING_REFERRAL_DETAILS; ?></h4>
        <div id="referralDetails-card-body" class="card-body" aria-labelledby="referralDetails-card-header">
            <div class="form-floating mb-3">
                <?php echo zen_draw_input_field('customers_referral', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_referral', '15') . ' id="customers_referral" placeholder="' . ENTRY_CUSTOMERS_REFERRAL_TEXT . '" class="form-control"'); ?>
                <label for="customers_referral"><?php echo ENTRY_CUSTOMERS_REFERRAL; ?></label>
            </div>
        </div>
    </div>
<?php 
} 
?>
    <div class="d-flex justify-content-center">
        <?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_REGISTER_ALT, '', 'btn btn-primary'); ?>
    </div>
<?php
echo '</form>';
?>
</div>
