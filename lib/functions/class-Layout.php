<?php


/**
 * This is the layout class. It builds the main content shit
 */
class Layout {

	public $output = '';
    private $template;
    public $site_settings;

    public function __construct(){
        $this->site_settings = get_option('bswp_site_settings');
        $this->get_layout_settings();

    }

	public function __toString(){
		$this->output = $this->scaffolding_init();
		return $this->output;
	}

    public function is_body_contained() {
        $layout = $this->site_settings['misc']['layout'];
        $full_width = ($layout['full_width'] == 'no') ? true : false;

        return $full_width;
    }


    public function contain_section() {
        $contained = $this->is_body_contained();
        return $contained ? '' : 'container';
    }

	public function scaffolding_init(){

        $content = new Content();
        $content::set_template($this->template);

        $layout_settings = $this->template;

		$template = $layout_settings['name'];

		$scaffolding_markup = '';


        $widthClass = 'span12';

		// get the title
		// $scaffolding_markup .= $this->get_the_title();

		//start scaffolding
		$scaffolding_markup .= '<div id="body" class="section section--body '.$confineClass.'">';
			$scaffolding_markup .= '<div class="'.$this->contain_section().'">';
				$scaffolding_markup .= '<div class="row">';


                    examine($template);
					/* ----------------- top or left sidebar ------------------- */
					 if($position =='top' || $position =='left'){

						$scaffolding_markup .= ($position =='top') ?
			                new Sidebar($template,'horizontal',$position, $device_view) :
			                new Sidebar($template,null,$position, $device_view);
					}

					//content div
					$scaffolding_markup .= '<div id="main-content" class="'.$widthClass.'">';

					/* ---------------------- The Loop ----------------------- */
					if (have_posts()){

						if($pagination_top == 'true'){
							$scaffolding_markup .= new Pagination();
						}

						//open content-list/single wrapper
						if( !is_single() && !is_page() && !is_attachment() ){
							$scaffolding_markup .= '<div class="content-list">';
						}else{
							$scaffolding_markup .= '<div class="content-single">';
						}
						 while (have_posts()){

							the_post();
							$scaffolding_markup .= $content;

						}

					 	//close content-list/single wrapper
						$scaffolding_markup .= '</div>';

						// pagination
						$scaffolding_markup .= new Pagination();

					}else{
							$scaffolding_markup .= '<div class="content-wrapper">';
									$scaffolding_markup .= kjd_the_404();
							$scaffolding_markup .= '</div>';
					}
					/* ---------------------- End Loop ----------------------- */

					//end main content
					$scaffolding_markup .= '</div>'; // end maincontent span

		/* ----------------- right or bottom sidebar ------------------- */
			if($position =='bottom' || $position =='right'){
    			$scaffolding_markup .= ($position =='bottom') ?
		            new Sidebar($template,'horizontal',$position, $device_view) :
                    new Sidebar($template,null,$position, $device_view);
			}


		// close scaffolding

				$scaffolding_markup .= '</div>';//	<!-- end row -->
			$scaffolding_markup .= '</div>';// <!-- end container -->
		$scaffolding_markup .= '</div>'; //<!-- end body -->


		return $scaffolding_markup;

	}


	/**
	 * This detects the current page's/post's /feed's template and gets teh layout settings appropriately
	 * Layout settings for now, are nothing more than the position of the sidebar, as well as sidebar visibility.
	 *
	 * @param  [type] $template [description]
	 * @return [type]           [description]
	 */
	public function get_layout_settings() {

		//	if the page is a post type

		if( is_single() ){

			$template = 'single';

		}elseif( is_attachment() ){

			$template = 'attachment';

		}elseif( is_404() ){

			$template = '404';

		}elseif( is_category() ){

			$template = 'category';

		}elseif( is_archive() ){

			$template = 'archive';

		}elseif( is_tag() ){

			$template = 'tag';

		}elseif( is_author() ){

			$template = 'author';

		}elseif( is_date() ){

			$template = 'date';

		}elseif( is_search() ){

			$template = 'search';

		}elseif( is_front_page() ){

			$template = 'front_page';

		}elseif( is_page() ){

			// if current page is page template
			if( is_page_template() ){

				$is_page_template = true;

				if ( is_page_template('pageTemplate1.php') ){

					$template = 'template_1';

				}elseif( is_page_template('pageTemplate2.php') ){

					$template = 'template_2';

				}elseif( is_page_template('pageTemplate3.php') ){

					$template = 'template_3';

				}elseif( is_page_template('pageTemplate4.php') ){

					$template = 'template_4';

				}elseif( is_page_template('pageTemplate5.php') ){

					$template = 'template_5';

				}elseif( is_page_template('pageTemplate6.php') ){

					$template = 'template_6';

				}else{

					$template = 'page';
				}


			// if current page is a page but not a template
			}else{
				$template = 'page';
			}

		//fallback - if not a post template OR a page
		}else{

			$template = 'index';
		}

		if( !empty($layout_settings[$template]) &&
            ($layout_settings[$template]['toggled'] == 'true' || $is_page_template == true) ){

			$this->layout_settings = $layout_settings[$template];

		}else{

			$this->layout_settings = $layout_settings['default'];
		}


		$this->template = $template;

	}


}
