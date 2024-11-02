<?php
/**
 * ZCA Banners Carousel
 * Plugin Template
 * 
 * BOOTSTRAP v5.0.0
 *
 */
// -----
// If the current page is running on SSL, ensure that the banner can
// be run on SSL, too!
//
$my_banner_filter = ($request_type === 'SSL') ? ' AND banners_on_ssl = 1' : '';

// -----
// The $find_banners value is presumed to be set by the invoking script and is the
// output of that script's call to zen_build_banners_group.
//
$sql =
    "SELECT banners_id
       FROM " . TABLE_BANNERS . "
      WHERE status = 1 " .
           $find_banners .
           $my_banner_filter . "
      ORDER BY banners_sort_order";
$banners = $db->Execute($sql);

// if no active banner in the specified banner group then the box will not show
if ($banners->EOF) {
    return;
}

$carousel_group_id = 'carouselGroup' . (int)$banner_group;
?>
<div id="<?php echo $carousel_group_id; ?>" class="carousel banner-carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
<?php
$num_banners = $banners->RecordCount();
$slide_to_class = ' class="active" aria-current="true"';
for ($slide_to = 0; $slide_to < $num_banners; $slide_to++) {
?>
        <button type="button" data-bs-target="#<?php echo $carousel_group_id; ?>" data-bs-slide-to="<?php echo $slide_to; ?>"<?php echo $slide_to_class; ?> aria-label="Slide <?php echo $slide_to + 1; ?>"></button>
<?php
    $slide_to_class = '';
}
?>
    </div>
    <div class="carousel-inner rounded">
<?php
$addBannerClass = ' active';
foreach ($banners as $row) {
?>
        <div class="carousel-item<?php echo $addBannerClass; ?>">
            <?php echo zen_display_banner('static', $row['banners_id']); ?>
        </div>
<?php
    $addBannerClass = '';
}
?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#<?php echo $carousel_group_id; ?>" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden"><?php echo BUTTON_PREVIOUS_ALT; ?></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#<?php echo $carousel_group_id; ?>" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden"><?php echo BUTTON_NEXT_ALT; ?></span>
    </button>
</div>
