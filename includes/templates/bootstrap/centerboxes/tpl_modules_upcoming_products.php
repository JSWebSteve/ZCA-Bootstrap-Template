<?php
/**
 * Module Template
 *
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2018 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Drbyte Sun Jan 7 21:28:50 2018 -0500 Modified in v1.5.6 $
 */
?>
<!-- bof: upcoming_products -->
<div id="upcomingProducts-centerBoxContents" class="card mb-3">
    <h4 id="upcomingProducts-centerBoxHeading" class="centerBoxHeading card-header" role="heading" aria-level="2">
        <?php echo TABLE_HEADING_UPCOMING_PRODUCTS; ?>
    </h4>
    <div id="upcomingProducts-card-body" class="card-body p-3" aria-labelledby="upcomingProducts-centerBoxHeading">
        <div class="table-responsive">
            <table id="upcomingProducts-table" class="table table-striped table-hover">
                <caption class="visually-hidden"><?php echo CAPTION_UPCOMING_PRODUCTS; ?></caption>
                <tr>
                    <th scope="col" id="upcomingProducts-tableProductHeading"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
                    <th scope="col" id="upcomingProducts-tableDateHeading"><?php echo TABLE_HEADING_DATE_EXPECTED; ?></th>
                </tr>
                <?php
                for($i=0, $row=0, $n=sizeof($expectedItems); $i<$n; $i++, $row++) {
                    $rowClass = (($row / 2) == floor($row / 2)) ? "rowEven" : "rowOdd";
                ?>
                <tr class="<?php echo $rowClass; ?>">
                    <td>
                        <a href="<?php echo zen_href_link(zen_get_info_page($expectedItems[$i]['products_id']), 'cPath=' . $productsInCategory[$expectedItems[$i]['products_id']] . '&products_id=' . $expectedItems[$i]['products_id']); ?>"
                           aria-label="<?php echo $expectedItems[$i]['products_name']; ?>">
                            <?php echo $expectedItems[$i]['products_name']; ?>
                        </a>
                    </td>
                    <td class="text-end">
                        <?php echo zen_date_short($expectedItems[$i]['date_expected']); ?>
                    </td>
                </tr>
                <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<!-- eof: upcoming_products -->
