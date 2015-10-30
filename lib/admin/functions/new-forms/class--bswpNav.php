<?php

class bswpNav {

    public $page;
    public $section;
    public $tab;

    public $sections = array(
        'theme_settings',
        'header_settings',
        'navbar_settings',
        'nav_dropdown_settings',
        'mobile_nav_settings',
        'page_title_settings',
        'body_settings',
        'feed_settings',
        'footer_settings',
    );

    public $tabs = array(
        'background',
        'borders',
        'headings',
        'text',
        'components',
        'images',
        'settings'
    );

    public function __construct(){

        $this->page = isset($_GET['page']) ? $_GET['page'] : null;
        $this->section = isset($_GET['section']) ? $_GET['section'] : 'theme_settings';
        $this->settings = isset($_GET['settings']) ? $_GET['settings'] : null;
        $this->tab = isset($_GET['tab']) ? $_GET['tab'] : null;

    }

    /**
     * This is the green top navbar which allows users to navigate the current
     * section's settings
     * @param  [type] $active_tab [description]
     * @param  string $section    [description]
     * @return [type]             [description]
     */
    public function tabs_nav($settings = array(), $active = null ){

        if(empty($settings))
            return;

        $output = '';

        $output .= '<div class="overlay js--overlay js--sections-dropdown-toggle js--sections-dropdown"></div>';
        $output .= '<div class="nav-wrapper">';
            $output .= '<div class="components-nav cf">';

                $output .= '<a class="components-nav__link components-nav__link--section js--sections-dropdown-toggle" href="#" >';
                    $output .= '<span class="dashicons dashicons-welcome-widgets-menus"></span>';
                    $output .= ucfirst( str_replace('_',' ', $this->section ) );
                $output .= '</a>';
                $output .= $this->sections_dropdown_nav();

                foreach($settings as $tab):

                    $name = $tab['section'];
                    $title = ucwords( str_replace('_',' ', $name ) );

                    $active_tab = $name == $this->settings ? 'active' : '';

                    $output .= '<a class="components-nav__link '.$active.'"';
                        $output .= 'data-toggle="tab"';
                        $output .= 'href="#'.$name.'">';
                            $output .= $title;
                    $output .= '</a>';
                endforeach;
            $output .= '</div>';
        $output .= '</div>';

        return $output;

    }

    /**
     * This dropdown appears at the beginning of the green nav bar, it allows
     * users to navigate between the different sections
     * @return [type] [description]
     */
    public function sections_dropdown_nav(){

        $output = '';

        $sections = $this->sections;
        $find = array('_settings','_');
        $replace = array('',' ');


        $output .= '<ul class="section-dropdown-nav js--sections-dropdown">';

        foreach($sections as $section):
            $label = str_replace($find,$replace ,$section);
            $label = ucwords($label);

            $output .= '<li>';
                $output .= '<a href="?page=bswp_settings&section='.$section.'">';
                    $output .= $label;
                $output .= '</a>';
            $output .= '</li>';
        endforeach;

        $output .= '</ul>';

        return $output;
    }

}