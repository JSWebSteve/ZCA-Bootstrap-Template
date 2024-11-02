<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * Loaded automatically by index.php?main_page=account_password.<br />
 * Allows customer to change their password
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rbarbour zcadditions.com Fri Feb 26 00:03:33 2016 -0500 Modified in v1.5.5 $
 */
?>
<div id="accountPasswordDefault" class="centerColumn">
    <?php echo zen_draw_form('account_password', zen_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL'), 'post', 'onsubmit="return check_form(account_password);"') . zen_draw_hidden_field('action', 'process'); ?>

        <div id="myPassword-card" class="card mb-3">
            <h4 id="myPassword-card-header" class="card-header"><?php echo HEADING_TITLE; ?></h4>
            <div id="myPassword-card-body" class="card-body p-3" aria-labelledby="myPassword-card-header">
                <div class="required-info text-end mb-3"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<?php
if ($messageStack->size('account_password') > 0) {
    echo $messageStack->output('account_password');
}
?>
                <div class="form-floating mb-3">
                    <?php echo zen_draw_password_field('password_current', '', 'id="password-current" autocomplete="current-password" placeholder="' . ENTRY_PASSWORD_CURRENT_TEXT . '" class="form-control" required'); ?>
                    <label class="form-label" for="password-current"><?php echo ENTRY_PASSWORD_CURRENT; ?><span class="text-danger">*</span></label>
                </div>

                <div class="form-floating mb-3">
                    <?php echo zen_draw_password_field('password_new', '', 'id="password-new" autocomplete="new-password" placeholder="' . ENTRY_PASSWORD_NEW_TEXT . '" class="form-control" required'); ?>
                    <label class="form-label" for="password-new"><?php echo ENTRY_PASSWORD_NEW; ?><span class="text-danger">*</span></label>
                </div>

                <div class="form-floating mb-3">
                    <?php echo zen_draw_password_field('password_confirmation', '', 'id="password-confirm" autocomplete="new-password" placeholder="' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '" class="form-control" required'); ?>
                    <label class="form-label" for="password-confirm"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?><span class="text-danger">*</span></label>
                </div>

                <div id="myPassword-btn-toolbar" class="d-flex justify-content-end my-3" role="toolbar">
                    <?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT, '', 'btn btn-primary'); ?>
                </div>
            </div>
        </div>

        <div id="accountPasswordDefault-btn-toolbar" class="d-flex justify-content-start my-3" role="toolbar">
             <?php echo zca_button_link(zen_href_link(FILENAME_ACCOUNT, '', 'SSL'), BUTTON_BACK_ALT, 'button_back'); ?>
        </div>

    <?php echo '</form>'; ?>
</div>
