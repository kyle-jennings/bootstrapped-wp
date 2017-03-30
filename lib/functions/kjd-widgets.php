<?php

// Page Template One Widgets
if ( !function_exists('register_sidebar') )
    return;

class SetupWidgets {

    public static $sidebars;
    public static $frontpage_sidebar;

    public function __construct()
    {

        $site_settings = get_option('bswp_site_settings');
        $layouts = $site_settings['layouts'];
        self::$sidebars = $layouts['sidebars'];

        self::$frontpage_sidebar = json_decode($layouts['sidebars']['frontpage_sidebar']);
        $frontpage = $layouts['frontpage']['frontpage_layout_sortable'];

        self::get_frontpage_widget_areas($frontpage);
    }


    function get_frontpage_widget_areas($frontpage)
    {
        $sortables = json_decode($frontpage);


        foreach($sortables as $sortable):
            if(strpos($sortable->name, 'widgets') == false )
                continue;
            $s = new stdClass();
            $s->position = 'top';
            $s->visibility = $sortable->visibility;
            self::$sidebars[$sortable->name] = json_encode($s);
        endforeach;

    }


    function registerSidebars()
    {


        foreach(self::$sidebars as $name=>$sidebar){

            $sidebar = json_decode($sidebar);

            $pos = $sidebar->position;

            if(strpos($name, 'frontpage_widgets') !== false){
                $frontpage_sidebar_vert = self::get_frontpage_pos();
            }

            $display_name = ucwords(str_replace('_', ' ', $name));
            $width = self::setWidgetWidth($name, $pos, $frontpage_sidebar_vert);
        	register_sidebar(
        		 array(
        			'name' => $display_name,
        			'id' => $name,
        			'description' => 'Widgets for the ' .ucwords(str_replace('_',' ',$name)) . 'page',
        			'before_widget' =>'<div class="widget '.$width.'">',
        			'before_title' => '<h3>',
        			'after_title' => '</h3>',
        			'after_widget' => '</div>'
        		)
        	);
        }
    }


    public static function get_frontpage_pos() {
        if( in_array(self::$frontpage_sidebar->position, array('left','right')) )
            return true;
    }


    public static function setWidgetWidth($sidebar, $sidebar_pos, $frontpage_sidebar_vert = false)
    {


        $sidebars = wp_get_sidebars_widgets($sidebar);
        $widgets = $sidebars[$sidebar];
        $count = count($widgets);


        if($sidebar_pos == 'none' || !$sidebar_pos)
            return;

        if( in_array($sidebar_pos, array('left', 'right')))
            $width = "";
        elseif($frontpage_sidebar_vert)
            $width = self::widgetWidthNarrow($count);
        else
            $width = self::widgetWidthWide($count);

        return $width;
    }


    public static function widgetWidthNarrow($count)
    {

        switch($count):
			case 1:
				return 'span9';
				break;
			case 2:
				return 'span4';
				break;
			case 3:
				return 'span3';
				break;
			case 4:
				return 'span2';
				break;
			case 5:
				return 'span1';
				break;
			case 6:
				return 'span1';
				break;
        endswitch;
    }


    public static function widgetWidthWide($count)
    {
        switch($count):
            case 1:
                return 'span12';
                break;
            case 2:
                return 'span6';
                break;
            case 3:
                return 'span4';
                break;
            case 4:
                return 'span3';
                break;
            case 5:
                return 'span2';
                break;
            case 6:
                return 'span2';
                break;
        endswitch;
    }
}


$SetupWidgets = new SetupWidgets();
$SetupWidgets::registerSidebars();
