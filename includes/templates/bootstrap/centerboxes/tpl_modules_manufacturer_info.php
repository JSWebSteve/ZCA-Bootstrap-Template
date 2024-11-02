<?php
/**
 * Side Box Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_manufacturer_info.php 3429 2006-04-13 06:11:47Z ajeh $
 */
$mi_id = $manufacturer_info_sidebox->fields['manufacturers_id'];
$mi_name = $manufacturer_info_sidebox->fields['manufacturers_name'];
?>
<div id="manufacturerInfo-centerBoxContents" class="card mb-3">
    <div id="manufacturerInfo-centerBoxHeading" class="card-header h4" role="heading" aria-level="2">
        <?= BOX_HEADING_MANUFACTURER_INFO ?>
    </div>
    <div id="manufacturerInfo-card-body" class="card-body p-3" aria-labelledby="manufacturerInfo-centerBoxHeading">
        <div class="text-center mb-3">
            <?= zen_image(DIR_WS_IMAGES . $manufacturer_info_sidebox->fields['manufacturers_image'], $mi_name, '', '', 'class="img-fluid" role="img"') ?>
        </div>
        <ul class="list-group list-group-flush">
<?php
if (!empty($manufacturer_info_sidebox->fields['manufacturers_url'])) {
?>
            <li class="list-group-item">
                <a href="<?= zen_href_link(FILENAME_REDIRECT, 'action=manufacturer&manufacturers_id=' . $mi_id) ?>" 
                   target="_blank" 
                   rel="noopener" 
                   aria-label="<?= sprintf(BOX_MANUFACTURER_INFO_HOMEPAGE, $mi_name) ?>">
                    <?= sprintf(BOX_MANUFACTURER_INFO_HOMEPAGE, $mi_name) ?>
                </a>
            </li>
<?php
}
?>
            <li class="list-group-item">
                <a href="<?= zen_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $mi_id) ?>"
                   aria-label="<?= BOX_MANUFACTURER_INFO_OTHER_PRODUCTS ?>">
                    <?= BOX_MANUFACTURER_INFO_OTHER_PRODUCTS ?>
                </a>
            </li>
        </ul>
    </div>
</div>
