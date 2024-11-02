<?php
/**
 * also_purchased_products module
 * 
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Scott C Wilson 2020 Aug 07 Modified in v1.5.7a $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
if (isset($_GET['products_id']) && SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS > 0 && MIN_DISPLAY_ALSO_PURCHASED > 0) {
    $also_purchased_products = $db->ExecuteRandomMulti(sprintf(SQL_ALSO_PURCHASED, (int)$_GET['products_id'], (int)$_GET['products_id']), (int)MAX_DISPLAY_ALSO_PURCHASED);

    $num_products_ordered = $also_purchased_products->RecordCount();

    $row = 0;
    $col = 0;
    $list_box_contents = array();
    $title = '';

    if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED && $num_products_ordered > 0) {
        if ($num_products_ordered < SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS) {
            $col_width = floor(100/$num_products_ordered);
        } else {
            $col_width = floor(100/SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS);
        }

        while (!$also_purchased_products->EOF) {
            $app_products_id = $also_purchased_products->fields['products_id'];

            $products_price = zen_get_products_display_price($app_products_id);
            $also_purchased_products_price = '<div class="price text-center">' . $products_price . '</div>';

            $app_products_name = zen_get_products_name($app_products_id);
            $app_products_link = zen_href_link(zen_get_info_page($app_products_id), "products_id=$app_products_id");
    
            $also_purchased_products_name = '<h3 class="h6 card-title"><a href="' . $app_products_link . '" class="text-decoration-none">' . $app_products_name . '</a></h3>';

            if (empty($also_purchased_products->fields['products_image']) && PRODUCTS_IMAGE_NO_IMAGE_STATUS === '0') {
                $also_purchased_products_image = '';
            } else {
                $also_purchased_products_image =
                    '<a href="' . $app_products_link . '" class="d-block" title="' . zen_output_string_protected($app_products_name) . '">' .
                        zen_image(DIR_WS_IMAGES . $also_purchased_products->fields['products_image'], $app_products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="img-fluid mx-auto" loading="lazy"') .
                    '</a>';
            }
      
            $list_box_contents[$row][$col] = [
                'params' => 'class="card h-100"',
                'text' => '<div class="card-body d-flex flex-column">' . 
                            $also_purchased_products_image . 
                            $also_purchased_products_name . 
                            $also_purchased_products_price . 
                         '</div>'
            ];

            $col++;
            if ($col >= (int)SHOW_PRODUCT_INFO_COLUMNS_ALSO_PURCHASED_PRODUCTS) {
                $col = 0;
                $row++;
            }
            $also_purchased_products->MoveNextRandom();
        }
    }
    if ($also_purchased_products->RecordCount() > 0 && $also_purchased_products->RecordCount() >= MIN_DISPLAY_ALSO_PURCHASED) {
        $title = '<h2 id="alsoPurchasedCenterbox-card-header" class="h3">' . TEXT_ALSO_PURCHASED_PRODUCTS . '</h2>';
        $zc_show_also_purchased = true;
    }
}
