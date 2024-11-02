<?php
/**
 * Part of the Bootstrap 5 Template Home-Page Carousel by lat9.
 * Copyright (C) 2021-2024, Vinos de Frutas Tropicales.
 *
 * BOOTSTRAP v5.0.0
 */

// -----
// Zen Cart's 'base' banner management requires that a 'banners_history' record be present for a 'banner' if that banner is
// to be expired.  Add a dummy record for any slider banners that don't already have such a record.
//
$slider_banner_check = $db->Execute(
    "SELECT b.banners_id
       FROM " . TABLE_BANNERS . " b
      WHERE b.banners_group = '" . BS4_SLIDER_BANNER_GROUP . "'
        AND b.banners_id NOT IN (SELECT bh.banners_id FROM " . TABLE_BANNERS_HISTORY . " bh)"
);
foreach ($slider_banner_check as $banner_history) {
    $banner_history['banners_history_date'] = 'now()';
    zen_db_perform(TABLE_BANNERS_HISTORY, $banner_history);
}

// -----
// Load any applicable home-page banners
//
$bs4_hp_banners = $db->Execute(
    "SELECT banners_id, banners_title, banners_image, banners_url, banners_open_new_windows
       FROM " . TABLE_BANNERS . "
      WHERE status = 1
        AND banners_group = '" . BS4_SLIDER_BANNER_GROUP . "'
      ORDER BY banners_sort_order, banners_id"
);
if ($bs4_hp_banners->EOF) {
    return;
}
?>
<div id="carouselHomeSlider" class="carousel banner-carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <ol class="carousel-indicators">
<?php
for ($i = 0, $n = count($bs4_hp_banners), $hp_class = ' class="active" aria-current="true"'; $i < $n; $i++) {
?>
        <li data-bs-target="#carouselHomeSlider" data-bs-slide-to="<?= $i ?>"<?= $hp_class ?> aria-label="Slide <?= $i + 1 ?>"></li>
<?php
    $hp_class = '';
}
?>
    </ol>
    <div class="carousel-inner">
<?php
$hp_class = 'active';
foreach ($bs4_hp_banners as $row) {
    if (empty($row['banners_url'])) {
        $banner_href = 'javascript:void(0);';
        $anchor_target = '';
    } else {
        $banner_href = $row['banners_url'];
        $anchor_target = ($row['banners_open_new_windows'] === '1') ? ' target="_blank" rel="noopener noreferrer"' : '';
    }
?>
        <div class="carousel-item <?= $hp_class ?>">
            <a href="<?= $banner_href ?>" <?= $anchor_target ?>>
                <?= zen_image(DIR_WS_IMAGES . $row['banners_image'], $row['banners_title'], BS4_SLIDER_WIDTH, BS4_SLIDER_HEIGHT, ' class="mx-auto d-block"') ?>
            </a>
        </div>
<?php
    $hp_class = '';
}
?>
    </div>
    <a class="carousel-control-prev" href="#carouselHomeSlider" role="button" data-bs-slide="prev">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="#000000" stroke="#000000" stroke-width="1.5" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
        </svg>
        <span class="visually-hidden"><?= BUTTON_PREVIOUS_ALT ?></span>
    </a>
    <a class="carousel-control-next" href="#carouselHomeSlider" role="button" data-bs-slide="next">
        <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="#000000" stroke="#000000" stroke-width="1.5" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
        </svg>
        <span class="visually-hidden"><?= BUTTON_NEXT_ALT ?></span>
    </a>
</div>
<div class="mb-2"></div>
