<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * Loaded automatically by index.php?main_page=account_edit.
 * View or change Customer Account Information
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rbarbour zcadditions.com Fri Feb 26 00:03:33 2016 -0500 Modified in v1.5.5 $
 */
?>
<div id="accountEditDefault" class="centerColumn">

<?php echo zen_draw_form('account_edit', zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', 'onsubmit="return check_form(account_edit);"') . zen_draw_hidden_field('action', 'process'); ?>

<?php if ($messageStack->size('account_edit') > 0) echo $messageStack->output('account_edit'); ?>

<!--bof my account information card-->
<div id="myAccountInfo-card" class="card mb-3">
<h2 id="myAccountInfo-card-header" class="card-header"><?php echo HEADING_TITLE; ?></h2>
<div id="myAccountInfo-card-body" class="card-body p-3">

<div class="required-info text-end mb-3"><?php echo FORM_REQUIRED_INFORMATION; ?></div>

<?php
  if (ACCOUNT_GENDER == 'true') {
?>
<div class="mb-3">
    <div class="form-check form-check-inline">
        <?php echo zen_draw_radio_field('gender', 'm', '1', 'id="gender-male" class="form-check-input"') . '<label class="form-check-label" for="gender-male">' . MALE . '</label>'; ?>
    </div>
    <div class="form-check form-check-inline">
        <?php echo zen_draw_radio_field('gender', 'f', '', 'id="gender-female" class="form-check-input"') . '<label class="form-check-label" for="gender-female">' . FEMALE . '</label>'; ?>
    </div>
</div>
<?php
  }
?>

<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('firstname', $account->fields['customers_firstname'], 'id="firstname" placeholder="' . ENTRY_FIRST_NAME_TEXT . '" class="form-control"' . ((int)ENTRY_FIRST_NAME_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <label class="form-label" for="firstname"><?php echo ENTRY_FIRST_NAME; ?>
    <?php echo ((int)ENTRY_FIRST_NAME_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?>
    </label>
</div>

<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('lastname', $account->fields['customers_lastname'], 'id="lastname" placeholder="' . ENTRY_LAST_NAME_TEXT . '" class="form-control"' . ((int)ENTRY_LAST_NAME_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <label class="form-label" for="lastname"><?php echo ENTRY_LAST_NAME; ?>
    <?php echo ((int)ENTRY_LAST_NAME_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?>
    </label>
</div>

<?php
  if (ACCOUNT_DOB == 'true') {
?>
<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('dob', zen_date_short($account->fields['customers_dob']), 'id="dob" placeholder="' . ENTRY_DATE_OF_BIRTH_TEXT . '" class="form-control"' . (ACCOUNT_DOB == 'true' && (int)ENTRY_DOB_MIN_LENGTH != 0 ? ' required' : '')); ?>
    <label class="form-label" for="dob"><?php echo ENTRY_DATE_OF_BIRTH; ?>
    <?php echo (ACCOUNT_DOB == 'true' && (int)ENTRY_DOB_MIN_LENGTH != 0 ? '<span class="text-danger">*</span>' : ''); ?>
    </label>
</div>
<?php
  }
?>

<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('email_address', $account->fields['customers_email_address'], 'id="email-address" placeholder="' . ENTRY_EMAIL_ADDRESS_TEXT . '" class="form-control"'. ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? ' required' : ''), 'email'); ?>
    <label class="form-label" for="email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?>
    <?php echo ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?>
    </label>
</div>

<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('telephone', $account->fields['customers_telephone'], 'id="telephone" placeholder="' . ENTRY_TELEPHONE_NUMBER_TEXT . '" class="form-control"' . ((int)ENTRY_TELEPHONE_MIN_LENGTH > 0 ? ' required' : ''), 'tel'); ?>
    <label class="form-label" for="telephone"><?php echo ENTRY_TELEPHONE_NUMBER; ?>
    <?php echo ((int)ENTRY_TELEPHONE_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?>
    </label>
</div>

<?php
if (ACCOUNT_FAX_NUMBER == 'true' ) {
?>
<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('fax', $account->fields['customers_fax'], 'id="fax" placeholder="' . ENTRY_FAX_NUMBER_TEXT . '" class="form-control"', 'tel'); ?>
    <label class="form-label" for="fax"><?php echo ENTRY_FAX_NUMBER; ?></label>
</div>
<?php 
  }
?>

<?php
  if (CUSTOMERS_REFERRAL_STATUS == 2 and $customers_referral == '') {
?>
<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('customers_referral', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_referral', 15) . 'id="customers-referral" placeholder="' . ENTRY_CUSTOMERS_REFERRAL_TEXT . '" class="form-control"'); ?>
    <label class="form-label" for="customers-referral"><?php echo ENTRY_CUSTOMERS_REFERRAL; ?></label>
</div>
<?php } ?>

<?php
  if (CUSTOMERS_REFERRAL_STATUS == 2 and $customers_referral != '') {
?>
<div class="form-floating mb-3">
    <?php echo $customers_referral . zen_draw_hidden_field('customers_referral', $customers_referral,'id="customers-referral-readonly" class="form-control"'); ?>
    <label class="form-label" for="customers-referral-readonly"><?php echo ENTRY_CUSTOMERS_REFERRAL; ?></label>
</div>
<?php } ?>
</div>
</div>
<!--eof my account information card-->

<!--bof newsletter and email details card-->
<div id="details-card" class="card mb-3">
<h4 id="details-card-header" class="card-header">
    <?php echo ENTRY_EMAIL_PREFERENCE; ?></h4>
<div id="details-card-body" class="card-body p-3">

<div class="form-check form-check-inline">
    <?php echo zen_draw_radio_field('email_format', 'HTML', $email_pref_html,'id="email-format-html" class="form-check-input"') . '<label class="form-check-label" for="email-format-html">' . ENTRY_EMAIL_HTML_DISPLAY . '</label>'; ?> 
</div>
<div class="form-check form-check-inline">
    <?php echo zen_draw_radio_field('email_format', 'TEXT', $email_pref_text, 'id="email-format-text" class="form-check-input"') . '<label  class="form-check-label" for="email-format-text">' . ENTRY_EMAIL_TEXT_DISPLAY . '</label>'; ?>
</div>

</div>
</div>
<!--eof newsletter and email details card-->

<div id="accountEditDefault-btn-toolbar" class="btn-toolbar justify-content-between" role="toolbar">
    <?php echo zca_button_link(zen_href_link(FILENAME_ACCOUNT, '', 'SSL'), BUTTON_BACK_ALT, 'button_back'); ?>
    <?php echo zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT, 'name="edit" id="edit" class="btn btn-primary"'); ?>
</div>

</form>
</div>
