<?php


function get_page_id($url) {
    $number = url_to_postid($url);
    $id = null;
    if($number > 0)
        $id = $number; // a page
    else{
        $posts_id = get_option('page_for_posts', true);
        $page_for_posts_url = get_permalink( $posts_id );
        if( rtrim($url,'/') == rtrim($page_for_posts_url,'/') )
            $id = $post_id; // the posts page
        else
            $id =  null;  // front page
    }

    return $id;
}
