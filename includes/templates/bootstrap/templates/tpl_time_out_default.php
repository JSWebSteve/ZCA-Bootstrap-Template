<?php
/**
 * Page Template
 *
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: mc12345678 2019 Apr 30 Modified in v1.5.6b $
 */
?>
<div id="timeOutDefault" class="centerColumn">

<?php
if (zen_is_logged_in()) {
?>
<h1 id="timeOutDefault-pageHeading" class="pageHeading"><?php echo HEADING_TITLE_LOGGED_IN; ?></h1>

<div id="timeOutDefault-content" class="content"><?php echo TEXT_INFORMATION_LOGGED_IN; ?></div>
<?php
  } else {
?>
<h1 id="timeOutDefault-pageHeading" class="pageHeading"><?php echo HEADING_TITLE; ?></h1>

<div id="timeOutDefault-content" class="content"><?php echo TEXT_INFORMATION; ?></div>

<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>

<div id="login-card" class="card">
  <h2 id="login-card-header" class="card-header">
    <?php echo HEADING_RETURNING_CUSTOMER; ?>
  </h2>
  <div id="login-card-body" class="card-body">
    <div class="form-floating mb-3">
      <?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address" class="form-control" placeholder="' . ENTRY_EMAIL_ADDRESS . '" autocomplete="username" required', 'email'); ?>
      <label class="form-label" for="login-email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?><span class="text-danger">*</span></label>
    </div>

    <div class="form-floating mb-3">
      <?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', 40) . ' id="login-password" class="form-control" placeholder="' . ENTRY_PASSWORD . '" autocomplete="current-password" required'); ?>
      <label class="form-label" for="login-password"><?php echo ENTRY_PASSWORD; ?><span class="text-danger">*</span></label>
    </div>

    <?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>

    <div id="timeOutDefault-btn-toolbar" class="d-flex justify-content-between align-items-center my-3" role="toolbar">
      <?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
      <?php echo zen_image_submit(BUTTON_IMAGE_LOGIN, BUTTON_LOGIN_ALT, '', 'btn btn-primary'); ?>
    </div>

  </div>
</div>

</form>

<?php
 }
 ?>
</div>
