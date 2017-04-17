<?php

class Sidebar
{
    public $output = '';
    public $sidebar;
    public $position;
    public $width;
    public $device_view;
    public $preview;


    public function __construct($sidebar = 'default', $position = 'none', $device_view = 'all', $preview = null)
    {

        $this->name = $sidebar;

        $this->position = $position;
        $this->width = in_array($this->position, array('top', 'bottom')) ? 'span12' : 'span3' ;
        $this->device_view = $device_view;
        $this->preview = $preview;
        if($this->position == 'none')
            return '';

        // examine($GLOBALS['TemplateSettings']::$sidebar_settings);
        // examine($GLOBALS);
        $this->isSidebarSection = $GLOBALS['TemplateSettings']::$sidebarSectionActivated;
        $this->isHorizontalSidebarSection = $GLOBALS['TemplateSettings']::$horizontalSidebarSectionActivated;

        $this->output = $this->getSidebar();


        if($this->preview == 'preview' && strpos($this->name, 'frontpage') !== false){}
            return $this->setWidgetWidth($this->name, $this->position);
    }


    public function __toString() {

        return $this->output;
    }


    /**
	 * builds and gets the sidebar, must call setSidebarArea to get the correct widgts
	 * @param  string $sidebar     [description]
	 * @param  [type] $position    [description]
	 * @param  [type] $width       [description]
	 * @param  [type] $device_view [description]
	 * @return [type]              [description]
	 */
	public function getSidebar()
	{

        $output = '';
        $width_class = $this->isHorizontalSection() ? '' : $this->width;

		ob_start();
			dynamic_sidebar($this->name);
		$content = ob_get_clean();

        $output .= '<div class="section section--sidebar sidebar-'.$this->position.' '.$width_class.' '.$this->device_view.'">';
            $output .= '<div class="container">';

                if($this->width == 'span12')
                    $output .= '<div class="row">' . $content .'</div>';
                else
                    $output .= $content;

            $output .= '</div>';
        $output .= '</div>';


		return $output;
	}


    public function isHorizontalSection()
    {
        // examine($this->isSidebarSection .'--'. $this->position);
        if(
            ($this->isSidebarSection == 'yes' || $this->isHorizontalSidebarSection == 'yes')
            && in_array($this->position, array('top', 'bottom'))
        ){
            return true;
        }

        return false;
    }


    public static function getFrontpagePos($frontpage_sidebar = null) {
        if(!$frontpage_sidebar)
            return;

        $frontpage_sidebar = json_decode($frontpage_sidebar);
        $orientation = 'none';

        if( in_array($frontpage_sidebar->position, array('left','right')) )
            $orientation = 'vertical';
        elseif(in_array($frontpage_sidebar->position, array('top','bottom')))
            $orientation = 'horizontal';

        return $orientation;

    }

    public function setWidgetWidth($name, $position)
    {

        // examine(wp_get_sidebars_widgets());
        $sidebars = wp_get_sidebars_widgets();
        $widgets = $sidebars[$name];
        $count = count($widgets);
        $this->count = $count;

        $options = get_option('bswp_site_settings');
        $frontpage_sidebar = $options['layouts']['sidebars']['frontpage'];

        // if no position is provided, or its "none" then we do nothing
        if($position == 'none' || !$position)
            return;

        if( strpos($name, 'frontpage_widgets_') !== false
            && $this->getFrontpagePos($frontpage_sidebar) == 'vertical'
        ){
            $width = $this->widgetWidthNarrow($count);
        }
        elseif( in_array($position, array('left', 'right')))
            $width = "";
        else
            $width = $this->widgetWidthWide($count);

        $this->output = preg_replace('/(class="widget (span(\d))*")/', 'class="widget '.$width.'"', $this->output);

    }


    public function widgetWidthNarrow($count)
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


    public function widgetWidthWide($count)
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
