<?php
/**
 * featured_categories module - prepares content for display
 *
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2023 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2024 May 24 Modified in v2.1.0-alpha1 $
 * based on featured_products
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

$categories_categories_id_list = [];
$sql = '';
$display_limit = '';

$sql =
    "SELECT c.categories_id, c.categories_image, cd.categories_name
       FROM " . TABLE_CATEGORIES . " c
            LEFT JOIN " . TABLE_FEATURED_CATEGORIES . " fc
                ON c.categories_id = fc.categories_id
            LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd
                ON c.categories_id = cd.categories_id
               AND cd.language_id = " . (int)$_SESSION['languages_id'] . "
      WHERE c.categories_status = 1
        AND fc.status = 1";
$featured_categories = $db->ExecuteRandomMulti($sql, MAX_DISPLAY_SEARCH_RESULTS_FEATURED);

$row = 0;
$col = 0;
$list_box_contents = [];
$title = '';

$num_categories_count = $featured_categories->RecordCount();

if ($num_categories_count > 0) {
    while (!$featured_categories->EOF) {
        $category_info = new Category((int)$featured_categories->fields['categories_id']);
        $data = $category_info->getDataForLanguage();

        $featured_cat_link = zen_href_link(FILENAME_DEFAULT, 'cPath=' .  zen_get_generated_category_path_rev($data['categories_id']));

        $featured_cat_image = '';
        if (!(empty($data['categories_image']) && PRODUCTS_IMAGE_NO_IMAGE_STATUS === '0')) {
            $featured_cat_image =
                '<a href="' . $featured_cat_link . '" class="d-block" title="' . zen_output_string_protected($data['categories_name']) . '">' .
                    zen_image(DIR_WS_IMAGES . (string)$data['categories_image'], $data['categories_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="img-fluid mx-auto" loading="lazy"') .
                '</a>';
        }
        
        $list_box_contents[$row][$col] = [
            'params' => 'class="card h-100"',
            'text' => '<div class="card-body d-flex flex-column text-center">' . 
                        $featured_cat_image . 
                        '<h3 class="h6 card-title mt-2"><a href="' . $featured_cat_link . '" class="text-decoration-none">' . 
                            $data['categories_name'] . 
                        '</a></h3>' .
                     '</div>'
        ];

        $col++;
        if ($col > (SHOW_PRODUCT_INFO_COLUMNS_FEATURED_PRODUCTS - 1)) {
            $col = 0;
            $row++;
        }
        $featured_categories->MoveNextRandom();
    }

    if (!empty($current_category_id)) {
        $category_title = zen_get_category_name((int)$current_category_id);
        $title = '<h2 id="featuredCenterbox-card-header" class="centerBoxHeading card-header h3">' . TABLE_HEADING_FEATURED_CATEGORIES . ($category_title !== '' ? ' - ' . $category_title : '') . '</h2>';
    } else {
        $title = '<h2 id="featuredCenterbox-card-header" class="centerBoxHeading card-header h3">' . TABLE_HEADING_FEATURED_CATEGORIES . '</h2>';
    }
    $zc_show_featured = true;
}
