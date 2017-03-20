<?php

class Sidebar
{
    public $output = '';
    public $sidebar;
    public $location;
    public $width;
    public $device_view;

    public function __construct($sidebar = 'default', $location = null, $width = null, $device_view = null)
    {
        $this->sidebar = $sidebar;
        $this->location = $location;
        $this->width = $width;
        $this->device_view = $device_view;

        $this->output = $this->kjd_get_sidebar();
    }


    public function __toString() {
        return $this->output;
    }


    /**
	 * builds and gets the sidebar, must call kjd_set_sidebar_area to get the correct widgts
	 * @param  string $sidebar     [description]
	 * @param  [type] $location    [description]
	 * @param  [type] $width       [description]
	 * @param  [type] $device_view [description]
	 * @return [type]              [description]
	 */
	public function kjd_get_sidebar()
	{

        $output = '';
		$location_class = ($this->location == 'horizontal') ? 'span12' : 'span3' ;

		$sidebar = $this->kjd_set_sidebar_area($this->sidebar);
		ob_start();
			dynamic_sidebar($sidebar);
			$content = ob_get_contents();
		ob_end_clean();
		$output .= '<div id="side-content" class="section section--sidebar '.$location_class.' '.$this->location.'-widgets '.$this->device_view.'">';
				$output .= '<div class="row">' . $content .'</div>';
		$output .= '</div>';


		// return $the_buffered_sidebar;
		return $output;
	}


	public function kjd_set_sidebar_area($sidebar = null)
    {

		// echo $sidebar; die();
		$post_templates = get_option('kjd_post_layout_settings');
		$post_templates = $post_templates['kjd_post_layouts'];

		$available_sidebars = array(
			'template_1', 'template_2', 'template_3', 'template_4', 'template_5', 'template_6',
			'front_page_widget_area_1', 'front_page_widget_area_2', 'header_widgets', 'footer_widgets','default'
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
