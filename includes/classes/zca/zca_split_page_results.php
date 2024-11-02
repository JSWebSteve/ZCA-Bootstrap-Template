<?php
/**
 * split_page_results Class.
 *
 * BOOTSTRAP v5.0.0
 *
 * @copyright Copyright 2003-2020 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: mc12345678 2020 Sep 29 Modified in v1.5.7a $
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}
/**
 * Split Page Result Class
 *
 * An sql paging class, that allows for sql result to be shown over a number of pages using simple navigation system
 * Overhaul scheduled for subsequent release
 *
 */
class zca_splitPageResults extends base
{
    public
        $sql_query,
        $number_of_rows,
        $current_page_number,
        $number_of_pages,
        $number_of_rows_per_page,
        $page_name,
        $countQuery;

    /* class constructor */
    public function __construct($query, $max_rows, $count_key = '*', $page_holder = 'page', $debug = false, $countQuery = '')
    {
        global $db;

        $max_rows = ($max_rows == '' || $max_rows == 0) ? 20 : $max_rows;

        $this->sql_query = str_replace(["\n", "\r"], ' ', $query);
        if ($countQuery !== '') {
            $countQuery = str_replace(["\n", "\r"], ' ', $countQuery);
        }
        $this->countQuery = ($countQuery !== '') ? $countQuery : $this->sql_query;
        $this->page_name = $page_holder;

        if ($debug !== false) {
            echo '<br><br>';
            echo 'original_query=' . $query . '<br><br>';
            echo 'original_count_query=' . $countQuery . '<br><br>';
            echo 'sql_query=' . $this->sql_query . '<br><br>';
            echo 'count_query=' . $this->countQuery . '<br><br>';
        }
        if (isset($_GET[$page_holder])) {
            $page = $_GET[$page_holder];
        } elseif (isset($_POST[$page_holder])) {
            $page = $_POST[$page_holder];
        } else {
            $page = '';
        }

        if (empty($page) || !ctype_digit((string)$page)) {
            $page = 1;
        }
        $this->current_page_number = $page;

        $this->number_of_rows_per_page = $max_rows;

        $pos_to = strlen($this->countQuery);

        $query_lower = strtolower($this->countQuery);
        $pos_from = (int)strpos($query_lower, ' from', 0);

        $pos_group_by = strpos($query_lower, ' group by', $pos_from);
        if ($pos_group_by !== false && $pos_group_by < $pos_to) {
            $pos_to = $pos_group_by;
        }

        $pos_having = strpos($query_lower, ' having', $pos_from);
        if ($pos_having !== false && $pos_having < $pos_to) {
            $pos_to = $pos_having;
        }

        $pos_order_by = strrpos($query_lower, ' order by', $pos_from);
        if ($pos_order_by !== false && $pos_order_by < $pos_to) {
            $pos_to = $pos_order_by;
        }

        if (strpos($query_lower, 'distinct') !== false || strpos($query_lower, 'group by') !== false) {
            $count_string = 'distinct ' . zen_db_input($count_key);
        } else {
            $count_string = zen_db_input($count_key);
        }
        $count_query = "SELECT COUNT(" . $count_string . ") AS total " . substr($this->countQuery, $pos_from, $pos_to - $pos_from);
        if ($debug !== false) {
            echo 'count_query=' . $count_query . '<br><br>';
        }
        $count = $db->Execute($count_query);

        $this->number_of_rows = $count->fields['total'];

        $this->number_of_pages = ceil($this->number_of_rows / $this->number_of_rows_per_page);

        if ($this->current_page_number > $this->number_of_pages) {
            $this->current_page_number = $this->number_of_pages;
        }

        $offset = ($this->number_of_rows_per_page * ($this->current_page_number - 1));

        // fix offset error on some versions
        if ($offset <= 0) { 
            $offset = 0; 
        }

        $this->sql_query .= ' LIMIT ' . ($offset > 0 ? $offset . ', ' : '') . $this->number_of_rows_per_page;
    }

