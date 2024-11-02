<?php
/**
 * Common Template - tpl_columnar_display_carousel.php
 *
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 Dec 27  For v1.5.7 $
 */
$title = $title ?? '';
$zco_notifier->notify('NOTIFY_TPL_COLUMNAR_DISPLAY_CAROUSEL_START', $current_page_base, $list_box_contents, $title);

// -----
// Nothing to render if the contents' container isn't an array or
// if no carousel configuration is specified.
//
if (!is_array($list_box_contents) || empty($carousel_config)) {
    return;
}

$card_main_id = $card_main_id ?? '';
if ($card_main_id !== '') {
    $card_main_id = ' id="' . trim($card_main_id) . '"';
}
$card_main_class = $card_main_class ?? '';
if ($card_main_class !== '') {
    $card_main_class = ' ' . trim($card_main_class);
}
$card_body_id = $card_body_id ?? '';
if ($card_body_id !== '') {
    $card_body_id = ' id="' . $card_body_id . '"';
}

// -----
// Determine the configuration to use for the carousel.
//
$carousel_fade = (strpos($carousel_config, ';fade') !== false) ? 'carousel-fade' : '';
$card_viewport_cutoffs = explode(',', str_replace([';fade', ' '], '', $carousel_config));

// -----
// Determine the number of products to be displayed at the
// lg/md viewports; it's always 1 product displayed in the
// sm viewport.
//
$products_per_row_large = (int)$card_viewport_cutoffs[0];
$products_per_row_medium = (int)($card_viewport_cutoffs[1] ?? '');
if ($products_per_row_large === 0) {
    $products_per_row_large = 3;
} elseif ($products_per_row_large > 12) {
    $products_per_row_large = 12;
}
if ($products_per_row_medium === 0) {
    $products_per_row_medium = $products_per_row_large;
} elseif ($products_per_row_medium > 12) {
    $products_per_row_medium = 12;
}

// -----
// Determine the lg/md viewport classes to be applied to the
// output.  Each of the $products_per_row_{large|medium} values
// *must* evenly divide into 12 for the Bootstrap grid system's
// classes to be determined.
//
if (((12 / $products_per_row_large) % 12) !== 0) {
    while (!in_array($products_per_row_large, [1, 2, 3, 4, 6, 12])) {
        $products_per_row_large--;
    }
}
$carousel_class_lg = 'col-lg-' . (12 / $products_per_row_large);

if (((12 / $products_per_row_medium) % 12) !== 0) {
    while (!in_array($products_per_row_medium, [1, 2, 3, 4, 6, 12])) {
        $products_per_row_medium--;
    }
}
$carousel_class_md = 'col-md-' . (12 / $products_per_row_medium);

// -----
// Determine the numeric suffix to be applied to the carousel
// container's "id=" attribute.
//
$centerbox_carousel_count = $centerbox_carousel_count ?? 0;
$centerbox_carousel_count++;
$centerbox_carousel_wrapper_id = 'centerbox-carousel-' . $centerbox_carousel_count;
?>
<div class="card mb-3<?= $card_main_class ?>"<?= $card_main_id ?>>
    <?= $title ?>
    <div class="card-body text-center"<?= $card_body_id ?>>
        <div id="<?= $centerbox_carousel_wrapper_id ?>" class="carousel slide multi-carousel <?= $carousel_fade ?>" data-bs-ride="carousel">
            <div class="carousel-inner">
<?php
$carousel_item_class = "$carousel_class_lg $carousel_class_md";
foreach ($list_box_contents as $row => $cols) {
    foreach ($cols as $col) {
        if (!isset($col['text'])) {
            continue;
        }
?>
                <div class="carousel-grid <?= $carousel_item_class ?> col-sm-1">
                    <?= $col['text'] ?>
                </div>
<?php
    }
}
?>
            </div>

            <a class="carousel-control-prev d-inline-block text-start" href="#<?= $centerbox_carousel_wrapper_id ?>" role="button" data-bs-slide="prev">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="#000000" stroke="#000000" stroke-width="1.5" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/>
                </svg>
                <span class="visually-hidden"><?= BUTTON_PREVIOUS_ALT ?></span>
            </a>

            <a class="carousel-control-next d-inline-block text-end" href="#<?= $centerbox_carousel_wrapper_id ?>" role="button" data-bs-slide="next">
                <svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="#000000" stroke="#000000" stroke-width="1.5" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                </svg>
                <span class="visually-hidden"><?= BUTTON_NEXT_ALT ?></span>
            </a>

        </div>
    </div>
</div>
<?php
// -----
// For the first carousel centerbox **only**, render the lg/md/sm div's that
// the jQuery uses to "know" what viewport width is currently being viewed.
//
if ($centerbox_carousel_count === 1) {
?>
<div id="lg" class="d-none d-lg-block"></div>
<div id="md" class="d-none d-md-block d-lg-none"></div>
<div id="sm" class="d-none d-sm-block d-md-none"></div>
<?php
}
?>
<script>
var origin<?= $centerbox_carousel_count ?> = $('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner').prop('outerHTML');
function multiCarousel<?= $centerbox_carousel_count ?>()
{
    if ($('#lg').is(':visible')) {
        do {
            $('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner').children('.carousel-grid:lt(<?= $products_per_row_large ?>)').wrapAll('<div class="carousel-item"><div class="row"></div></div>');
            $('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner .carousel-item:first').addClass('active');
        } while ($('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner' ).children( '.carousel-grid' ).length);
    } else if ($('#md').is(':visible') ) {
        do {
            $('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner').children('.carousel-grid:lt(<?= $products_per_row_medium ?>)').wrapAll('<div class="carousel-item"><div class="row"></div></div>');
            $('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner .carousel-item:first').addClass('active');
        } while ($('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner' ).children('.carousel-grid' ).length);
    } else {
        do {
            $('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner').children('.carousel-grid:lt(1)').wrapAll('<div class="carousel-item"><div class="row"></div></div>');
            $('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner .carousel-item:first').addClass('active');
        } while ($('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner').children('.carousel-grid').length);
    }
    $('#<?= $centerbox_carousel_wrapper_id ?> .carousel-item').matchHeight();
}

$(window).on('load resize', function() {
    $.when(
        $('#<?= $centerbox_carousel_wrapper_id ?> .carousel-inner').replaceWith(origin<?= $centerbox_carousel_count ?>),
        multiCarousel<?= $centerbox_carousel_count ?>()
    ).done(function() {
        $('#<?= $centerbox_carousel_wrapper_id ?>').animate({opacity: 1}, 'fast', 'linear');
    });
});
</script>
<?php
$zco_notifier->notify('NOTIFY_TPL_COLUMNAR_DISPLAY_CAROUSEL_END', $current_page_base, $list_box_contents, $title);
