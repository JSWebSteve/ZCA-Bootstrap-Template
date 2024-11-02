<?php
/**
 * tpl_modules_checkout_address_book.php
 * 
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_checkout_address_book.php 13799 2009-07-08 02:08:33Z drbyte $
 */
?>
<?php
/**
 * require code to get address book details
 */
require DIR_WS_MODULES . zen_get_module_directory('checkout_address_book.php');
foreach ($addresses as $address) {
    $address_book_id = (int)$address['address_book_id'];
    $selected = ($address_book_id === $_SESSION['sendto']);
    if ($current_page_base === FILENAME_CHECKOUT_PAYMENT_ADDRESS) {
        $selected = ($address_book_id === $_SESSION['billto']);
    }

    if ($selected === true) {
        $primary_class = ' primary-address';
        $primary_address = BOOTSTRAP_CURRENT_ADDRESS;
    } else {
        $primary_class = '';
        $primary_address = '';
    }
?>
<!--bof address book single entries card-->
<div id="cab-card-<?php echo $address_book_id; ?>" class="card mb-3<?php echo $primary_class; ?>" role="region" aria-labelledby="cab-card-header-<?php echo $address_book_id; ?>">
    <div id="cab-card-header-<?php echo $address_book_id; ?>" class="card-header">
        <div class="form-check">
            <?php echo zen_draw_radio_field('address', $address_book_id, $selected, 'id="name-' . $address_book_id . '" class="form-check-input" aria-label="' . zen_output_string_protected($address['firstname'] . ' ' . $address['lastname']) . '"'); ?>
            <label class="form-check-label" for="name-<?php echo $address_book_id; ?>"><?php echo zen_output_string_protected($address['firstname'] . ' ' . $address['lastname']) . $primary_address; ?></label>
        </div>
    </div>

    <div id="cab-card-body-<?php echo $address_book_id; ?>" class="card-body" aria-labelledby="cab-card-header-<?php echo $address_book_id; ?>">
        <address><?php echo zen_address_format(zen_get_address_format_id($address['country_id']), $address['address'], true, ' ', '<br>'); ?></address>
    </div>
</div>
<!--eof address book single entry card-->
<?php
}
?>
