<?php
// -----
// Part of the One-Page Checkout plugin, provided under GPL 2.0 license by lat9 (cindy@vinosdefrutastropicales.com).
// Copyright (C) 2013-2024, Vinos de Frutas Tropicales.  All rights reserved.
//
// BOOTSTRAP v5.0.0
//
// -----
// The "display: none;" on the loading icon enables that to "not display" if javascript is disabled in the customer's browser.  The
// page's jscript_main.php handling will "show" that when javascript is enabled and we're not forcing the confirmation-page's display.
//
?>
<div id="checkoutOneConfirmation<?php echo ($confirmation_required === true) ? 'Display' : ''; ?>" class="centerColumn">
<?php
// -----
// If the current payment method requires that the confirmation page be displayed ...
//
if ($confirmation_required === true) {
?>
    <h1 id="checkoutConfirmDefaultHeading"><?php echo HEADING_TITLE; ?></h1>
<?php
    if ($messageStack->size('redemptions') > 0) {
        echo $messageStack->output('redemptions');
    }
    if ($messageStack->size('checkout_confirmation') > 0) {
        echo $messageStack->output('checkout_confirmation');
    }
    if ($messageStack->size('checkout') > 0) {
        echo $messageStack->output('checkout');
    }
?>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <div class="col">
            <div id="billingAddress-card" class="card h-100">
                <h4 id="billingAddress-card-header" class="card-header"><?php echo HEADING_BILLING_ADDRESS; ?></h4>
                <div id="billingAddress-card-body" class="card-body p-3" aria-labelledby="billingAddress-card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="billToAddress-card" class="card h-100">
                                <div id="billToAddress-card-body" class="card-body">
                                    <address><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br>'); ?></address>
<?php 
    if ($flagDisablePaymentAddressChange === false) { 
?>
                                    <div id="billToAddress-btn-toolbar" class="d-flex justify-content-end mt-3" role="toolbar">
                                        <?php echo zca_button_link(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'), BUTTON_EDIT_SMALL_ALT, 'button_back small_edit'); ?>
                                    </div>
<?php 
    } 
?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div id="paymentMethod-card" class="card h-100">
                                <h4 id="paymentMethod-card-header" class="card-header"><?php echo HEADING_PAYMENT_METHOD; ?></h4>
                                <div id="paymentMethod-card-body" class="card-body" aria-labelledby="paymentMethod-card-header">
                                    <h5 id="paymentMethod-paymentTitle"><?php echo $payment_title; ?></h5>
<?php
    if (!empty($confirmation_title)) {
?>
                                    <div id="paymentMethod-content" class="content"><?php echo $confirmation_title; ?></div>
<?php
    }
    if (!empty($confirmation_fields)) {
?>
                                    <div id="paymentMethod-content-one" class="content">
<?php
        foreach ($confirmation_fields as $next_field) {
?>
                                        <div><?php echo $next_field['title']; ?></div>
                                        <div><?php echo $next_field['field']; ?></div>
<?php
        }
?>
                                    </div>
<?php
    }
?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php
    if ($_SESSION['sendto'] !== false) {
?>
        <div class="col">
            <div id="deliveryAddress-card" class="card h-100">
                <h4 id="deliveryAddress-card-header" class="card-header"><?php echo HEADING_DELIVERY_ADDRESS; ?></h4>
                <div id="deliveryAddress-card-body" class="card-body p-3" aria-labelledby="deliveryAddress-card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <div id="shipToAddress-card" class="card h-100">
                                <div id="shipToAddress-card-body" class="card-body">
                                    <address><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>'); ?></address>
                                    <div id="shipToAddress-btn-toolbar" class="d-flex justify-content-end mt-3" role="toolbar">
                                        <?php echo zca_button_link($editShippingButtonLink, BUTTON_EDIT_SMALL_ALT, 'button_back small_edit'); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
<?php
        if (!empty($order->info['shipping_method'])) {
?>
                        <div class="col-md-6">
                            <div id="shippingMethod-card" class="card h-100">
                                <h4 id="shippingMethod-card-header" class="card-header"><?php echo HEADING_SHIPPING_METHOD; ?></h4>
                                <div id="shippingMethod-card-body" class="card-body" aria-labelledby="shippingMethod-card-header">
                                    <h5><?php echo $order->info['shipping_method']; ?></h5>
                                </div>
                            </div>
                        </div>
<?php
        }
?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
?>
    </div>

    <div id="orderComment-card" class="card mt-4">
        <h4 id="orderComment-card-header" class="card-header"><?php echo HEADING_ORDER_COMMENTS; ?></h4>
        <div id="orderComment-card-body" class="card-body p-3" aria-labelledby="orderComment-card-header">
<?php echo (empty($order->info['comments']) ? NO_COMMENTS_TEXT : nl2br(zen_output_string_protected($order->info['comments'])) . zen_draw_hidden_field('comments', $order->info['comments'])); ?>

            <div id="orderComment-btn-toolbar" class="d-flex justify-content-end mt-3" role="toolbar">
                <?php echo zca_button_link(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'), BUTTON_EDIT_SMALL_ALT, 'button_back small_edit'); ?>
            </div>
        </div>
    </div>

    <div id="cartContents-card" class="card mt-4">
        <h4 id="cartContents-card-header" class="card-header"><?php echo HEADING_PRODUCTS; ?></h4>
        <div id="cartContents-card-body" class="card-body p-3" aria-labelledby="cartContents-card-header">
<?php  
if ($flagAnyOutOfStock) {
    if (STOCK_ALLOW_CHECKOUT === 'true') {  
?>
            <div class="alert alert-danger" role="alert"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>
<?php    
    } else { 
?>
            <div class="alert alert-danger" role="alert"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>
<?php    
    } //endif STOCK_ALLOW_CHECKOUT
} //endif flagAnyOutOfStock 
?>
            <div class="table-responsive">
<?php
    $tax_column_present = (count($order->info['tax_groups']) > 1);
    $_SESSION['zca_bootstrap_ot_colspan'] = ($tax_column_present) ? '3' : '2';
?>
                <table id="shoppingCartDefault-cartTableDisplay" class="cartTableDisplay table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col" id="cartTableDisplay-qtyHeading"><?php echo TABLE_HEADING_QUANTITY; ?></th>
                            <th scope="col" id="cartTableDisplay-productsHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
<?php
    if ($tax_column_present) {
?>
                            <th scope="col" id="cartTableDisplay-taxHeading"><?php echo HEADING_TAX; ?></th>
<?php
    }
?>
                            <th scope="col" id="cartTableDisplay-totalHeading"><?php echo TABLE_HEADING_TOTAL; ?></th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
    for ($i = 0, $n = count($order->products); $i < $n; $i++) {
?>
                        <tr>
                            <td class="qtyCell"><?php echo $order->products[$i]['qty']; ?>&nbsp;x</td>
                            <td class="productsCell"><?php echo $order->products[$i]['name'] . ((!empty($stock_check[$i])) ? $stock_check[$i] : ''); ?>
<?php 
        if (isset($order->products[$i]['attributes']) && count($order->products[$i]['attributes']) > 0) {
?>
                                <div class="productsCell-attributes">
                                    <ul class="list-unstyled">
<?php
            foreach ($order->products[$i]['attributes'] as $next_attribute) {
?>
                                        <li><?php echo $next_attribute['option'] . ': ' . nl2br(zen_output_string_protected($next_attribute['value'])); ?></li>
<?php
            } // end loop
?>
                                    </ul>
                                </div>
<?php
        } // endif attribute-info
    
        if (isset ($posStockMessage)) {
            echo '<br>' . $posStockMessage[$i];
        }
?>
                            </td>
<?php 
        if ($tax_column_present)  { 
?>
                            <td class="taxCell"><?php echo zen_display_tax_value($order->products[$i]['tax']); ?>%</td>
<?php    
        }  // endif tax info display  
?>
                            <td class="totalCell">
<?php
        echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);
        if ($order->products[$i]['onetime_charges'] != 0 ) {
            echo '<br> ' . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1);
        }
?>
                            </td>
                        </tr>
<?php  
    }  // end for loopthru all products 
?>
                    </tbody>
                </table>
<?php
    if (MODULE_ORDER_TOTAL_INSTALLED) {
        if ($confirmation_required === true) {
?>
                <div id="orderTotals">
                    <?php $order_total_modules->output(); ?>
                </div>
<?php
        }
    }
?>
            </div>
        </div>
    </div>
<?php
}  //-Display confirmation information, if required

echo zen_draw_form('checkout_confirmation', $form_action_url, 'post', 'id="checkout_confirmation"' . ($confirmation_required ? ' onsubmit="submitonce();"' : ''));
?>
    <div id="checkoutOneConfirmationButtons">
<?php
echo $payment_process_button;
?>
        <div class="text-end"><?php echo zen_image_submit(BUTTON_IMAGE_CONFIRM_ORDER, BUTTON_CONFIRM_ORDER_ALT, 'name="btn_submit" id="btn_submit"', 'btn btn-primary button_confirm'); ?></div>
    </div>
<?php
echo '</form>';
?>
    <div id="checkoutOneConfirmationLoading" style="display: none;">
        <?php echo 
            ((CHECKOUT_ONE_CONFIRMATION_INSTRUCTIONS === '') ? '' : (CHECKOUT_ONE_CONFIRMATION_INSTRUCTIONS . '<br><br>')) . 
            zen_image($template->get_template_dir (CHECKOUT_ONE_CONFIRMATION_LOADING, DIR_WS_TEMPLATE, $current_page_base ,'images') . '/' . CHECKOUT_ONE_CONFIRMATION_LOADING, CHECKOUT_ONE_CONFIRMATION_LOADING_ALT); ?>
    </div>
</div>
