<?php

class Sidebar
{
    public $output = '';
    public $sidebar;
    public $position;
    public $width;
    public $device_view;

    public function __construct($sidebar = 'default', $position = 'none', $device_view = 'all')
    {

        $this->sidebar = !strpos('_widgets',$sidebar) ? $sidebar.'_widgets' : $sidebar;

        $this->position = $position;
        $this->width = in_array($this->position, array('top', 'bottom')) ? 'span12' : 'span3' ;
        $this->device_view = $device_view;

        if($this->position == 'none')
            return '';


        $this->output = $this->getSidebar();

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


		ob_start();
			dynamic_sidebar($this->sidebar);
		$content = ob_get_clean();
    

		$output .= '<div class="sidebar sidebar--'.$this->position.' '.$this->width.' '.$this->device_view.'">';

            if($this->width == 'span12')
                $output .= '<div class="row">' . $content .'</div>';
            else
                $output .= $content;

		$output .= '</div>';


		return $output;
	}

	public function setSidebarArea($sidebar = null)
    {

		$available_sidebars = array(
			'template_1', 'template_2', 'template_3', 'template_4', 'template_5', 'template_6',
			'frontpage_widgets_1', 'frontpage_widgets_2', 'header_widgets', 'footer_widgets',
            'default', 'frontpage','feed', 'single'
		);
		if( !empty($post_templates) ){
			foreach($post_templates as $k => $v){
				$available_sidebars[] = $k;
			}
		}


		if(!in_array($sidebar, $available_sidebars)){
			$sidebar = 'default';
		}


		return $sidebar;
	}

}
