<?php

class Pagination {
    public $output = '';

    public function __construct(){

        $output ='';

        global $wp_query;

        $total_pages = $wp_query->max_num_pages;

        if ($total_pages > 1){

          $current_page = max(1, get_query_var('paged'));
        //   $output .= '<div class="row">';

              $output .= '<div class="pagination">';
              $output .=  paginate_links(array(
                  'base' => get_pagenum_link(1) . '%_%',
                  'format' => 'page/%#%',
                  'current' => $current_page,
                  'total' => $total_pages,
                  'type' => 'list',
                  'prev_text' => 'Prev',
                  'next_text' => 'Next',
                  'mid_size' => 1,
                  'end_size' => 1
                ));
              $output .= '</div>';
        //   $output .= '</div>';

        }
        $this->output = $output;
    }

    public function __toString() {
        return $this->output;
    }
}
