<?php
/**
 * Module Template
 *
 * BOOTSTRAP v5.0.0
 *
 * NOTE: The clickable download links will appear only if:
 * - Download remaining count is > 0, AND
 * - The file is present in the DOWNLOAD directory, AND EITHER
 * - No expiry date is enforced (maxdays == 0), OR
 * - The expiry date is not reached
 *
 * @package templateSystem
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Drbyte Sat Dec 23 12:42:13 2017 -0500 Modified in v1.5.6 $
 */
/**
 * require the downloads module
 */
require DIR_WS_MODULES . zen_get_module_directory('downloads.php');
// if download is not available yet
if ($downloadsNotAvailableYet) {
?>
<!--bof downloads hold card-->
<div id="downloadsHold-card" class="card mb-3">
    <div id="downloadsHold-card-body" class="card-body p-3" aria-labelledby="downloadsHold-card-header">
        <h2 id="downloadsHold-card-header" class="visually-hidden"><?php echo DOWNLOADS_CONTROLLER_ON_HOLD_TITLE; ?></h2>
        <?php echo DOWNLOADS_CONTROLLER_ON_HOLD_MSG ?>
    </div>
</div>
<!--eof downloads hold card-->
<?php
    return;
}

if ($numberOfDownloads < 1) {
    return;
}
// download is available
?>
<!--bof downloads card-->
<div id="downloads-card" class="card mb-3">
    <h2 id="downloads-card-header" class="card-header">
        <?php echo HEADING_DOWNLOAD; ?>
    </h2>
    <div id="downloads-card-body" class="card-body p-3" aria-labelledby="downloads-card-header">
        <div class="table-responsive">
            <table id="downloads-downloadTableDisplay" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" id="downloadTableDisplay-productsHeading"><?php echo TABLE_HEADING_PRODUCT_NAME; ?></th>
                        <th scope="col" id="downloadTableDisplay-byteSizeHeading"><?php echo TABLE_HEADING_BYTE_SIZE; ?></th>
                        <th scope="col" id="downloadTableDisplay-filenameHeading"><?php echo TABLE_HEADING_DOWNLOAD_FILENAME; ?></th>
                        <th scope="col" id="downloadTableDisplay-dateHeading"><?php echo TABLE_HEADING_DOWNLOAD_DATE; ?></th>
                        <th scope="col" id="downloadTableDisplay-countHeading"><?php echo TABLE_HEADING_DOWNLOAD_COUNT; ?></th>
                        <th scope="col" id="downloadTableDisplay-buttonHeading"><span class="visually-hidden"><?php echo TABLE_HEADING_ACTION; ?></span></th>
                    </tr>
                </thead>
                <tbody>
<?php
foreach ($downloads as $file) {
?>
                    <tr>
                        <td class="downloadProductName">
<?php
    if ($file['is_downloadable']) {
        echo '<a href="' . $file['link_url'] . '" download="' . $file['filename'] . '">' . $file['products_name'] . '</a>';
    } else {
        echo $file['products_name'];
    }
?>
                        </td>
                        <td class="downloadFilesize"><?php echo $file['filesize'] . $file['filesize_units']; ?></td>
                        <td class="downloadFilename"><?php echo $file['filename']; ?></td>
                        <td class="downloadExpiry">
                            <?php echo ($file['unlimited_downloads']) ? TEXT_DOWNLOADS_UNLIMITED : zen_date_short($file['expiry']); ?>
                        </td>
                        <td class="downloadCounts text-center">
                            <?php echo ($file['unlimited_downloads']) ? TEXT_DOWNLOADS_UNLIMITED_COUNT : $file['download_count']; ?>
                        </td>
                        <td class="downloadButton text-center">
<?php
    if (!$file['is_downloadable']) {
        echo '<span class="text-muted">' . TEXT_DOWNLOAD_NOT_AVAILABLE . '</span>';
    } else {
        echo '<a class="btn btn-primary button_download" href="' . $file['link_url'] . '" download="' . $file['filename'] . '" aria-label="' . sprintf(TEXT_DOWNLOAD_BUTTON_ALT, $file['products_name']) . '">' . BUTTON_DOWNLOAD_ALT . '</a>';
    }
?>
                        </td>
                    </tr>
<?php
} // end foreach
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--eof downloads card-->

<?php
if ($show_footer_link_to_my_account) {
?>
<div class="d-flex justify-content-end mt-3">
    <?php printf(FOOTER_DOWNLOAD, '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '" class="btn btn-outline-secondary">' . HEADER_TITLE_MY_ACCOUNT . '</a>'); ?>
</div>
<?php
} else {
    // other pages if needed
}
?>
