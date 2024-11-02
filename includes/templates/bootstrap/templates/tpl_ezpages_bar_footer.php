<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * Displays EZ-Pages footer-bar content.<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2019 Jan 04 Modified in v1.5.6a $
 */

   /**
   * require code to show EZ-Pages list
   */
  include(DIR_WS_MODULES . zen_get_module_directory('ezpages_bar_footer.php'));
?>

<?php if (!empty($var_linksList)) { ?>
<nav id="ezpagesBarFooter" class="ezpagesBar rounded" aria-label="EZ-Pages Footer Navigation">
    <ul class="nav nav-pills">
    <?php for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++) {  ?>
        <li class="nav-item">
            <a id="ezpagesBarFooter-link-<?php echo $i; ?>" class="nav-link" href="<?php echo $var_linksList[$i]['link']; ?>">
                <?php echo $var_linksList[$i]['name']; ?>
            </a>
        </li>
    <?php } // end FOR loop ?>
    </ul>
</nav>
<?php } ?>
