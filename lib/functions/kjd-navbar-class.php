<?php

/**
 * This class builds the navbar, this is my first attempt at OOP so its probably going to be pretty rough
 *
 * The first function builds the navbar, it accepts a number of arguments to build everything out
 */
class kjdNavBar{
	
	public $output = '';

	//							menu id,  nav style,   link style, sidr/dropdown/ect,     devise visibility,  position, logo, menu id again for some reason, button type
	public function kjd_build_navbar( $menu_id, $navbar_width, $link_type, $mobilenav_style, $visibility = null, $position, $logo = '', $use_mobile_menu = 'false', $button_type ='default', $walker = 'drop_down' ){

			$navbar_style = '';

			// sets the navbar type
			switch( $position ){
				// navbar in default position
				case 'default':
					$navbar_style .= 'navbar-static-top';
					break ;
				// we want to STICK the navbar to the top of the page - it will scroll WITH the page
				case 'fixed-top':
					$navbar_style .= 'navbar-fixed-top';
					break ;
				// we want to STICK the navbar to the bottom of the page - it will scroll WITH the page
				case 'fixed-bottom':
					$navbar_style .= 'navbar-fixed-bottom';
					break ;
				// navbar is just placed at the top of the page
				case 'static-top':
					$navbar_style .= 'navbar-static-top';
					break ;
			
				default:
					$navbar_style .= 'navbar-static-top';
			}

			if( $navbar_width == 'contained' ){
				$navbar_style .= ' container navbar' ;
			}

			$navbar_open = '<div id="navbar" class=" '. $visibility .' '. $menu_id .' '. $navbar_style . '">';


				$navbar_open .= $nav_wrapper;

					$navbar_inner = '';

					
					$navbar_inner .= '<div class="navbar-inner">';
						
						// if the navbar type is not set to contained then we need to put the container inside the inn=er
						if( $navbar_width != 'contained' ){
							$navbar_inner .= '<div class="container">';
								$navbar_inner .= '<div class="navbar">';
						}

						if( ($logo != 'none' && $logo != '') ){
							
							if( $logo == 'logo' ){
								
								$options = get_option('kjd_mobileNav_misc_settings');
								$options = $options['kjd_mobileNav_misc'];
								$url = $options['mobile_site_logo'];
								
								$navbar_inner .= '<a class="hidden-desktop brand '.$logo.'" href="'.home_url().'"><img src="'.$url.'" /></a>';
					
							}else{
								$navbar_inner .= '<a class="hidden-desktop brand '.$logo.'" href="'.home_url().'">'.get_bloginfo( 'name' ).'</a>';
							}

						}

							$navbar_inner .= $this->kjd_mobile_nav_button_type( $button_type, $mobilenav_style );

						// The nav-collapse - it holds the menu

							
							$navbar_inner .='<div class="nav-collapse collapse navbar-responsive-collapse">';

							$navbar_inner .= $this->kjd_build_menu( $menu_id, $link_type, $use_mobile_menu, $walker );

							$navbar_inner .= $navbar_contents;
							$navbar_inner .= '</div>'; // en nav collapse
							

						// if the navbar type is not set to contained then we need to put the container inside the inner
						if( $navbar_width != 'contained' ){
								$navbar_inner .='</div>'; // end navbar -->

							$navbar_inner .='</div>'; // end container -->
						}


					$navbar_inner .='</div>'; // end navbar-inner-->
		

				$navbar_close = '</div>'; // end #navbar

			$this->output = $navbar_open . $navbar_inner . $navbar_close;
			return $this->output;
	}

