<?php
/**
 * Side Box Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2011 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_featured.php 18698 2011-05-04 14:50:06Z wilt $
 */
$is_carousel = in_array('featured', $sidebox_carousels);

$content = '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent text-center p-3">';
if ($is_carousel === true) {
    $carousel_fade = in_array('featured', $sidebox_carousels_to_fade) ? 'carousel-fade' : '';
    $content .=
        '<div class="carousel slide ' . $carousel_fade . '" data-bs-ride="carousel">
            <div class="carousel-inner">' .
                '<div class="card-deck h-100">';
}

$active_class = 'active';
while (!$random_featured_product->EOF) {
    $current_featured = $random_featured_product->fields;
    $featured_id = $current_featured['products_id'];
    $featured_name = $current_featured['products_name'];
    $featured_box_price = zen_get_products_display_price($featured_id);
    $featured_link = zen_href_link(zen_get_info_page($featured_id), 'cPath=' . zen_get_generated_category_path_rev($current_featured['master_categories_id']) . '&products_id=' . $featured_id);

    $carousel_start = ($is_carousel === true) ? '<div class="carousel-item h-100 ' . $active_class . '">' : '';
    $carousel_end = ($is_carousel === true) ? '</div>' : '';

    $content .=
    "\n" .
    $carousel_start .
    '<div id="featured-product-' . $featured_id . '" class="card mb-3 p-3 sideBoxContentItem">' .
        '<a href="' . $featured_link . '" title="' . zen_output_string_protected($featured_name) . '">' .
            '<div class="product-img">' . zen_image(DIR_WS_IMAGES . $current_featured['products_image'], $featured_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '', '', 'img-fluid') . '</div>' .
            '<h5 class="card-title product-name mt-2">' . $featured_name . '</h5>' .
        '</a>' .
        '<div class="card-text product-price">' .
            $featured_box_price .
        '</div>' .
    '</div>' .
    $carousel_end;

    $active_class = '';
    $random_featured_product->MoveNextRandom();
}

if ($is_carousel === true) {
    $content .=
        '       </div>
            </div>
        </div>';
}

$content .= "</div>\n";
