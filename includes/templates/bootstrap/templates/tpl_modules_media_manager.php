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
/**
 * require module to aggregate media clips to an array
 */
  require(DIR_WS_MODULES . zen_get_module_directory('media_manager.php'));
  if ($zv_product_has_media) {
?>

<!--bof media manager card-->
<div id="mediaManager-card" class="card mb-3">
    
<h2 id="mediaManager-card-header" class="card-header"><?php echo TEXT_PRODUCT_COLLECTIONS; ?></h2>

  <div id="mediaManager-card-body" class="card-body p-3" aria-labelledby="mediaManager-card-header">
<?php
foreach($za_media_manager as $za_media_key => $za_media) {
?>

      <h3 id="mediaManager-mediaTitle-<?php echo $za_media_key; ?>" class="h5"><?php echo $za_media['text']; ?></h3>
      
<?php
    $zv_counter1 = 0;
    foreach($za_media_manager[$za_media_key]['clips'] as $za_clip_key => $za_clip) {
?>
      <div class="mediaTypeLink">
        <a href="<?php echo zen_href_link(DIR_WS_MEDIA  . $za_clip['clip_filename'], '', 'NONSSL', false, true, true); ?>" target="_blank" aria-describedby="mediaManager-mediaTitle-<?php echo $za_media_key; ?>">
          <span class="mediaClipFilename"><?php echo $za_clip['clip_filename']; ?></span>
          <?php if (!empty($za_clip['clip_type'])): ?>
            <span class="mediaClipType">(<?php echo $za_clip['clip_type']; ?>)</span>
          <?php endif; ?>
        </a>
      </div>

<?php
    }
?>

<?php
  }
  }
?>
  </div>
</div>
<!--eof media manager card-->
