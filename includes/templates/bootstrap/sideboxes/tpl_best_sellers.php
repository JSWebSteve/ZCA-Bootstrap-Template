<?php
/**
 * Side Box Template
 *
 * BOOTSTRAP v5.0.0
 * 
 * @package templateSystem
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Drbyte Sun Jan 7 21:28:50 2018 -0500 Modified in v1.5.6 $
 */

$is_carousel = in_array('best_sellers', $sidebox_carousels);

// -----
// Non-carousel rendering ...
//
if ($is_carousel === false) {
    $content = '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="list-group-flush sideBoxContent">' . "\n";

    for ($i = 1, $j = count($bestsellers_list); $i<$j; $i++) {
        $content .=
            '<a id="best-seller-' . $i . '" class="list-group-item list-group-item-action" href="' . zen_href_link(zen_get_info_page($bestsellers_list[$i]['id']), 'products_id=' . $bestsellers_list[$i]['id']) . '">' .
                $i . '. ' .
                zen_trunc_string($bestsellers_list[$i]['name'], BEST_SELLERS_TRUNCATE, BEST_SELLERS_TRUNCATE_MORE) .
            '</a>';
    }

    $content .= "</div>\n";
    return;
}

// -----
// Carousel rendering ...
//
$carousel_fade = in_array('best_sellers', $sidebox_carousels_to_fade) ? 'carousel-fade' : '';
$content =
    '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent text-center p-3">' .
        '<div id="bestSellersCarousel" class="carousel slide ' . $carousel_fade . '" data-bs-ride="carousel">' .
            '<div class="carousel-inner">';

$active_class = 'active';
$bestseller_count = 1;
foreach ($bestsellers_list as $bestseller) {
    $content .=
        "\n" .
        '<div id="bestseller-item-' . $bestseller_count . '" class="carousel-item h-100 ' . $active_class . '">' .
            '<div class="card mb-3 p-3 sideBoxContentItem">' .
                '<div class="card-body">' .
                    '<h5 class="card-title">#' . $bestseller_count . '</h5>' .
                    '<a href="' . $bestseller['href'] . '" title="' . zen_output_string_protected($bestseller['name']) . '">' .
                        '<div class="product-img">' . $bestseller['image'] . '</div>' .
                        '<p class="card-text product-name">' . $bestseller['name'] . '</p>' .
                    '</a>' .
                    '<p class="card-text product-price">' . $bestseller['price'] . '</p>' .
                '</div>' .
            '</div>' .
        '</div>';

    $active_class = '';
    $bestseller_count++;
}

$content .=
    "       </div>
        </div>
    </div>\n";
