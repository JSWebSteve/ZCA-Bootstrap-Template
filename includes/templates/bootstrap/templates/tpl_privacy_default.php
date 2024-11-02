<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_privacy_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */
?>
<div id="privacyDefault" class="centerColumn">
    <h1 id="privacyDefault-pageHeading" class="pageHeading"><?php echo HEADING_TITLE; ?></h1>
<?php
if (DEFINE_PRIVACY_STATUS === '1' || DEFINE_PRIVACY_STATUS === '2') {
?>
    <div id="privacyDefault-defineContent" class="defineContent">
<?php
/**
 * require the html_define for the privacy page
 */
    require $define_page;
?>
    </div>
<?php
}
?>
    <div id="privacyDefault-btn-toolbar" class="d-flex justify-content-start my-3" role="toolbar" aria-label="Privacy page navigation">
        <?php echo zca_back_link(); ?>
    </div>
</div>
