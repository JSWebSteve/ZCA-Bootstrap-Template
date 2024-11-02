<?php
/**
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2022 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Aug 11 New in v1.5.8-alpha $
 */
$content = '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="list-group-flush sideBoxContent">';
foreach ($brands_array as $brand) {
    $content .= '<a id="brand-' . $brand['id'] . '" class="list-group-item list-group-item-action" href="' . zen_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $brand['id']) . '">';
    $content .= '<span class="brand-name">' . $brand['text'] . '</span>';
    $content .= '</a>' . PHP_EOL;
}
$content .= '</div>';
