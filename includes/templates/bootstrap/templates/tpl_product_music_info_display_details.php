<?php
/**
 * Page Template
 *
 * BOOTSTRAP v5.0.0
 *
 * Provides the product's info-page details override for product-music type
 * products; used by tpl_product_info_display.php.
 */
$display_product_model = ($flag_show_product_info_model === '1' && $products_model !== '');
$display_product_weight = ($flag_show_product_info_weight === '1' && $products_weight != 0);
$display_product_quantity = ($flag_show_product_info_quantity === '1');
$display_product_manufacturer = ($flag_show_product_info_manufacturer === '1' && !empty($manufacturers_name));
$display_product_music_artist = ($flag_show_product_music_info_artist === '1' && !empty($products_artist_name));
$display_product_music_genre = ($flag_show_product_music_info_genre === '1' && !empty($products_music_genre_name));
if ($display_product_model || $display_product_weight || $display_product_quantity || $display_product_manufacturer || $display_product_music_artist || $display_product_music_genre) {
?>
            <ul id="<?= $html_id_prefix ?>-productDetailsList" class="productDetailsList list-group mb-3">
                <?= (($display_product_model === true) ? '<li id="' . $html_id_prefix . '-productDetailsList-model" class="list-group-item">' . TEXT_PRODUCT_MODEL . $products_model . '</li>' : '') . "\n" ?>
                <?= (($display_product_weight === true) ? '<li id="' . $html_id_prefix . '-productDetailsList-weight" class="list-group-item">' . TEXT_PRODUCT_WEIGHT .  $products_weight . TEXT_PRODUCT_WEIGHT_UNIT . '</li>'  : '') . "\n" ?>
                <?= (($display_product_quantity === true) ? '<li id="' . $html_id_prefix . '-productDetailsList-quantity" class="list-group-item">' . $products_quantity . TEXT_PRODUCT_QUANTITY . '</li>'  : '') . "\n" ?>
                <?= (($display_product_manufacturer === true) ? '<li id="' . $html_id_prefix . '-productDetailsList-manufacturer" class="list-group-item">' . TEXT_PRODUCT_MANUFACTURER . $manufacturers_name . '</li>' : '') . "\n" ?>
                <?= (($display_product_music_artist === true) ? '<li id="' . $html_id_prefix . '-productDetailsList-artist" class="list-group-item">' . TEXT_PRODUCT_ARTIST . $products_artist_name . '</li>' : '') . "\n" ?>
                <?= (($display_product_music_genre === true) ? '<li id="' . $html_id_prefix . '-productDetailsList-genre" class="list-group-item">' . TEXT_PRODUCT_MUSIC_GENRE . $products_music_genre_name . '</li>' : '') . "\n" ?>
            </ul>
<?php
}
