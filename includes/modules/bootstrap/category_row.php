<?php
/**
 * BOOTSTRAP v5.0.0
 *
 * index category_row.php
 *
 * Prepares the content for displaying a category's sub-category listing in grid format.
 * Once the data is prepared, it calls the standard tpl_list_box_content template for display.
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: lat9 2022 Jul 18 Modified in v1.5.8-alpha2 $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

// -----
// Since the template still supports zc157, set the following definition if
// not already available.
//
if (!defined('TOPMOST_CATEGORY_PARENT_ID')) {
    define('TOPMOST_CATEGORY_PARENT_ID', '0');
}

$num_categories = $categories->RecordCount();

$rows = 0;
$columns = 0;
$list_box_contents = [];
$title = '';

if (empty($num_categories)) {
    return;
}

$columns_per_row = defined('MAX_DISPLAY_CATEGORIES_PER_ROW') ? (int)MAX_DISPLAY_CATEGORIES_PER_ROW : 0;
$category_row_layout_style = $columns_per_row > 1 ? 'columns' : 'fluid';

// if in fixed-columns mode, calculate column width
if ($category_row_layout_style === 'columns') {
    $calc_value = $columns_per_row;
    if ($num_categories < $columns_per_row || $columns_per_row == 0) {
        $calc_value = $num_categories;
    }
    $col_width = floor(100 / $calc_value) - 0.5;
} else {
    // -----
    // Starting with v3.6.3, a categories' fluid layout can be identified.  If predefined (like
    // in an /extra_datafiles .php module), that override is used.
    //
    $grid_cards_classes = 'row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 g-4';
    if (!isset($grid_category_classes_matrix)) {
        // this array is intentionally in reverse order, with largest index first
        $grid_category_classes_matrix = [
            '12' => 'row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-6 g-4',
            '10' => 'row-cols-1 row-cols-md-2 row-cols-lg-4 row-cols-xl-5 g-4',
            '9' => 'row-cols-1 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 g-4',
            '8' => 'row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 g-4',
            '6' => 'row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 g-4',
        ];
    }
}

// -----
// Starting with v3.7.0 of the template, categories with no products
// can be excluded from the display.
//
$includeAllCategories = $zca_include_zero_product_categories ?? true;

foreach ($categories as $next_category) {
    if ($includeAllCategories === false && zen_products_in_category_count($next_category['categories_id']) === 0) {
        continue;
    }

    $zco_notifier->notify('NOTIFY_CATEGORY_ROW_IMAGE', $next_category['categories_id'], $next_category['categories_image']);
    if (empty($next_category['categories_image'])) {
        $next_category['categories_image'] = 'pixel_trans.gif';
    }
    $cPath_new = zen_get_path($next_category['categories_id']);

    // strip out 0_ from top level cats
    $cPath_new = str_replace('=' . (int)TOPMOST_CATEGORY_PARENT_ID . '_', '=', $cPath_new);

    if ($category_row_layout_style === 'fluid') {
        // determine classes to use based on number of grid-columns used by "center" column
        if (isset($center_column_width)) {
            foreach ($grid_category_classes_matrix as $width => $classes) {
                if ($center_column_width >= $width) {
                    $grid_cards_classes = $classes;
                    break;
                }
            }
        }
        $list_box_contents[$rows]['params'] = 'class="row ' . $grid_cards_classes . ' text-center" role="list"';
    }

    $wrap_class = ($category_row_layout_style === 'columns') ? '' : 'col';
    $list_box_contents[$rows][] = [
        'params' => 'class="categoryListBoxContents card h-100 text-center" role="listitem"',
        'text' =>
            '<div class="card-body d-flex flex-column">' .
            '<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new) . '" class="text-decoration-none">' .
                zen_image(DIR_WS_IMAGES . $next_category['categories_image'], $next_category['categories_name'], SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT, 'class="img-fluid mb-3" loading="lazy"') .
                '<h5 class="card-title">' . $next_category['categories_name'] . '</h5>' .
            '</a>' .
            '</div>',
        'wrap_with_classes' => $wrap_class,
        'card_type' => $category_row_layout_style,
    ];

    if ($category_row_layout_style === 'columns') {
        $columns++;
        if ($columns >= $columns_per_row) {
            $columns = 0;
            $rows++;
        }
    }
}
