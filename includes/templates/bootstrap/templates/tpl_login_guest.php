<?php
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 (cindy@vinosdefrutastropicales.com).
// Copyright (C) 2017-2022, Vinos de Frutas Tropicales.  All rights reserved.
//
// Last updated: OPC v2.4.2/Bootstrap v5.0.0
//
?>
<div id="loginOpcDefault" class="centerColumn">
    <h1 id="loginDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<?php 
if ($messageStack->size('login') > 0) {
    echo $messageStack->output('login');
}

// -----
// The 'presumed' name of the login-form has changed in zc157 and is used by the login-page's
// onload javascript processing.  Determine the name to use for that form, based on the
// site's current Zen Cart version.
//
$login_formname = (PROJECT_VERSION_MAJOR . '.' . PROJECT_VERSION_MINOR >= '1.5.7') ? 'loginForm' : 'login';

//$block_class = 'opc-block-' . $num_columns;
$bs_column_width = ($num_columns > 0) ? 12 / $num_columns : 1;
$block_class = 'col-md-' . $bs_column_width;
?>
    <div class="row">
<?php
foreach ($column_blocks as $display_blocks) {
    if (count($display_blocks) > 0) {
?>
        <div class="opc-block <?php echo $block_class; ?>">
<?php
        foreach ($display_blocks as $current_block) {
            switch ($current_block) {
                // -----
                // Existing customer login
                //
                case 'L':
?>
            <div id="returningCustomers-card" class="card mb-2">
                <h2 id="returningCustomers-card-header" class="card-header"><?php echo HEADING_RETURNING_CUSTOMER_OPC; ?></h2>
                <div id="returningCustomers-card-body" class="card-body" aria-labelledby="returningCustomers-card-header">
                    <div class="card-text"><?php echo TEXT_RETURNING_CUSTOMER_OPC; ?>
<?php 
                    echo zen_draw_form($login_formname, zen_href_link(FILENAME_LOGIN, 'action=process' . (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL'), 'post', 'id="loginForm"'); 
?>
                    <div class="form-floating mb-3">
                        <?php echo zen_draw_input_field('email_address', '', 'size="18" id="login-email-address" autocomplete="username" class="form-control" placeholder="' . ENTRY_EMAIL_ADDRESS . '"' . ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? ' required' : ''), 'email'); ?>
                        <label class="form-label" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?><?php echo ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
                    </div>

                    <div class="form-floating mb-3">
                        <?php echo zen_draw_password_field('password', '', 'size="18" id="login-password" autocomplete="current-password" class="form-control" placeholder="' . ENTRY_PASSWORD . '"' . ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? ' required' : '')); ?>
                        <label class="form-label" for="login-password"><?php echo ENTRY_PASSWORD; ?><?php echo ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? '<span class="text-danger">*</span>' : ''); ?></label>
                    </div>

                    <div id="opc-pwf"><?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></div>
                    <div class="d-flex justify-content-end"><?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT, 'class="btn btn-primary"'); ?></div>
<?php
                    echo '</form>';
?>
                    </div>
                </div>
            </div>
<?php
                    break;

                // -----
                // PayPal Express Checkout Shortcut Button.
                //
                // Note: OPC v2.4.1 introduces a flag that indicates whether the 'divider' should be displayed
                // before or after the PPEC button.  The 'legacy' default is 'next' (i.e. after the button).
                //
                case 'P':
                    if (!isset($ppec_divider_location)) {
                        $ppec_divider_location = 'next';
                    }
                    if ($ppec_divider_location === 'prev') {
?>
            <hr>
<?php
                        echo TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER;
                    }
?>
            <div class="information"><?php echo TEXT_NEW_CUSTOMER_INTRODUCTION_SPLIT; ?></div>
            <div class="text-center"><?php require DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php'; ?></div>
<?php
                    if ($ppec_divider_location === 'next') {
?>
            <hr>
<?php
                        echo TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER;
                    }
                    break;

                // -----
                // Guest-checkout link
                //
                case 'G':
?>
            <div id="guestCustomers-card" class="card mb-2">
                <h2 id="guestCustomers-card-header" class="card-header"><?php echo HEADING_GUEST_OPC; ?></h2>
                <div id="guestCustomers-card-body" class="card-body" aria-labelledby="guestCustomers-card-header">
                    <div class="card-text"><?php echo TEXT_GUEST_OPC; ?>
<?php
                    if (!$guest_active) {
                        echo zen_draw_form('guest', zen_href_link(FILENAME_CHECKOUT_ONE, '', 'SSL'), 'post') . zen_draw_hidden_field('guest_checkout', 1);
?>
                    <div class="d-flex justify-content-end"><?php echo zen_image_submit(BUTTON_IMAGE_CHECKOUT, BUTTON_CHECKOUT_ALT, 'class="btn btn-primary"'); ?></div>
<?php
                        echo '</form>';
                    } else {
?>
                    <div class="d-flex justify-content-end">
                        <?php echo zca_button_link(zen_href_link(FILENAME_CHECKOUT_ONE, '', 'SSL'), BUTTON_GUEST_CHECKOUT_CONTINUE, 'button_continue btn btn-primary'); ?>
                    </div>
<?php
                    }
?>
                    </div>
                </div>
            </div>
<?php
                    break;

                // -----
                // Create/register account link.
                //
                case 'C':
?>
            <div id="newCustomers-card" class="card mb-2">
                <h2 id="newCustomers-card-header" class="card-header"><?php echo HEADING_NEW_CUSTOMER_OPC; ?></h2>
                <div id="newCustomers-card-body" class="card-body" aria-labelledby="newCustomers-card-header">
                    <div class="card-text"><?php echo TEXT_NEW_CUSTOMER_OPC; ?>
<?php 
                    echo zen_draw_form('create', zen_href_link(FILENAME_CREATE_ACCOUNT, (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL'), 'post');
?>
                        <div class="d-flex justify-content-end"><?php echo zen_image_submit(BUTTON_IMAGE_CREATE_ACCOUNT, BUTTON_CREATE_ACCOUNT_ALT, 'class="btn btn-primary"'); ?></div>
<?php
                    echo '</form>';
?>
                    </div>
                </div>
            </div>
<?php
                    break;

                // -----
                // Account benefits display
                //
                case 'B':
?>
            <div id="accountBenefits-card" class="card mb-2">
                <h2 id="accountBenefits-card-header" class="card-header"><?php echo HEADING_ACCOUNT_BENEFITS_OPC; ?></h2>
                <div id="accountBenefits-card-body" class="card-body" aria-labelledby="accountBenefits-card-header">
                    <div class="card-text"><?php echo TEXT_ACCOUNT_BENEFITS_OPC; ?></div>
<?php
                    for ($i = 1; $i < 5; $i++) {
                        $benefit_heading = "HEADING_BENEFIT_$i";
                        $benefit_text = "TEXT_BENEFIT_$i";
                        if (defined($benefit_heading) && constant($benefit_heading) != '' && defined($benefit_text) && constant($benefit_text) != '') {
?>
                    <div class="card mt-2">
                        <h3 class="card-header"><?php echo constant($benefit_heading); ?></h3>
                        <div class="card-body"><?php echo constant($benefit_text); ?></div>
                    </div>
<?php
                        }
                    }
?>
                </div>
            </div>
<?php
                    break;

                // -----
                // Anything else, nothing to do.
                //
                default:
                    break;
            }
        }
?>
        </div>
<?php
    }
}
?>
        <div class="clearBoth"></div>
    </div>
</div>
