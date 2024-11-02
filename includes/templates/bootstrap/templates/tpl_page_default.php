<?php
/**
 * Page Template
 * 
 * BOOTSTRAP v5.0.0
 *
 * This is the template used for EZ-Pages content display.  It is named "tpl_page_default" instead of ezpage for friendlier appearance
 *
 * @package templateSystem
 * @copyright Copyright 2003-2016 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: Author: DrByte  Sun Oct 18 13:09:57 2015 -0400 Modified in v1.5.5 $
 */
?>
<div id="pageDefault" class="centerColumn" role="main">
    <h1 id="pageDefault-pageHeading" class="pageHeading"><?php echo $var_pageDetails->fields['pages_title']; ?></h1>
<?php
if (EZPAGES_SHOW_PREV_NEXT_BUTTONS === '2' && $counter > 1) {
?>
    <div id="pageDefault-btn-group" class="btn-group my-3 text-center d-none d-sm-flex justify-content-center" role="group" aria-label="<?php echo ARIA_LABEL_BUTTON_GROUP; ?>">
        <a href="<?php echo $prev_link; ?>" class="btn btn-outline-secondary"><?php echo $previous_button; ?></a>
        <?php echo zen_back_link() . $home_button; ?></a>
        <a href="<?php echo $next_link; ?>" class="btn btn-outline-secondary"><?php echo $next_item_button; ?></a>
    </div>

    <div id="pageDefault-btn-group2" class="btn-group my-3 text-center d-flex d-sm-none justify-content-center" role="group" aria-label="<?php echo ARIA_LABEL_BUTTON_GROUP; ?>">
        <a href="<?php echo $prev_link; ?>" class="btn btn-outline-secondary"><span class="visually-hidden"><?php echo BUTTON_PREVIOUS_ALT; ?></span><svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="#000000" stroke="#000000" stroke-width="1.5" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z"/></svg></a>
        <?php echo zen_back_link() . $home_button; ?></a>
        <a href="<?php echo $next_link; ?>" class="btn btn-outline-secondary"><span class="visually-hidden"><?php echo BUTTON_NEXT_ALT; ?></span><svg xmlns="http://www.w3.org/2000/svg" width="1.25em" height="1.25em" fill="#000000" stroke="#000000" stroke-width="1.5" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg></a>
    </div>
<?php
} elseif (EZPAGES_SHOW_PREV_NEXT_BUTTONS === '1') {
?>
    <div id="pageDefault-btn-toolbar" class="d-flex justify-content-center my-3" role="toolbar" aria-label="<?php echo ARIA_LABEL_TOOLBAR; ?>">
        <?php echo zen_back_link() . $home_button . '</a>'; ?>
    </div>
<?php
}
?>
    <br>
<?php
// vertical TOC listing
// create a table of contents for chapter when more than 1 page in the TOC
if (count($toc_links) > 1 && EZPAGES_SHOW_TABLE_CONTENTS === '1') {
?>
    <ul id="pageDefault-list-group" class="list-group mb-3">
        <li class="list-group-item list-group-item-secondary"><?php echo TEXT_EZ_PAGES_TABLE_CONTEXT; ?></li>
<?php
    foreach($toc_links as $link) {
        // could be used to change classes on current link and toc (table of contents) links
        if ($link['pages_id'] === $_GET['id']) {
            $current_page_indicator = CURRENT_PAGE_INDICATOR;
            $page_link_params = ' class="list-group-item list-group-item-action active"';
        } else {
            $current_page_indicator = NOT_CURRENT_PAGE_INDICATOR;
            $page_link_params = ' class="list-group-item list-group-item-action"';
        }
?>
        <li<?php echo $page_link_params; ?>>
            <?php echo $current_page_indicator; ?><a href="<?php echo zen_ez_pages_link($link['pages_id']);?>"><?php echo $link['pages_title']; ?></a>
        </li>
<?php
    }
?>
    </ul>
<?php
}
?>
    <div id="pageDefault-content" class="content">
        <?php echo $var_pageDetails->fields['pages_html_text']; ?>
    </div>
</div>
