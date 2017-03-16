<?php

class FeaturedPost {

    public $id;
    public $post_type;
    public $format;

    public $date_format = 'n/j/Y';
    public $output = '';

    public function __construct($id, $post_type = 'post', $format = null) {
        $this->id = $id;

        $this->$post_type = $post_type;
        $this->format = $format;

        $this->post_information();
        $this->post_image();
        $this->set_content();
    }

    public function __toString() {
        return $this->output;
    }

    public function set_content() {
        $output = '';
        $output .= '<h1 class="header-content__title" >';
            $output .= $this->title;
        $output .= '</h1>';

        $output .= '<div class="header-content__meta">';

            $output .= '<div class="header-content__terms">';
                $output .= $this->terms;
            $output .= '</div>';

            $output .= '<div class="header-content__date">';
                $output .= $this->date;
            $output .= '</div>';

        $output .= '</div>';

        if($this->format == 'use-excerpt' && $this->excerpt ){
            $output .= '<p class="header-content__description">';
                $output .= $this->excerpt;
            $output .= '</p>';
        }

        $this->output = $output;
    }

    private function post_information() {

        $id = $this->id;

        $this->title = get_the_title($id);

        // $this->terms = wp_get_post_terms($id, 'category');
        $this->terms = get_the_term_list( $id, 'category', null, ', ' );

        $this->date = get_the_date($this->date_format, $id );
        $this->url = get_permalink($id);
        $this->excerpt = get_the_excerpt($id);

    }


    private function post_image() {
        $sizes = get_intermediate_image_sizes();

        $thumb_id = get_post_thumbnail_id($this->id);
        $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
        $this->image = $thumb_url_array[0];
    }




}
