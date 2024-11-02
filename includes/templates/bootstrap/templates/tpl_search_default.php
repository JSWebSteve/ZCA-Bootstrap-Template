<?php
/**
 * Page Template
 *
 * BOOTSTRAP v5.0.0
 *
 * Loaded automatically by index.php?main_page=advanced_search.<br />
 * Displays options fields upon which a product search will be run
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: DrByte 2020 May 16 Modified in v1.5.7 $
 */
// -----
// zc158 redefines the 'advanced_search_result' page as simply 'search_result.  If that
// new page's definition is present, the search result will be sent there for viewing;
// otherwise, it'll be sent to the legacy page.
//
$search_result_page = (defined('FILENAME_SEARCH_RESULT')) ? FILENAME_SEARCH_RESULT : FILENAME_ADVANCED_SEARCH_RESULT;
?>
<div id="advancedSearchDefault" class="centerColumn">
    <?php echo zen_draw_form('advanced_search', zen_href_link($search_result_page, '', $request_type, false), 'get', 'onsubmit="return check_form(this);"') . zen_hide_session_id(); ?>
        <?php echo zen_draw_hidden_field('main_page', $search_result_page); ?>

        <h1 id="addressBookDefault-pageHeading" class="pageHeading"><?php echo HEADING_TITLE_1; ?></h1>

        <div id="advancedSearchDefault-helpLink" class="helpLink float-end p-3">
            <a data-bs-toggle="modal" href="#searchHelpModal"><?php echo TEXT_SEARCH_HELP_LINK; ?></a>
            <?php require $template->get_template_dir('tpl_search_help.php', DIR_WS_TEMPLATE, $current_page_base, 'modalboxes') . '/tpl_search_help.php'; ?>
        </div>
        <div class="clearfix"></div>
<?php
if ($messageStack->size('search') > 0) {
    echo $messageStack->output('search');
}
?>
        <div id="searchTerms-card" class="card mb-3">
            <h4 id="searchTerms-card-header" class="card-header"><?php echo HEADING_SEARCH_CRITERIA; ?></h4>
            <div id="searchTerms-card-body" class="card-body">
                <div class="form-floating mb-3">
                    <?php echo zen_draw_input_field('keyword', $sData['keyword'], 'id="keyword" placeholder="' . KEYWORD_FORMAT_STRING . '" class="form-control"'); ?>
                    <label class="form-label" for="keyword"><?php echo KEYWORD_FORMAT_STRING; ?></label>
                </div>

                <div class="form-check form-switch mt-3">
                    <?php echo zen_draw_checkbox_field('search_in_description', '1', $sData['search_in_description'], 'id="search-in-description" class="form-check-input"'); ?>
                    <label class="form-check-label" for="search-in-description"><?php echo TEXT_SEARCH_IN_DESCRIPTION; ?></label>
                </div>
            </div>
        </div>

        <div id="limitToCategory-card" class="card mb-3">
            <h4 id="limitToCategory-card-header" class="card-header"><?php echo ENTRY_CATEGORIES; ?></h4>
            <div id="limitToCategory-card-body" class="card-body">
                <?php echo zen_draw_pull_down_menu('categories_id', zen_get_categories([['id' => '', 'text' => TEXT_ALL_CATEGORIES]], '0' ,'', '1'), $sData['categories_id'], 'id="searchCategoryId" class="form-select"'); ?>

                <div class="form-check form-switch mt-3">
                    <?php echo zen_draw_checkbox_field('inc_subcat', '1', $sData['inc_subcat'], 'id="inc-subcat" class="form-check-input"'); ?>
                    <label class="form-check-label" for="inc-subcat"><?php echo ENTRY_INCLUDE_SUBCATEGORIES; ?></label>
                </div>
            </div>
        </div>
<?php
if (empty($skip_manufacturers)) {
?>
        <div id="limitToManufacturer-card" class="card mb-3">
            <h4 id="limitToManufacturer-card-header" class="card-header"><?php echo ENTRY_MANUFACTURERS; ?></h4>
            <div id="limitToManufacturer-card-body" class="card-body">
                <?php echo zen_draw_pull_down_menu('manufacturers_id', zen_get_manufacturers([['id' => '', 'text' => TEXT_ALL_MANUFACTURERS]], PRODUCTS_MANUFACTURERS_STATUS), $sData['manufacturers_id'], 'id="searchMfgId" class="form-select"'); ?>
            </div>
        </div>
<?php
}
?>
        <div id="priceRange-card" class="card mb-3">
            <h4 id="priceRange-card-header" class="card-header"><?php echo ENTRY_PRICE_RANGE; ?></h4>
            <div id="priceRange-card-body" class="card-body">
                <div class="form-floating mb-3">
                    <?php echo zen_draw_input_field('pfrom', $sData['pfrom'], 'id="entryPriceFrom" class="form-control" inputmode="decimal" placeholder="' . ENTRY_PRICE_FROM . '"'); ?>
                    <label class="form-label" for="entryPriceFrom"><?php echo ENTRY_PRICE_FROM; ?></label>
                </div>

                <div class="form-floating mb-3">
                    <?php echo zen_draw_input_field('pto', $sData['pto'], 'id="entryPriceTo" class="form-control" inputmode="decimal" placeholder="' . ENTRY_PRICE_TO . '"'); ?>
                    <label class="form-label" for="entryPriceTo"><?php echo ENTRY_PRICE_TO; ?></label>
                </div>
            </div>
        </div>

        <div id="dateAdded-card" class="card mb-3">
            <h4 id="dateAdded-card-header" class="card-header"><?php echo ENTRY_DATE_RANGE; ?></h4>
            <div id="dateAdded-card-body" class="card-body">
                <div class="form-floating mb-3">
                    <?php echo zen_draw_input_field('dfrom', $sData['dfrom'], 'id="entryDateFrom" class="form-control" placeholder="' . DOB_FORMAT_STRING . '" onfocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?>
                    <label class="form-label" for="entryDateFrom"><?php echo ENTRY_DATE_FROM; ?></label>
                </div>

                <div class="form-floating mb-3">
                    <?php echo zen_draw_input_field('dto', $sData['dto'], 'id="entryDateTo" class="form-control" placeholder="' . DOB_FORMAT_STRING . '" onfocus="RemoveFormatString(this, \'' . DOB_FORMAT_STRING . '\')"'); ?>
                    <label class="form-label" for="entryDateTo"><?php echo ENTRY_DATE_TO; ?></label>
                </div>
            </div>
        </div>

        <div id="advancedSearchDefault-btnToolbar" class="d-flex justify-content-between" role="toolbar">
            <?php echo zca_back_link(); ?>
            <?php echo zen_image_submit(BUTTON_IMAGE_SEARCH, BUTTON_SEARCH_ALT, 'class="btn btn-primary"'); ?>
        </div>
    <?php echo '</form>'; ?>
</div>