    public function display_links($max_page_links, $parameters = '', $outputAsUnorderedList = false, $navElementLabel = '')
    {
        global $request_type;

        if (empty($max_page_links)) {
            $max_page_links = 1;
        }

        if ($this->number_of_pages <= 1) {
            return '&nbsp;';
        }

        $display_links_string = $ul_elements = '';
        $counter_actual_page_links = 0;

        if (!empty($parameters) && substr($parameters, -1) !== '&' && $this->current_page_number > 1) {
            $parameters .= '&';
        }

        // Previous button
        $href_link = zen_href_link($_GET['main_page'], $parameters . ($this->current_page_number > 2 ? $this->page_name . '=' . ($this->current_page_number - 1) : ''), $request_type);
        $link = 
            '<a id="prev-link" class="page-link" href="' . $href_link . '" title="' . PREVNEXT_TITLE_PREVIOUS_PAGE . '" aria-label="' . ARIA_PAGINATION_PREVIOUS_PAGE . '">' .
                PREVNEXT_BUTTON_PREV .
            '</a>';
        if ($this->current_page_number > 1) {
            $display_links_string .= '<li class="page-item">' . $link . '</li>';
            $ul_elements .= '  <li class="page-item pagination-previous">' . $link . '</li>' . "\n";
        }

        // Check if number_of_pages > $max_page_links
        $cur_window_num = (int)($this->current_page_number / $max_page_links);
        if ($this->current_page_number % $max_page_links) {
            $cur_window_num++;
        }

        $max_window_num = (int)($this->number_of_pages / $max_page_links);
        if ($this->number_of_pages % $max_page_links) {
            $max_window_num++;
        }

        // Previous group of pages
        $href_link = zen_href_link($_GET['main_page'], $parameters . ((($cur_window_num - 1) * $max_page_links) > 1 ? $this->page_name . '=' . (($cur_window_num - 1) * $max_page_links) : ''), $request_type);
        $link = '<a id="prev-group" class="page-link" href="' . $href_link . '" title="' . sprintf(PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE, $max_page_links) . '" aria-label="' . ARIA_PAGINATION_ELLIPSIS_PREVIOUS . '">...</a>';
        if ($cur_window_num > 1) {
            $display_links_string .= '<li class="page-item">' . $link . '</li>';
            $ul_elements .= '  <li class="page-item ellipsis">' . $link . '</li>' . "\n";
        }

        // Page numbers
        for ($jump_to_page = 1 + (($cur_window_num - 1) * $max_page_links); ($jump_to_page <= ($cur_window_num * $max_page_links)) && ($jump_to_page <= $this->number_of_pages); $jump_to_page++) {
            $aria_jump_to_page = sprintf(ARIA_PAGINATION_PAGE_NUM, $jump_to_page);
            if ($jump_to_page == $this->current_page_number) {
                $display_links_string .=
                    '<li id="current-page-' . $jump_to_page . '" class="page-item active" aria-current="true" aria-label="' . ARIA_PAGINATION_CURRENT_PAGE . ', ' . $aria_jump_to_page . '">' .
                        '<span class="page-link">' . $jump_to_page . '</span>' .
                    '</li>';
                $ul_elements .= '  <li class="page-item active">' . $jump_to_page . '</li>' . "\n";
                $counter_actual_page_links++;
            } else {
                $href_link = zen_href_link($_GET['main_page'], $parameters . ($jump_to_page > 1 ? $this->page_name . '=' . $jump_to_page : ''), $request_type);
                $link =
                    '<a id="page-' . $jump_to_page . '" class="page-link" href="' . $href_link . '" title="' . sprintf(PREVNEXT_TITLE_PAGE_NO, $jump_to_page) . '" aria-label="' . ARIA_PAGINATION_GOTO . $aria_jump_to_page . '">' .
                        $jump_to_page .
                    '</a>';
                $display_links_string .= '<li class="page-item">' . $link . '</li>';
                $ul_elements .= '  <li class="page-item">' . $link . '</li>' . "\n";
                $counter_actual_page_links++;
            }
        }

        // Next group of pages
        if ($cur_window_num < $max_window_num) {
            $href_link = zen_href_link($_GET['main_page'], $parameters . $this->page_name . '=' . (($cur_window_num) * $max_page_links + 1), $request_type);
            $link = '<li><a id="next-group" class="page-link" href="' . $href_link . '" title="' . sprintf(PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE, $max_page_links) . '" aria-label="' . ARIA_PAGINATION_ELLIPSIS_NEXT . '">...</a></li>';
            $display_links_string .= $link;
            $ul_elements .= '  <li class="page-item ellipsis">' . $link . '</li>' . "\n";
        }

        // Next button
        if ($this->number_of_pages !== 1 && $this->current_page_number < $this->number_of_pages) {
            $href_link = zen_href_link($_GET['main_page'], $parameters . 'page=' . ($this->current_page_number + 1), $request_type);
            $link = '<a id="next-link" class="page-link" href="' . $href_link . '" title="' . PREVNEXT_TITLE_NEXT_PAGE . '" aria-label="' . ARIA_PAGINATION_NEXT_PAGE . '">' . PREVNEXT_BUTTON_NEXT . '</a>';
            $display_links_string .= '<li class="page-item">' . $link . '</li>';
            $ul_elements .= '  <li class="page-item pagination-next">' . $link . '</li>' . "\n";
        }

        if ($counter_actual_page_links == 0) {
            return '';
        }

        $aria_label = empty($navElementLabel) ? ARIA_PAGINATION_ROLE_LABEL_GENERAL : sprintf(ARIA_PAGINATION_ROLE_LABEL_FOR, zen_output_string_protected($navElementLabel));
        $aria_label .= sprintf(ARIA_PAGINATION_CURRENTLY_ON, $this->current_page_number);
        
        return  
            '<nav id="pagination-nav" aria-label="' . $aria_label . '">' . "\n" .
                '<ul class="pagination justify-content-end">' . "\n" .
                    ($outputAsUnorderedList ? $ul_elements : $display_links_string) .
                '</ul>' . "\n" .
            '</nav>';
    }

    public function display_count($text_output)
    {
        $to_num = $this->number_of_rows_per_page * $this->current_page_number;
        if ($to_num > $this->number_of_rows) {
            $to_num = $this->number_of_rows;
        }

        $from_num = $this->number_of_rows_per_page * ($this->current_page_number - 1);

        if ($to_num === 0) {
            $from_num = 0;
        } else {
            $from_num++;
        }

        return ($to_num <= 1) ? '&nbsp;' : sprintf($text_output, $from_num, $to_num, $this->number_of_rows);
    }

    public function getSqlQuery()
    {
        return $this->sql_query;
    }
}
