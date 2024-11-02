<?php
/**
 * Module Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Fri Jan 8 00:33:36 2016 -0500 Modified in v1.5.5 $
 */

?>
<div id="productsQuantityDiscounts-content" class="content">

<?php
  if ($zc_hidden_discounts_on) {
?>
<!--bof products quantity discounts card-->
<div id="productsQuantityDiscounts-card" class="card mb-3">
  <div id="productsQuantityDiscounts-card-header" class="card-header">
    <h2 class="h4 mb-0"><?php echo TEXT_HEADER_DISCOUNTS_OFF; ?></h2>
  </div>
  <div id="productsQuantityDiscounts-card-body" class="card-body">
      
    <div class="table-responsive">
      <table id="productsQuantityDiscounts-table" class="table table-bordered table-striped">
        <tbody>
          <tr>
            <td class="text-center">
            <?php echo $zc_hidden_discounts_text; ?>
            </td>
          </tr>
        </tbody>
      </table>
    </div>

  </div>
</div>
<!--eof products quantity discounts card-->

<?php } else { ?>

<!--bof products quantity discounts card-->
<div id="productsQuantityDiscounts-card" class="card mb-3">
  <div id="productsQuantityDiscounts-card-header" class="card-header">
    <h2 class="h4 mb-0">
    <?php
      switch ($products_discount_type) {
        case '1':
          echo TEXT_HEADER_DISCOUNT_PRICES_PERCENTAGE;
          break;
        case '2':
          echo TEXT_HEADER_DISCOUNT_PRICES_ACTUAL_PRICE;
          break;
        case '3':
          echo TEXT_HEADER_DISCOUNT_PRICES_AMOUNT_OFF;
          break;
      }
    ?>
    </h2>
  </div>
  <div id="productsQuantityDiscounts-card-body" class="card-body">
      
    <div class="table-responsive">
      <table id="productsQuantityDiscounts-table" class="table table-bordered table-striped">
        <thead>
          <tr>
            <th class="text-center"><?php echo $show_qty . '<br>' . $currencies->display_price($show_price, zen_get_tax_rate($products_tax_class_id)); ?></th>

            <?php
              foreach($quantityDiscounts as $key=>$quantityDiscount) {
            ?>
            <th class="text-center"><?php echo $quantityDiscount['show_qty'] . '<br>' . $currencies->display_price($quantityDiscount['discounted_price'], zen_get_tax_rate($products_tax_class_id)); ?></th>
            <?php
                $disc_cnt++;
                if ($discount_col_cnt == $disc_cnt && !($key == sizeof($quantityDiscount))) {
                  $disc_cnt=0;
            ?>
          </tr>
          <tr>
            <?php
                }
              }
            ?>
            <?php
              if ($disc_cnt < $columnCount) {
            ?>
            <th class="text-center" colspan="<?php echo ($columnCount+1 - $disc_cnt)+1; ?>"> &nbsp; </th>
            <?php } ?>
          </tr>
        </thead>
        <?php
          if (zen_has_product_attributes($products_id_current)) {
        ?>
        <tfoot>
          <tr>
            <td colspan="<?php echo $columnCount+1; ?>" class="text-center">
              <?php echo TEXT_FOOTER_DISCOUNT_QUANTITIES; ?>
            </td>
          </tr>
        </tfoot>
        <?php } ?>
      </table>
    </div>
  </div>
</div>
<!--eof products quantity discounts card-->
<?php } // hide discounts ?>
</div>
