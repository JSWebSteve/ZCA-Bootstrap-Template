<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Steve 2020 Jan 14 Modified in v1.5.7 $
 */
?>
<div id="loginDefault" class="centerColumn">
    <h1 id="loginDefault-pageHeading" class="pageHeading"><?php echo HEADING_TITLE; ?></h1>
<?php
if ($messageStack->size('login') > 0) {
    echo $messageStack->output('login');
}

if (USE_SPLIT_LOGIN_MODE === 'True' || $ec_button_enabled) {
?>
<!--BOF PPEC split login- DO NOT REMOVE-->

<!--bof new customers card-->
    <div id="newCustomers-card" class="card mb-3">
        <h2 id="newCustomers-card-header" class="card-header"><?php echo HEADING_NEW_CUSTOMER_SPLIT; ?></h2>
        <div id="newCustomers-card-body" class="card-body">

<?php
    // ** BEGIN PAYPAL EXPRESS CHECKOUT
    if ($ec_button_enabled) {
?>
            <div id="newCustomers-content" class="content"><?php echo TEXT_NEW_CUSTOMER_INTRODUCTION_SPLIT; ?></div>

            <div class="text-center"><?php require DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php'; ?></div>
            <hr>
            <?php echo TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER; ?>
<?php
    }
    // ** END PAYPAL EXPRESS CHECKOUT **
?>
            <div id="newCustomers-content-one" class="content"><?php echo TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT; ?></div>

            <?php echo zen_draw_form('create', zen_href_link(FILENAME_CREATE_ACCOUNT, (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL')); ?>
                <div id="newCustomers-btn-toolbar" class="d-flex justify-content-end my-3" role="toolbar">
                    <?php echo zen_image_submit(BUTTON_IMAGE_CREATE_ACCOUNT, BUTTON_CREATE_ACCOUNT_ALT, 'name="registrationButton" class="btn btn-primary"'); ?>
                </div>
            <?php echo '</form>'; ?>
        </div>
    </div>
<!--eof new customers card-->

<!--bof returning customers card-->
    <div id="returningCustomers-card" class="card mb-3">
        <h2 id="returningCustomers-card-header" class="card-header"><?php echo HEADING_RETURNING_CUSTOMER_SPLIT; ?></h2>
        <div id="returningCustomers-card-body" class="card-body">
            <div id="returningCustomers-content" class="content pb-3"><?php echo TEXT_RETURNING_CUSTOMER_SPLIT; ?></div>

            <?php echo zen_draw_form('loginForm', zen_href_link(FILENAME_LOGIN, 'action=process' . (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL'), 'post', 'id="loginForm"'); ?>
                <div class="form-floating mb-3">
                    <?php echo zen_draw_input_field('email_address', '', 'size="18" id="login-email-address" autocomplete="username" class="form-control" placeholder="' . ENTRY_EMAIL_ADDRESS . '"' . ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? ' required' : ''), 'email'); ?>
                    <label class="form-label" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
                </div>

                <div class="form-floating mb-3">
                    <?php echo zen_draw_password_field('password', '', 'size="18" id="login-password" autocomplete="current-password" class="form-control" placeholder="' . ENTRY_PASSWORD . '"' . ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? ' required' : '')); ?>
                    <label class="form-label" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
                </div>

                <div id="returningCustomers-btn-toolbar" class="d-flex justify-content-between align-items-center" role="toolbar">
                    <?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>' . zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT, 'class="btn btn-primary"'); ?>
                </div>
            <?php echo '</form>'; ?>
        </div>
    </div>
<!--eof returning customers card-->

<!--EOF PPEC split login- DO NOT REMOVE-->
<?php
} else {
?>
<!--BOF normal login-->
<?php
    if ($_SESSION['cart']->count_contents() > 0) {
        echo TEXT_VISITORS_CART;
?>
    <a data-bs-toggle="modal" href="#cartHelpModal"><?php echo TEXT_MORE_INFO; ?></a>
<?php
        require $template->get_template_dir('tpl_info_shopping_cart.php', DIR_WS_TEMPLATE, $current_page_base, 'modalboxes') . '/tpl_info_shopping_cart.php';
    }
?>
    <nav class="pt-3">
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-login-tab" data-bs-toggle="tab" data-bs-target="#nav-login" type="button" role="tab" aria-controls="nav-login" aria-selected="true"><?php echo HEADING_RETURNING_CUSTOMER; ?></button>
            <button class="nav-link" id="nav-create-tab" data-bs-toggle="tab" data-bs-target="#nav-create" type="button" role="tab" aria-controls="nav-create" aria-selected="false"><?php echo HEADING_NEW_CUSTOMER; ?></button>
        </div>
    </nav>

    <div class="tab-content mb-3" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-login" role="tabpanel" aria-labelledby="nav-login-tab">
            <?php echo zen_draw_form('loginForm', zen_href_link(FILENAME_LOGIN, 'action=process' . (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL'), 'post', 'id="loginForm"'); ?>
                <div class="form-floating mt-3 mb-3">
                    <?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address" autocomplete="username" class="form-control" placeholder="' . ENTRY_EMAIL_ADDRESS . '"' . ((int)ENTRY_EMAIL_ADDRESS_MIN_LENGTH > 0 ? ' required' : ''), 'email'); ?>
                    <label class="form-label" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
                </div>

                <div class="form-floating mb-3">
                    <?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', 40) . ' id="login-password" autocomplete="current-password" class="form-control" placeholder="' . ENTRY_PASSWORD . '"' . ((int)ENTRY_PASSWORD_MIN_LENGTH > 0 ? ' required' : '')); ?>
                    <label class="form-label" for="login-password"><?php echo ENTRY_PASSWORD; ?></label>
                </div>

                <?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>

                <div id="loginDefault-btn-toolbar" class="d-flex justify-content-between align-items-center" role="toolbar">
                    <?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>' . zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT, 'class="btn btn-primary"'); ?>
                </div>
            <?php echo '</form>'; ?>
        </div>
  
        <div class="tab-pane fade" id="nav-create" role="tabpanel" aria-labelledby="nav-create-tab">
            <?php echo zen_draw_form('createAccountForm', zen_href_link(FILENAME_CREATE_ACCOUNT, (isset($_GET['gv_no']) ? '&gv_no=' . preg_replace('/[^0-9.,%]/', '', $_GET['gv_no']) : ''), 'SSL'), 'post', 'onsubmit="return check_form(createAccountForm);" id="createAccountForm"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
                <div id="loginDefault-content" class="content pt-3"><?php echo TEXT_NEW_CUSTOMER_INTRODUCTION; ?></div>

                <?php require $template->get_template_dir('tpl_modules_create_account.php', DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/tpl_modules_create_account.php'; ?>

                <div id="loginDefault-btn-toolbar2" class="d-flex justify-content-end my-3" role="toolbar">
                    <?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT, 'class="btn btn-primary"'); ?>
                </div>
            <?php echo '</form>'; ?>
        </div>
    </div>
<!--EOF normal login-->
<?php
}
?>
</div>
