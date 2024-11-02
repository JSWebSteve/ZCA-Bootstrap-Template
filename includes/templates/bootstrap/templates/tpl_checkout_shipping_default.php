<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * Loaded automatically by index.php?main_page=checkout_shipping.<br>
 * Displays allowed shipping modules for selection by customer.
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Oct 29 Modified in v1.5.7a $
 */
?>
<div id="checkoutShippingDefault" class="centerColumn">
    <div class="progress">
        <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
    </div>

    <?php echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL')) . zen_draw_hidden_field('action', 'process'); ?>

    <h1 class="pageHeading"><?php echo HEADING_TITLE; ?></h1>

<?php
if ($messageStack->size('checkout_shipping') > 0) {
    echo $messageStack->output('checkout_shipping');
}
?>
    <div class="row">
        <div class="col-md-6">
            <div id="shippingInformation-card" class="card mb-3">
                <h2 id="shippingInformation-card-header" class="card-header"><?php echo TITLE_SHIPPING_ADDRESS; ?></h2>
                <div id="shippingInformation-card-body" class="card-body p-3" aria-labelledby="shippingInformation-card-header">
                    <div class="row">
                        <div id="shippingInformation-shipToAddress" class="shipToAddress col-sm-5">
                            <address><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['sendto'], true, ' ', '<br>'); ?></address>      
                        </div>
                        <div class="col-sm-7">
                            <?php echo TEXT_CHOOSE_SHIPPING_DESTINATION; ?>
<?php
if ($displayAddressEdit) {
?>
                            <div class="d-flex justify-content-end mt-3" role="toolbar">
                                <?php echo zca_button_link($editShippingButtonLink, BUTTON_CHANGE_ADDRESS_ALT, 'button_change_address'); ?>
                            </div>
<?php
}
?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
<?php
if (zen_count_shipping_modules() > 0) {
?>
        <div id="shippingMethod-card" class="card mb-3">
            <h2 id="shippingMethod-card-header" class="card-header"><?php echo HEADING_SHIPPING_METHOD; ?></h2>
            <div id="shippingMethod-card-body" class="card-body p-3" aria-labelledby="shippingMethod-card-header">
<?php
    if (count($quotes) > 1 && count($quotes[0]) > 1) {
?>
                <div id="shippingMethod-content" class="content"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></div>
 
<?php
    } elseif ($free_shipping === false) {
?>
                <div id="shippingMethod-content-one" class="content"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></div>
<?php
    }
?>
<?php
    if ($free_shipping === true) {
?>
                <div id="shippingMethod-content-two" class="content"><?php echo FREE_SHIPPING_TITLE . (isset($quotes[$i]['icon']) ? '&nbsp;' . $quotes[$i]['icon'] : ''); ?></div>

                <div id="shippingMethod-selected" class="selected"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . zen_draw_hidden_field('shipping', 'free_free'); ?></div>
<?php
    } else {
        $radio_buttons = 0;
        for ($i = 0, $n = count($quotes); $i < $n; $i++) {
            if (!empty($quotes[$i]['module'])) {
?>
                    <div class="card mb-3">
                        <div class="card-header">
                            <?php echo $quotes[$i]['module']; ?>&nbsp;
<?php
                if (!empty($quotes[$i]['icon'])) {
                    echo $quotes[$i]['icon'];
                }
?>
                        </div>
                        <div class="card-body p-3">
<?php
                if (isset($quotes[$i]['error'])) {
?>
                            <div><?php echo $quotes[$i]['error']; ?></div>
<?php
                } else {
                    for ($j = 0, $n2 = count($quotes[$i]['methods']); $j < $n2; $j++) {
                        $checked = false;
                        if (isset($_SESSION['shipping']) && isset($_SESSION['shipping']['id'])) {
                            $checked = ($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $_SESSION['shipping']['id']);
                        }

                        if ($n > 1 || $n2 > 1) {
?>
                            <div class="float-end"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></div>
<?php
                        } else {
?>
                            <div class="float-end"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . zen_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></div>
<?php
                        }
?>
                            <div class="form-check">
                                <?php echo zen_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked, 'id="ship-'.$quotes[$i]['id'] . '-' . str_replace(' ', '-', $quotes[$i]['methods'][$j]['id']) .'" class="form-check-input"'); ?>

                                <label for="ship-<?php echo $quotes[$i]['id'] . '-' . str_replace(' ', '-', $quotes[$i]['methods'][$j]['id']); ?>" class="form-check-label"><?php echo $quotes[$i]['methods'][$j]['title']; ?></label>
                            </div>
                            <div class="p-1"></div>
<?php
                        $radio_buttons++;
                    }
                }
?>
                        </div>
                    </div>
<?php
            }
        }
    }
?>
            </div>
        </div>
<?php
} else {
?>
        <div id="noShipping-card" class="card mb-3">
            <div id="noShipping-card-body" class="card-body p-3">
                <h2 class="pageHeading"><?php echo TITLE_NO_SHIPPING_AVAILABLE; ?></h2>
                <div class="content"><?php echo TEXT_NO_SHIPPING_AVAILABLE; ?></div>
            </div>
        </div>
<?php
}

$comments = (isset($comments)) ? $comments : '';
?>
        <div id="orderComments-card" class="card">
            <h2 id="orderComments-card-header" class="card-header"><?php echo HEADING_ORDER_COMMENTS; ?></h2>
            <div id="orderComments-card-body" class="card-body p-3" aria-labelledby="orderComments-card-header">
                <?php echo zen_draw_textarea_field('comments', '45', '3', $comments, 'id="comments" class="form-control" aria-label="' . HEADING_ORDER_COMMENTS . '"'); ?>
            </div>
        </div>
    </div>
</div>
<?php
$show_contact_us_instead_of_continue = $zca_show_contact_us_instead_of_continue ?? false;
if (empty($show_contact_us_instead_of_continue) || zen_count_shipping_modules() > 0) {
    $action_button = zen_image_submit(BUTTON_IMAGE_CONTINUE_CHECKOUT, BUTTON_CONTINUE_ALT, '', 'btn btn-primary button_continue');
    $instruction_title = TITLE_CONTINUE_CHECKOUT_PROCEDURE;
    $instruction_text = TEXT_CONTINUE_CHECKOUT_PROCEDURE;
} else {
    $action_button =
        '<a href="' . zen_href_link(FILENAME_CONTACT_US, '', 'SSL') . '" id="linkContactUs" class="btn btn-primary">' .
            zen_image(BUTTON_IMAGE_CONTACT_US, BUTTON_CONTACT_US_TEXT) .
        '</a>';
    $instruction_title = TITLE_NO_SHIPPING_AVAILABLE;
    $instruction_text = TEXT_NO_SHIPPING_AVAILABLE;
}
?>
    <div id="checkoutShippingDefault-btn-toolbar1" class="d-flex justify-content-between align-items-center mt-3" role="toolbar">
        <div>
            <strong><?php echo $instruction_title; ?></strong><br>
            <?php echo $instruction_text; ?>
        </div>
        <?php echo $action_button; ?>
    </div>
    <?php echo '</form>'; ?>
</div>
