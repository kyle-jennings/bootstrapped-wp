<?php

// Page Template One Widgets
if ( !function_exists('register_sidebar') )
    return;

class SetupWidgets {

    public static $sidebars;
    public static $frontpage_sidebar;
    public static $frontpage_orientation = null;

    public function __construct()
    {

        $site_settings = get_option('bswp_site_settings');
        $layouts = $site_settings['layouts'];
        self::$sidebars = $layouts['sidebars'];
        self::$sidebars['footer'] = '{"position":"top","visibility":"all"}';

        self::$frontpage_sidebar = json_decode(self::$sidebars['frontpage']);

        $frontpage = $layouts['frontpage']['frontpage_layout_sortable'];

        self::get_frontpage_widget_areas($frontpage);

    }


    public static function get_frontpage_widget_areas($frontpage)
    {
        $sortables = json_decode($frontpage);

        if(empty($sortables))
            return;

        foreach($sortables as $sortable):
            if(strpos($sortable->name, 'widgets') == false )
                continue;
            $s = new stdClass();
            $s->position = 'top';
            $s->visibility = $sortable->visibility;
            self::$sidebars[$sortable->name] = json_encode($s);
        endforeach;

    }


    public static function registerSidebars()
    {

        foreach(self::$sidebars as $name=>$sidebar){

            $sidebar = json_decode($sidebar);
            $pos = $sidebar->position;

            $display_name = ucwords(str_replace('_', ' ', $name));
            $width = self::setWidgetWidth($name, $pos);
        	register_sidebar(
        		 array(
        			'name' => $display_name,
        			'id' => $name,
        			'description' => 'Widgets for the ' .ucwords(str_replace('_',' ',$name)) . ' page',
        			'before_widget' =>'<div class="widget '.$width.'">',
        			'before_title' => '<h3>',
        			'after_title' => '</h3>',
        			'after_widget' => '</div>'
        		)
        	);

        }
    }


    public static function getFrontpagePos()
    {

        if( in_array(self::$frontpage_sidebar->position, array('left','right')) )
            return 'vertical';
        elseif(in_array(self::$frontpage_sidebar->position, array('top','bottom')))
            return 'horizontal';
        else
            return 'none';

    }


    public static function setWidgetWidth($name, $position)
    {

        // examine(wp_get_sidebars_widgets());
        $sidebars = wp_get_sidebars_widgets();
        $widgets = $sidebars[$name];
        $count = count($widgets);





        if($position == 'none' || !$position)
            return;


        // if we are on the frontpage and the sidebar is set to left or right,
        if( strpos($name, 'frontpage_widgets') !== false && self::getFrontpagePos() == 'vertical'){
            $width = self::widgetWidthNarrow($count);
        }
        elseif( in_array($position, array('left', 'right')))
            $width = "";
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
add_action( 'init', array('SetupWidgets', 'registerSidebars'), 1);
