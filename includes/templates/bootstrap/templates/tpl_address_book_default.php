<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * Loaded automatically by index.php?main_page=address_book.
 * Allows customer to manage entries in their address book
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_address_book_default.php 5369 2006-12-23 10:55:52Z drbyte $
 */
?>
<div id="addressBookDefault" class="centerColumn">
    <h1 id="addressBookDefault-pageHeading" class="pageHeading"><?php echo HEADING_TITLE; ?></h1>
<?php
if ($messageStack->size('addressbook') > 0) {
    echo $messageStack->output('addressbook');
}
?>
    <div id="primaryAddress-card" class="card mb-3">
        <h4 id="primaryAddress-card-header" class="card-header"><?php echo PRIMARY_ADDRESS_TITLE; ?></h4>
        <div id="primaryAddress-card-body" class="card-body p-3" aria-labelledby="primaryAddress-card-header">
            <div class="row">
                <div id="primaryAddress-content" class="content col-md-7">
                    <?php echo PRIMARY_ADDRESS_DESCRIPTION; ?>
                </div>

                <div id="primaryAddress-defaultAddress" class="defaultAddress col-md-5">
                    <address class="p-3"><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['customer_default_address_id'], true, ' ', '<br>'); ?></address>
                </div>
            </div>
        </div>
    </div>

    <div id="addressBookEntries-card" class="card mb-3">
        <h4 id="addressBookEntries-card-header" class="card-header"><?php echo ADDRESS_BOOK_TITLE; ?></h4>
        <div id="addressBookEntries-card-body" class="card-body p-3" aria-labelledby="addressBookEntries-card-header">
            <div class="required-info text-end mb-3"><?php echo sprintf(TEXT_MAXIMUM_ENTRIES, MAX_ADDRESS_BOOK_ENTRIES); ?></div>
<?php
/**
 * Used to loop thru and display address book entries
 */
foreach ($addressArray as $addresses) {
    if ($addresses['address_book_id'] == $_SESSION['customer_default_address_id']) {
        $primary_class = ' primary-address';
        $primary_address = PRIMARY_ADDRESS;
    } else {
        $primary_class = '';
        $primary_address = '';
    }
?>
            <div id="addressBookSingleEntryId<?php echo $addresses['address_book_id']; ?>-card" class="card mb-3<?php echo $primary_class; ?>">
                <h5 id="addressBookSingleEntryId<?php echo $addresses['address_book_id']; ?>-card-header" class="card-header">
                    <?php echo zen_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']) . $primary_address; ?>
                </h5>
                <div id="addressBookSingleEntryId<?php echo $addresses['address_book_id']; ?>-card-body" class="card-body p-3" aria-labelledby="addressBookSingleEntryId<?php echo $addresses['address_book_id']; ?>-card-header">
                    <address><?php echo zen_address_format($addresses['format_id'], $addresses['address'], true, ' ', '<br>'); ?></address>
                    <div class="d-flex justify-content-between" role="toolbar">
                        <?php echo zca_button_link(zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'edit=' . $addresses['address_book_id'], 'SSL'), BUTTON_EDIT_SMALL_ALT, 'small_edit'); ?>
<?php
    if ($primary_class === '') {
?>
                        <?php echo zca_button_link(zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $addresses['address_book_id'], 'SSL'), BUTTON_DELETE_SMALL_ALT, 'button_delete_small'); ?>
<?php
    }
?>
                    </div>
                </div>
            </div>
<?php
}
?>
        </div>
    </div>

    <div id="addressBookDefault-btn-toolbar" class="d-flex justify-content-between" role="toolbar">
        <?php echo zca_button_link(zen_href_link(FILENAME_ACCOUNT, '', 'SSL'), BUTTON_BACK_ALT, 'button_back'); ?>
<?php
if (count($addressArray) < MAX_ADDRESS_BOOK_ENTRIES) {
    echo zca_button_link(zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, '', 'SSL'),  BUTTON_ADD_ADDRESS_ALT, 'button_add_address');
}
?>
    </div>
</div>
