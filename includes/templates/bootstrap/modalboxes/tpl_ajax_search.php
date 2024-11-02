<?php
// -----
// Part of the Bootstrap template for Zen Cart.  Included by /includes/templates/bootstrap/common/tpl_main_page.php.
//
// BOOTSTRAP v5.0.0
//
if (defined('BS4_AJAX_SEARCH_ENABLE') && BS4_AJAX_SEARCH_ENABLE === 'true') {
    $ajax_search_parameter = (defined('BS4_AJAX_SEARCH_INC_DESC') && BS4_AJAX_SEARCH_INC_DESC === 'true') ? 'search_in_description=1' : '';
?>
    <div id="search-wrapper" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="search-modal-title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body container-fluid">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="<?= TEXT_MODAL_CLOSE ?>"></button>
                    <h5 id="search-modal-title" class="modal-title mb-1"><?= TEXT_AJAX_SEARCH_TITLE ?></h5>
                    <div class="form-floating mb-3">
                        <form class="search-form">
                            <input type="text" id="search-input" class="form-control" placeholder="<?= TEXT_AJAX_SEARCH_PLACEHOLDER ?>">
                            <label for="search-input"><?= BUTTON_SEARCH_ALT ?></label>
                            <input id="search-page" type="hidden" value="<?= zen_href_link(FILENAME_SEARCH_RESULT, $ajax_search_parameter) ?>">
                        </form>
                    </div>
                    <div id="search-content" class="row row-cols-1 row-cols-md-2 g-4"></div>
                </div>
            </div>
        </div>
    </div>
<?php
}
