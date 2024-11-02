<?php
/**
 * Module Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * Displays address-book details/selection
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rbarbour zcadditions.com 2019 Jun 02 Modified in v1.5.7 $
 */
// -----
// Used by the address_book_process, checkout_payment_address and checkout_shipping_address pages
//
// -----
// The common address format 'expects' to see the default values to initially populate
// within a $entry object (as returned from a $db query).  If it's not available, "fake" that out to prevent
// PHP notices during that processing.
//
if (!isset($entry) || !is_object($entry)) {
    $entry = new stdClass();
    $entry->fields = [
        'entry_gender' => '',
        'entry_firstname' => '',
        'entry_lastname' => '',
        'entry_company' => '',
        'entry_street_address' => '',
        'entry_suburb' => '',
        'entry_city' => '',
        'entry_postcode' => '',
        'entry_country_id' => STORE_COUNTRY,
    ];
}

// -----
// Adding a (hidden) span to contain a 'stBreak' identifier, to keep the 'base' Zen Cart
// jscript_addr_pulldowns.php from throwing a javascript error for that missing 'id'.
//
?>
<span class="d-none" id="stBreak">&nbsp;</span>

<div class="required-info text-end mb-3"><?php echo FORM_REQUIRED_INFORMATION; ?></div>

<?php
if (ACCOUNT_GENDER === 'true') {
    if (isset($gender)) {
        $male = ($gender === 'm');
    } else {
        $male = ($entry->fields['entry_gender'] === 'm');
    }
    $female = !$male;
?>
<div class="mb-3">
    <div class="form-check form-check-inline">
        <?php echo zen_draw_radio_field('gender', 'm', $male, 'id="gender-male" class="form-check-input"') . '<label class="form-check-label" for="gender-male">' . MALE . '</label>'; ?>
    </div>
    <div class="form-check form-check-inline">
        <?php echo zen_draw_radio_field('gender', 'f', $female, 'id="gender-female" class="form-check-input"') . '<label class="form-check-label" for="gender-female">' . FEMALE . '</label>'; ?>
    </div>
</div>
<?php
}
?>

<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('firstname', $entry->fields['entry_firstname'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '40') . ' id="firstname" placeholder="' . ENTRY_FIRST_NAME_TEXT . '" class="form-control"' . ((int)ENTRY_FIRST_NAME_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <label class="form-label" for="firstname"><?php echo ENTRY_FIRST_NAME; ?><?php echo ((int)ENTRY_FIRST_NAME_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
</div>

<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('lastname', $entry->fields['entry_lastname'], zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '40') . ' id="lastname" placeholder="' . ENTRY_LAST_NAME_TEXT . '" class="form-control"' . ((int)ENTRY_LAST_NAME_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <label class="form-label" for="lastname"><?php echo ENTRY_LAST_NAME; ?><?php echo ((int)ENTRY_LAST_NAME_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
</div>

<?php
if (ACCOUNT_COMPANY === 'true') {
?>
<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('company', $entry->fields['entry_company'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_company', '40') . ' id="company" autocomplete="organization" placeholder="' . ENTRY_COMPANY_TEXT . '" class="form-control"' . ((int)ENTRY_COMPANY_MIN_LENGTH !== 0 ? ' required' : '')); ?>
    <label class="form-label" for="company"><?php echo ENTRY_COMPANY; ?><?php echo ((int)ENTRY_COMPANY_MIN_LENGTH !== 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
</div>
<?php
}
?>

<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('street_address', $entry->fields['entry_street_address'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' id="street-address" placeholder="' . ENTRY_STREET_ADDRESS_TEXT . '" class="form-control"' . ((int)ENTRY_STREET_ADDRESS_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <label class="form-label" for="street-address"><?php echo ENTRY_STREET_ADDRESS; ?><?php echo ((int)ENTRY_STREET_ADDRESS_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
</div>

<?php
if (ACCOUNT_SUBURB === 'true') {
?>
<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('suburb', $entry->fields['entry_suburb'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_suburb', '40') . ' id="suburb" autocomplete="address-line2" placeholder="' . ENTRY_SUBURB_TEXT . '" class="form-control"'); ?>
    <label class="form-label" for="suburb"><?php echo ENTRY_SUBURB; ?></label>
</div>
<?php
}
?>

<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('city', $entry->fields['entry_city'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' id="city" placeholder="' . ENTRY_CITY_TEXT . '" class="form-control"' . ((int)ENTRY_CITY_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <label class="form-label" for="city"><?php echo ENTRY_CITY; ?><?php echo ((int)ENTRY_CITY_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
</div>

<div class="form-floating mb-3">
    <?php echo zen_get_country_list('zone_country_id', $entry->fields['entry_country_id'], 'id="country" class="form-select"' . (($flag_show_pulldown_states === true) ? ' onchange="update_zone(this.form);"' : '')); ?>
    <label class="form-label" for="country"><?php echo ENTRY_COUNTRY; ?><span class="text-danger">*</span></label>
</div>

<?php
if (ACCOUNT_STATE === 'true') {
    if ($flag_show_pulldown_states === true) {
?>
<div class="form-floating mb-3">
    <?php echo zen_draw_pull_down_menu('zone_id', zen_prepare_country_zones_pull_down($selected_country), $zone_id, 'id="stateZone" class="form-select"'); ?>
    <label class="form-label" for="stateZone" id="zoneLabel"><?php echo ENTRY_STATE; ?><?php if (!empty(ENTRY_STATE_TEXT)) echo '<span class="text-danger">*</span>'; ?></label>
</div>
<?php
    }
?>
<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('state', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '40') . ' id="state" placeholder="' . ENTRY_STATE_TEXT . '" class="form-control"'); ?>
    <label class="form-label" for="state" id="stateLabel"><?php echo $state_field_label; ?></label>
</div>
<?php
    if ($flag_show_pulldown_states === false) {
        echo zen_draw_hidden_field('zone_id', $zone_name, ' ');
    }
}
?>

<div class="form-floating mb-3">
    <?php echo zen_draw_input_field('postcode', $entry->fields['entry_postcode'], zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' id="postcode" placeholder="' . ENTRY_POST_CODE_TEXT . '" class="form-control"' . ((int)ENTRY_POSTCODE_MIN_LENGTH > 0 ? ' required' : '')); ?>
    <label class="form-label" for="postcode"><?php echo ENTRY_POST_CODE; ?><?php echo ((int)ENTRY_POSTCODE_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
</div>

<?php
if ($current_page_base === FILENAME_ADDRESS_BOOK_PROCESS && (!isset($_GET['edit']) || (int)$_SESSION['customer_default_address_id'] !== (int)$_GET['edit'])) {
?>
<div class="form-check mb-3">
    <?php echo zen_draw_checkbox_field('primary', 'on', false, 'id="primary" class="form-check-input"') . ' <label class="form-check-label" for="primary">' . SET_AS_PRIMARY . '</label>'; ?>
</div>
<?php
}
