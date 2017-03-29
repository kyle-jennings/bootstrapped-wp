<?php

// Page Template One Widgets
if ( !function_exists('register_sidebar') )
    return;

class SetupWidgets {

    public static $templates = array(
        'frontpage',
        'feed',
        'single',
    );
    public static $sidebars;

    public function __construct()
    {

        $site_settings = get_option('bswp_site_settings');
        $layouts = $site_settings['layouts'];
        self::$sidebars = $layouts['sidebars'];

    }


    function registerSidebars()
    {
        foreach(self::$sidebars as $sidebar=>$setting){
            if(strpos($sidebar, '_location') == false)
                continue;

            $pos = $setting;
            $name = substr($sidebar, 0, strpos($sidebar, '_'));
            $width = self::setWidgetWidth($name,$pos);

        	register_sidebar(
        		 array(
        			'name' => $name,
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

    public static function setWidgetWidth($sidebar, $sidebar_pos)
    {
        $sidebars = wp_get_sidebars_widgets($sidebar);
        $widgets = $sidebars[$sidebar];
        $count = count($widgets);

        if($sidebar_pos == 'none' || !$sidebar_pos)
            return;


        if( in_array($sidebar_pos, array('left', 'right')))
            $width = self::widgetWidthNarrow($count);
        else
            $width = self::widgetWidthWide($count);

        return $width;
    }


    public static function widgetWidthNarrow($count)
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
