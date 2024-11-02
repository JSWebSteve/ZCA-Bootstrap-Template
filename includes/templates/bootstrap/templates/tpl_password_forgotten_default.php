<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: rbarbour zcadditions.com Fri Feb 26 00:03:33 2016 -0500 Modified in v1.5.5 $
 */
?>
<div id="passwordForgottenDefault" class="centerColumn">
    <?php echo zen_draw_form('password_forgotten', zen_href_link(FILENAME_PASSWORD_FORGOTTEN, 'action=process', 'SSL')); ?>
<?php
if ($messageStack->size('password_forgotten') > 0) {
    echo $messageStack->output('password_forgotten');
}
?>
        <div id="passwordForgottenDefault-content" class="content mb-3"><?php echo TEXT_MAIN; ?></div>

        <div id="passwordForgottenDefault-card" class="card mb-3">
            <h4 id="passwordForgottenDefault-card-header" class="card-header"><?php echo HEADING_TITLE; ?></h4>
            <div id="passwordForgottenDefault-card-body" class="card-body p-3">
                <div id="passwordForgottenDefault-required-info" class="required-info text-end"><?php echo FORM_REQUIRED_INFORMATION; ?></div>

                <div class="form-floating mb-3">
                    <?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address" autocomplete="username" placeholder="' . ENTRY_EMAIL_ADDRESS . '" class="form-control" required', 'email'); ?>
                    <label class="form-label" for="email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?><span class="text-danger">*</span></label>
                </div>
            </div>
        </div>

        <div id="passwordForgottenDefault-btn-toolbar" class="d-flex justify-content-between" role="toolbar" aria-label="Password forgotten form buttons">
            <?php echo zca_back_link(); ?>
            <?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT, '', 'btn btn-primary'); ?>
        </div>

    <?php echo '</form>'; ?>
</div>
