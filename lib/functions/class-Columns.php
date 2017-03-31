<?php

class Columns {

    public static $output = '';
    public static $content;
    public static $template;
    public static $sidebar;
    public static $width;

    public function __construct($sidebar = null, $content, $template = null)
    {

        self::$content = $content;;
        self::$template = $template;
        self::$sidebar = $sidebar;
        $width = in_array($sidebar->position, array('left', 'right')) ? 'span9' : 'span12';

        $output = '';

        // sidebar if on top on left
        if($sidebar->position =='top' || $sidebar->position =='left')
            $output .= new Sidebar(self::$template, $sidebar->position, $sidebar->visibility);


        $output .= self::mainColumn($width, $content, false);

        // sidebar if on bottom or right
        if($sidebar->position =='bottom' || $sidebar->position =='right')
            $output .= new Sidebar(self::$template, $sidebar->position, $sidebar->visibility);

        self::$output = $output;
    }

    public function __toString()
    {
        return self::$output;
    }

    public static function loop()
    {
        $content = new Content();
        $content::set_template(self::$template);

        $output = '';
        /* ---------------------- The Loop ----------------------- */
        if (have_posts()){

            if($pagination_top == 'true'){
                $output .= new Pagination();
            }

            //open content-list/single wrapper
            if( !is_single() && !is_page() && !is_attachment() ){
                $output .= '<div class="content-column__feed">';
            }else{
                $output .= '<div class="content-column__single">';
            }
            while (have_posts()){
                the_post();
                $output .= $content;
            }

            $output .= '</div>'; //close content-column__list/single wrapper

            // pagination
            $output .= new Pagination();

        }else{
            $output .= '<div class="content-column__single">';
                $output .= kjd_the_404();
            $output .= '</div>';
        }

        return $output;
    }



    public static function mainColumn($width = 'span12', $content = null, $pagination_top = false) {

        $output = '';
        //content div
        $output .= '<div class="content-column '.$width.'">';

            $output .= $content ? $content : self::loop();

        //end main content
        $output .= '</div>'; // end maincontent span

        return $output;
    }

}
