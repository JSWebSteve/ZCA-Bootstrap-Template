<?php
// -----
// Template formatting for the Bootstrap template's AJAX search feature.  Required by the
// template's AJAX search script (/includes/classes/ajax/zcAjaxBootstrapSearch.php).
//
// BOOTSTRAP v5.0.0
//
?>
<div class="row row-cols-1 row-cols-md-2 g-4">
<?php
foreach ($products_search as $next) {
?>
    <div class="col">
        <div id="sugg-<?= $next['id'] ?>" class="sugg card h-100">
            <div class="sugg-content card-body">
                <a href="<?= $next['link'] ?>">
                    <div class="sugg-img"><?= $next['image'] ?></div>
                    <h5 class="sugg-name card-title"><?= $next['name'] ?></h5>
                    <p class="sugg-model card-text"><?= $next['model'] ?></p>
                    <p class="sugg-brand card-text"><?= $next['brand'] ?></p>
                    <p class="sugg-price card-text"><?= $next['price'] ?></p>
                </a>
            </div>
        </div>
    </div>
<?php
}
?>
</div>
<div class="row">
    <div class="col-12 d-flex justify-content-center mt-3">
        <?= sprintf(TEXT_AJAX_SEARCH_RESULTS, $search_results_count) ?>&nbsp;
        <?= zca_button_link(zen_href_link(FILENAME_SEARCH_RESULT), TEXT_AJAX_SEARCH_VIEW_ALL, 'sugg-button') ?>
    </div>
</div>
