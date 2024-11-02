<?php
/**
 * Module Template - for shipping-estimator display
 *
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Steve 2022 Jun 29 Modified in v1.5.8-alpha $
 */
if ($_SESSION['cart']->count_contents() === 0) {
    return;
}

if (empty($extra)) {
    $extra = '';
} else {
    $extra = ' class="' . $extra . '"';
}

// -----
// NOTE: Since, for the Bootstrap template, the shipping estimator's popup displays
// as a modal, the link for its form is *always* the 'shopping_cart' page instead of
// possibly also being the popup_shipping_estimator!
//
?>
<div id="shippingEstimatorContent" class="mx-auto">
    <a id="seView"></a>
<?php
if (SHOW_SHIPPING_ESTIMATOR_BUTTON === '2') {
?>
    <h2 class="text-center"><?= CART_SHIPPING_OPTIONS ?></h2>
<?php
}

if (!empty($totalsDisplay)) {
?>
    <div class="text-center mb-3"><?= $totalsDisplay ?></div>
<?php 
}
?>
    <div class="row">
        <div class="col-md-6 col-lg-4">
            <?= zen_draw_form('estimator', zen_href_link(FILENAME_SHOPPING_CART . '#seView', '', $request_type), 'post') ?>
<?php
if (is_array($selected_shipping)) {
    echo zen_draw_hidden_field('scid', $selected_shipping['id']);
}
echo zen_draw_hidden_field('action', 'submit');

if (zen_is_logged_in() && !zen_in_guest_checkout()) {
    // only display addresses if more than 1
    if ($addresses->RecordCount() > 1) {
?>
            <div class="form-floating mb-3">
                <?= zen_draw_pull_down_menu('address_id', $addresses_array, $selected_address, 'onchange="return shipincart_submit();" id="seAddressPulldown" class="form-select" aria-label="' . CART_SHIPPING_METHOD_ADDRESS . '"') ?>
                <label for="seAddressPulldown"><?= CART_SHIPPING_METHOD_ADDRESS ?></label>
            </div>
<?php
    }
?>
            <div class="fw-bold mb-2" id="seShipTo"><?= CART_SHIPPING_METHOD_TO ?></div>
            <address><?= zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br>') ?></address>
<?php
} elseif ($_SESSION['cart']->get_content_type() !== 'virtual') {
    $flag_show_pulldown_states = (ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN === 'true');
?>
            <div class="form-floating mb-3">
                <?= zen_get_country_list('zone_country_id', $selected_country, 'id="country" class="form-select"' . (($flag_show_pulldown_states === true) ? ' onchange="update_zone(this.form);"' : '') . ' aria-label="' . ENTRY_COUNTRY . '"') ?>
                <label for="country"><?= ENTRY_COUNTRY ?></label>
            </div>
<?php
    if ($flag_show_pulldown_states === true) {
?>
            <div class="form-floating mb-3">
                <?= zen_draw_pull_down_menu('zone_id', zen_prepare_country_zones_pull_down($selected_country), $state_zone_id, 'id="stateZone" class="form-select" aria-label="' . ENTRY_STATE . '"') ?>
                <label for="stateZone" id="zoneLabel"><?= ENTRY_STATE ?></label>
            </div>
<?php
    }
?>
            <div class="form-floating mb-3">
                <?= zen_draw_input_field('state', $selectedState, zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '40') . ' id="state" class="form-control" placeholder="' . ($state_field_label ?? '') . '"') ?>
                <label for="state" id="stateLabel"><?= $state_field_label ?? '' ?></label>
            </div>
<?php
    if (CART_SHIPPING_METHOD_ZIP_REQUIRED === 'true') {
?>
            <div class="form-floating mb-3">
                <?= zen_draw_input_field('postcode', $postcode, 'id="postcode" class="form-control" placeholder="' . ENTRY_POST_CODE . '"') ?>
                <label for="postcode"><?= ENTRY_POST_CODE ?></label>
            </div>
<?php
    }
?>
            <div class="d-flex justify-content-end mt-3 mb-3">
                <?= zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT, '', 'btn btn-primary') ?>
            </div>
<?php
}
?>
            <?= '</form>' ?>
        </div>
        <div class="col-md-6 col-lg-8">
<?php
if ($_SESSION['cart']->get_content_type() === 'virtual') {
    echo CART_SHIPPING_METHOD_FREE_TEXT .  ' ' . CART_SHIPPING_METHOD_ALL_DOWNLOADS;
} elseif ($free_shipping == 1) {
    echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER));
} else {
    if (!zen_is_logged_in() || zen_in_guest_checkout()) {
?>
            <div>
                <div class="pb-2"><?= CART_SHIPPING_QUOTE_CRITERIA ?></div>
                <div class="pb-2">
                    <?= zen_get_zone_name((int)$selected_country, (int)$state_zone_id, '') .
                              ($selectedState != '' ? ' ' . $selectedState : '') . ' ' .
                              ($order->delivery['postcode'] ?? '') . ' ' .
                              zen_get_country_name($order->delivery['country_id']) ?>
                </div>
            </div>
<?php 
    }
?>
            <table class="table table-striped" id="seQuoteResults">
                <thead>
                    <tr>
                        <th scope="col" id="seProductsHeading"><?= CART_SHIPPING_METHOD_TEXT ?></th>
                        <th scope="col" id="seTotalHeading" class="text-end"><?= CART_SHIPPING_METHOD_RATES ?></th>
                    </tr>
                </thead>
                <tbody>
<?php
    foreach ($quotes as $next_module) {
        $thisquoteid = '';
        if (empty($next_module['module'])) {
            continue;
        }

        if (!empty($next_module['error'])) {
?>
                    <tr<?= $extra ?>>
                        <td colspan="2">
                            <?= $next_module['module'] ?>
                            <?= !empty($next_module['icon']) ? $next_module['icon'] : '' ?>
                            &nbsp;<?= $next_module['error'] ?>
                        </td>
                    </tr>
<?php
            continue;
        }

        if (empty($next_module['methods']) || !is_array($next_module['methods'])) {
            continue;
        }

        foreach ($next_module['methods'] as $next_method) {
            $thisquoteid = $next_module['id'] . '_' . $next_method['id'];
            $extra_class = ($selected_shipping['id'] === $thisquoteid) ? 'fw-bold' : '';
?>
                    <tr<?= $extra ?>>
                        <td class="<?= $extra_class ?>">
                            <?= $next_module['module'] ?>&nbsp;(<?= $next_method['title'] ?>)
                        </td>
                        <td class="cartTotalDisplay text-end <?= $extra_class ?>">
                            <?= $currencies->format(zen_add_tax($next_method['cost'], $next_module['tax'] ?? 0)) ?>
                        </td>
                    </tr>
<?php
        }
    }
?>
                </tbody>
            </table>
        </div>
<?php
}
?>
    </div>
</div>
