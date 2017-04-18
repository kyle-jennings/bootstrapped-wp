<?php


/**
* This is the layout class. It builds the main content shit
*/
class Layout {

    public static $output = '';

    public static $template;
    public static $template_type;
    public static $feed_type;

    public static $site_settings;
    public static $full_width;

    public static $sidebar;
    public static $sidebar_settings;
    public static $isSidebarSection;
    public static $isHorizontalSidebarSection;

    public static $content;

    public function __construct($content = null){

        // set the page type - used for previews mostly
        self::$template_type = $GLOBALS['TemplateSettings']::$template_type;
        self::$template = $GLOBALS['TemplateSettings']::$template;
        self::$feed_type = $GLOBALS['TemplateSettings']::$feed_type;
        self::$full_width = $GLOBALS['TemplateSettings']::$full_width;
        self::$sidebar_settings = $GLOBALS['TemplateSettings']::$sidebar_settings;

        self::sidebarPosition();
        self::$content = $content;

    }

    public function __toString(){
        self::$output = self::scaffolding_init();
        return self::$output;
    }

    public static function is_body_contained() {
        $layout = self::$site_settings['misc']['layout'];
        $full_width = ($layout['full_width'] == 'no') ? true : false;

        return $full_width;
    }


    public static function contain_section() {
        $contained = self::is_body_contained();
        return $contained ? '' : 'container';
    }



    public static function scaffolding_init(){

        $output = '';

        // get the title
        // $output .= self::$get_the_title();
        self::$isSidebarSection = $GLOBALS['TemplateSettings']::$sidebarSectionActivated;
        self::$isHorizontalSidebarSection = $GLOBALS['TemplateSettings']::$horizontalSidebarSectionActivated;

        //start scaffolding
        if( self::isHorizontalSection() && self::$sidebar->position =='top' )
            $output .= new Sidebar(self::$template_type, self::$sidebar->position, self::$sidebar->visibility);

        $output .= '<div class="section section--body">';
            $output .= '<div class="'.self::contain_section().'">';
                $output .= '<div class="row">';

                    $output .= new Columns(self::$template_type, self::$sidebar, self::$content, self::isHorizontalSection() );

                $output .= '</div>';//	<!-- end row -->
            $output .= '</div>';// <!-- end container -->
        $output .= '</div>'; //<!-- end body -->


        if( self::isHorizontalSection() && self::$sidebar->position =='bottom' )
            $output .= new Sidebar(self::$template_type, self::$sidebar->position, self::$sidebar->visibility);


        return $output;

    }

    public static function isHorizontalSection()
    {

        if(
            (self::$isSidebarSection == 'yes' || self::$isHorizontalSidebarSection == 'yes')
            && in_array(self::$sidebar->position, array('top', 'bottom'))
        ){
            return true;
        }

        return false;
    }


    public static function sidebarPosition()
    {
        $sidebars = self::$sidebar_settings;

        if(empty($sidebars))
            return;
        
        foreach($sidebars as $name=>$sidebar){
            if(strpos($name, self::$template_type) !== false) {

                self::$sidebar = json_decode($sidebar);
            }

        }
    }


}
