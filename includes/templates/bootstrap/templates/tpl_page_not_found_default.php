<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * Displays page-not-found message and site-map (if configured)
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Sat Oct 17 21:58:04 2015 -0400 Modified in v1.5.5 $
 */
?>
<div id="pageNotFoundDefault" class="centerColumn">
    <h1 id="pageNotFoundDefault-pageHeading" class="pageHeading"><?php echo HEADING_TITLE; ?></h1>
<?php
if (DEFINE_PAGE_NOT_FOUND_STATUS === '1') {
?>
    <div id="pageNotFoundDefault-defineContent" class="defineContent">
        <?php require $define_page; ?>
    </div>
<?php
}

echo $zen_SiteMapTree->buildTree();
?>
    
    <ul class="list-group">
<?php
if (SHOW_ACCOUNT_LINKS_ON_SITE_MAP === 'Yes') {
?>
        <li class="list-group-item">
            <a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo PAGE_ACCOUNT; ?></a>
            <ul class="list-group list-group-flush mt-2">
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'); ?>"><?php echo PAGE_ACCOUNT_EDIT; ?></a></li>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL'); ?>"><?php echo PAGE_ADDRESS_BOOK; ?></a></li>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'); ?>"><?php echo PAGE_ACCOUNT_HISTORY; ?></a></li>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL'); ?>"><?php echo PAGE_ACCOUNT_NOTIFICATIONS; ?></a></li>
            </ul>
        </li>
        <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART); ?>"><?php echo PAGE_SHOPPING_CART; ?></a></li>
        <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo PAGE_CHECKOUT_SHIPPING; ?></a></li>
<?php
}
?>
        <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_SEARCH); ?>"><?php echo PAGE_ADVANCED_SEARCH; ?></a></li>
        <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_PRODUCTS_NEW); ?>"><?php echo PAGE_PRODUCTS_NEW; ?></a></li>
        <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_SPECIALS); ?>"><?php echo PAGE_SPECIALS; ?></a></li>
        <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_REVIEWS); ?>"><?php echo PAGE_REVIEWS; ?></a></li>
        <li class="list-group-item">
            <?php echo BOX_HEADING_INFORMATION; ?>
            <ul class="list-group list-group-flush mt-2">
<?php
if (DEFINE_SHIPPINGINFO_STATUS <= '1') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_SHIPPING); ?>"><?php echo BOX_INFORMATION_SHIPPING; ?></a></li>
<?php
}

if (DEFINE_PRIVACY_STATUS <= '1') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_PRIVACY); ?>"><?php echo BOX_INFORMATION_PRIVACY; ?></a></li>
<?php
}

if (DEFINE_CONDITIONS_STATUS <= '1') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_CONDITIONS); ?>"><?php echo BOX_INFORMATION_CONDITIONS; ?></a></li>
<?php
}

if (DEFINE_CONTACT_US_STATUS <= '1') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_CONTACT_US, '', 'SSL'); ?>"><?php echo BOX_INFORMATION_CONTACT; ?></a></li>
<?php
}

if (!empty($external_bb_url) && !empty($external_bb_text)) {
?>
                <li class="list-group-item"><a href="<?php echo $external_bb_url; ?>" rel="noopener" target="_blank"><?php echo $external_bb_text; ?></a></li>
<?php
}

if (defined('MODULE_ORDER_TOTAL_GV_STATUS') && MODULE_ORDER_TOTAL_GV_STATUS === 'true') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_GV_FAQ); ?>"><?php echo BOX_INFORMATION_GV; ?></a></li>
<?php
}

if (defined('MODULE_ORDER_TOTAL_COUPON_STATUS') && MODULE_ORDER_TOTAL_COUPON_STATUS === 'true') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_DISCOUNT_COUPON); ?>"><?php echo BOX_INFORMATION_DISCOUNT_COUPONS; ?></a></li>
<?php
}

if (SHOW_NEWSLETTER_UNSUBSCRIBE_LINK === 'true') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_UNSUBSCRIBE); ?>"><?php echo BOX_INFORMATION_UNSUBSCRIBE; ?></a></li>
<?php
}

if (DEFINE_PAGE_2_STATUS <= '1') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_PAGE_2); ?>"><?php echo BOX_INFORMATION_PAGE_2; ?></a></li>
<?php
}

if (DEFINE_PAGE_3_STATUS <= '1') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_PAGE_3); ?>"><?php echo BOX_INFORMATION_PAGE_3; ?></a></li>
<?php
}

if (DEFINE_PAGE_4_STATUS <= '1') {
?>
                <li class="list-group-item"><a href="<?php echo zen_href_link(FILENAME_PAGE_4); ?>"><?php echo BOX_INFORMATION_PAGE_4; ?></a></li>
<?php
}
?>
            </ul>
        </li>
    </ul>

    <div id="pageNotFoundDefault-btn-toolbar" class="d-flex justify-content-start my-3" role="toolbar" aria-label="Page navigation toolbar">
        <?php echo zca_back_link(); ?>
    </div>
</div>