	public function kjd_build_menu( $menu_id = 'primary-menu', $navbar_link_style = 'none', $use_mobile_menu, $walker = 'drop_down'){
		
		if($walker == 'drop_down'){
			$walker_type = new dropdown_menu();
		}elseif( $walker = 'sidr_menu'){
			$walker_type = new sidr_menu();
		}else {
			$walker_type = '';
		}


		$menu_class = 'nav';
		
		switch($navbar_link_style){
			case 'none':

				$menu_class .= ' nav-noBG';
				break;
			case 'dividers':

				$menu_class .= ' nav-dividers';
				break;
			case 'pills':

				$menu_class .= ' nav-pills';
				break;
			case 'tabs':

				$menu_class .= ' nav-tabs';
				break;
			case 'tabs-below':

				$menu_class .= ' nav-tabs tabs-below';	
				break;
			case 'sidr-style':
			
				$menu_class .= ' nav-tabs nav-stacked';
				break;
			default:
				$menu_class .= ' nav-noBG';
		}


		/*
			if the mobile nav is activated and set we use that. if its not set but its activated, then we use the primary nav,
			otherwise, we display the default menu
		*/
		if ( $menu_id == 'mobile-menu' ){

			if ( $use_mobile_menu == 'true' && has_nav_menu( 'mobile-menu' ) ){
				ob_start();
				wp_nav_menu(array('theme_location' => 'mobile-menu', 
					'menu_class' =>$menu_class,
					'container'=> '',
					'walker'=> $walker_type
				 ) );
				$menu = ob_get_contents();
				ob_end_clean();

				return $menu;
			
			}elseif( has_nav_menu( 'primary-menu' ) ){


				ob_start();
				wp_nav_menu(array('theme_location' => 'primary-menu', 
					'menu_class' =>$menu_class,
					'container'=> '',
					'walker'=> $walker_type
				 ) );
				$menu = ob_get_contents();
				ob_end_clean();
				return $menu;

			}else {
			
			    $menu = '';

			    $menu .= '<ul class="nav nav-pills hidden-desktop">';
				$menu .= '<li><a href="'. home_url() .'/" title="home">Home</a></li>';
				if( is_user_logged_in() ){
					$menu .= '<li><a href="'. home_url() .'/wp-admin/nav-menus.php" title="set menus" >Set Menu</a></li>';

				}else{

					$menu .= '<li><a href="'. wp_login_url() .'/" title="login" >Login</a></li>';
				}
			    $menu .= '</ul>';

			    return $menu;
			} 

		}else{
			/*
				If the primary nav is set, then we use that.
				otherwise, we display the default menu
			*/
			if ( has_nav_menu( 'primary-menu' ) ){
				
				ob_start();
				wp_nav_menu(array('theme_location' => 'primary-menu', 
					'menu_class' =>$menu_class,
					'container'=> '',
					'walker'=> $walker_type
				 ) );
				$menu = ob_get_contents();
				ob_end_clean();
			
				return $menu;
			} else {
			    
			    $menu = '';

			    $menu .= '<ul class="nav nav-pills visible-desktop">';
				$menu .= '<li><a href="'. home_url() .'/" title="home">Home</a></li>';
				if( is_user_logged_in() ){
					$menu .= '<li><a href="'. home_url() .'/wp-admin/nav-menus.php" title="set menus" >Set Menu</a></li>';

				}else{

					$menu .= '<li><a href="'. wp_login_url() .'/" title="login" >Login</a></li>';
				}
			    $menu .= '</ul>';

			    return $menu;
			} 

		}

		return;
	}

	public function kjd_mobile_nav_button_type( $button_type, $mobilenav_style  ) {

		$output = '';
		$button_class = '';
		$button_misc = get_option('kjd_mobileNav_misc_settings');
		$button_misc = $button_misc['kjd_mobileNav_misc'];

		switch($button_type):
			case 'default':
				$button_class = "btn btn-navbar";

				$button_inner = '';
				$button_inner .= '<span class="icon-bar"></span>';
				$button_inner .= '<span class="icon-bar"></span>';
				$button_inner .= '<span class="icon-bar"></span>';
				break;
			case 'hamburger':
				$button_class = "btn btn-navbar btn-hamburger";

				$button_inner = '';
				$button_inner .= '<span class="icon-bar"></span>';
				$button_inner .= '<span class="icon-bar"></span>';
				$button_inner .= '<span class="icon-bar"></span>';

				break;		
			case 'button':
				$button_class = "btn ".$button_misc['menu_button_color'];
				$button_inner = $button_misc['menu_btn_text'];;
				break;
			case 'text':
				$button_class = "menu-text";
				
				$button_inner = $button_misc['menu_btn_text'];
				break;
			case 'image':
				$button_class = "menu-image";

				$button_inner = 'image';
				break;
			default:
				$button_class = "btn btn-navbar";
				break;		
		endswitch;

		if($mobilenav_style =='sidr'){
			$output .= '<a id="sidr-toggle" class="navbar-menu-btn '.$button_class.'">';
		}else{
			$output .= '<a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="navbar-menu-btn '.$button_class.'">';
		}
			$output .= $button_inner;
		$output .= '</a>';

		return $output;
	}

	public function __toString(){
		
		return $this->output;
		// return  $this->kjd_build_navbar();
	}


}