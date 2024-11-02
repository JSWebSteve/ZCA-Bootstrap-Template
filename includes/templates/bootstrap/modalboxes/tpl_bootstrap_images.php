<?php
/**
 * New Modal for popup_image_additional carousel
 * 
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
if (!defined('IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE')) {
    define('IMAGE_ADDITIONAL_DISPLAY_LINK_EVEN_WHEN_NO_LARGE', 'Yes');
}
?>
<!-- Modal -->
<!-- BOOTSTRAP -->
<div id="bootstrap-slide-modal-lg" class="modal fade bootstrap-slide-modal-lg" tabindex="-1" role="dialog" aria-labelledby="bootStrapImagesModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="bootStrapImagesModalLabel" class="modal-title"><?php echo $products_name; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?php echo TEXT_MODAL_CLOSE; ?>"></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <!-- main slider carousel -->
                    <div class="row">
                        <div id="slider" class="col-lg-8 offset-lg-2">
                            <div id="productImagesCarousel" class="carousel slide" data-bs-ride="carousel">
                                <!-- main slider carousel items -->
                                <div class="carousel-inner text-center">
<?php
require DIR_WS_MODULES . zen_get_module_directory('main_product_image.php');
?>
                                    <div class="carousel-item active" data-bs-slide-number="0"><?php echo zen_image($products_image_large, $products_name, '', '', 'class="img-fluid"'); ?></div>
<?php
require DIR_WS_MODULES . zen_get_module_directory('bootstrap_slide_additional_images.php');

if ($flag_show_product_info_additional_images !== '0' && $num_images > 0) {
    if (is_array($list_box_contents)) {
        for ($row = 0, $rn = count($list_box_contents); $row < $rn; $row++) {
            $params = '';

            for ($col = 0, $cn = count($list_box_contents[$row]); $col < $cn; $col++) {
                $r_params = '';
                if (isset($list_box_contents[$row][$col]['params'])) {
                    $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
                }
                if (isset($list_box_contents[$row][$col]['text'])) {
                    echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] . '</div>';
                }
            }
        }
    }
}
?>
                                    <div id="carousel-btn-toolbar" class="btn-toolbar justify-content-between p-3" role="toolbar">
                                        <a class="carousel-control-prev left pt-3" href="#productImagesCarousel" role="button" data-bs-slide="prev">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="#000000" stroke="#000000" stroke-width="1.5" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                                            </svg>
                                            <span class="visually-hidden"><?php echo BUTTON_PREVIOUS_ALT; ?></span>
                                        </a>
                                        <a class="carousel-control-next right pt-3" href="#productImagesCarousel" role="button" data-bs-slide="next">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="#000000" stroke="#000000" stroke-width="1.5" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                            </svg>
                                            <span class="visually-hidden"><?php echo BUTTON_NEXT_ALT; ?></span>
                                        </a>
                                    </div>
                                </div>
                                <!-- main slider carousel nav controls -->

                                <ul class="carousel-indicators list-inline mx-auto justify-content-center py-3">
                                    <li class="list-inline-item active">
                                        <a id="carousel-selector-0" class="selected" data-bs-slide-to="0" data-bs-target="#productImagesCarousel">
<?php
require DIR_WS_MODULES . zen_get_module_directory('main_product_image.php');
?>
                                            <?php echo zen_image($products_image_large, $products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'class="img-fluid"'); ?>
                                        </a>
                                    </li>
<?php
require DIR_WS_MODULES . zen_get_module_directory('bootstrap_additional_images.php');

if ($flag_show_product_info_additional_images !== '0' && $num_images > 0) {
    if (is_array($list_box_contents) > 0 ) {
        for ($row = 0, $rn = count($list_box_contents); $row < $rn; $row++) {
            $params = '';

            for ($col = 0, $cn = count($list_box_contents[$row]); $col < $cn; $col++) {
                $r_params = '';
                if (isset($list_box_contents[$row][$col]['params'])) {
                    $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
                }
                if (isset($list_box_contents[$row][$col]['text'])) {
                    echo '<li' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</li>';
                }
            }
        }
    }
}
?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--/main slider carousel-->
                </div>
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo TEXT_MODAL_CLOSE; ?></button></div>
        </div>
    </div>
</div>
