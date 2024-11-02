<?php
/**
 * Page Template
 *
 * BOOTSTRAP v5.0.0
 *
 * Loaded automatically by index.php?main_page=checkout_success.<br />
 * Displays confirmation details after order has been successfully processed.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Mon Mar 23 13:48:06 2015 -0400 Modified in v1.5.5 $
 */
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 
// Copyright (C) 2018-2022, Vinos de Frutas Tropicales.  All rights reserved.
//
// Last updated: OPC v2.4.2/Bootstrap v3.4.0
//
?>
<div id="checkoutSuccess" class="centerColumn">
<?php 
if ($messageStack->size('checkout_success') > 0) {
    echo $messageStack->output('checkout_success');
}
?>
    <h1 id="checkoutSuccessHeading"><?php echo HEADING_TITLE; ?></h1>
    <div id="checkoutSuccessOrderNumber"><?php echo TEXT_YOUR_ORDER_NUMBER . $zv_orders_id; ?></div>
<?php
if ($offer_account_creation) {
?>
    <div id="checkoutSuccessGuestPassword" class="card mb-3 mt-2">
        <div class="card-body">
            <p class="card-title"><?php echo TEXT_GUEST_ADD_PWD_TO_CREATE_ACCT; ?></p>
            
            <?php echo zen_draw_form('guest-pwd', zen_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=create_account', 'SSL'), 'post'); ?>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <div class="form-floating">
                            <?php echo zen_draw_password_field('password', '', 'id="password-new" autocomplete="off" placeholder="' . ENTRY_PASSWORD_TEXT . '" class="form-control"'); ?>
                            <label for="password-new"><?php echo ENTRY_PASSWORD; ?></label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-floating">
                            <?php echo zen_draw_password_field('confirmation', '', 'id="password-confirm" autocomplete="off" placeholder="' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '" class="form-control"'); ?>
                            <label for="password-confirm"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></label>
                        </div>
                    </div>
                </div>
                <h3><?php echo ENTRY_EMAIL_PREFERENCE; ?></h3>
<?php
    if (ACCOUNT_NEWSLETTER_STATUS !== '0') {
?>
                <div class="form-check form-switch">
                    <?php echo zen_draw_checkbox_field('newsletter', '1', false, 'class="form-check-input" id="newsletter-checkbox"'); ?>
                    <label class="form-check-label" for="newsletter-checkbox"><?php echo ENTRY_NEWSLETTER; ?></label>
                </div>
                <?php echo (!empty(ENTRY_NEWSLETTER_TEXT) ? '<span class="alert">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''); ?>
<?php 
    } 
?>
                <div class="form-check form-check-inline ms-3">
                    <?php echo zen_draw_radio_field('email_format', 'HTML', ($email_format === 'HTML'),'id="email-format-html" class="form-check-input"'); ?>
                    <label class="form-check-label" for="email-format-html"><?php echo ENTRY_EMAIL_HTML_DISPLAY; ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <?php echo zen_draw_radio_field('email_format', 'TEXT', ($email_format === 'TEXT'), 'id="email-format-text" class="form-check-input"'); ?>
                    <label class="form-check-label" for="email-format-text"><?php echo ENTRY_EMAIL_TEXT_DISPLAY; ?></label>
                </div>
                
                <div class="text-end mt-3"><?php echo zen_image_submit(BUTTON_IMAGE_CREATE_ACCOUNT, BUTTON_CREATE_ACCOUNT_ALT, '', 'btn btn-primary'); ?></div>
            <?php echo '</form>'; ?>
        </div>
    </div>
<?php
}

if (DEFINE_CHECKOUT_SUCCESS_STATUS === '1' || DEFINE_CHECKOUT_SUCCESS_STATUS === '2') {
?>
    <div id="checkoutSuccessMainContent" class="content"><?php require $define_page; ?></div>
<?php 
} 

if (isset($additional_payment_messages) && $additional_payment_messages !== '') {
?>
    <div class="content"><?php echo $additional_payment_messages; ?></div>
<?php
}
?>
    <div id="checkoutSuccessOrderLink"><?php echo TEXT_SEE_ORDERS_GUEST;?></div>

    <div id="checkoutSuccessContactLink"><?php echo TEXT_CONTACT_STORE_OWNER;?></div>
<?php
require $template->get_template_dir('tpl_account_history_info_default.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_account_history_info_default.php';
?>
    <h3 id="checkoutSuccessThanks" class="text-center"><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h3>
</div>
