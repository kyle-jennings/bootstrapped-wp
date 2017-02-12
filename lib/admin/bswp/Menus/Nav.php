<?php

namespace bswp\Menus;

class Nav {

    public $page;
    public $section;
    public $tab;
    public $settings;
    public $sections = array('site_settings');

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
        $this->section = isset($GLOBALS['bswp\Settings\Section']) ? $GLOBALS['bswp\Settings\Section'] : null;
        $this->tab = isset($_GET['tab']) ? $_GET['tab'] : null;

        $options = get_option('bswp_site_settings');
        $sections = $options['available_sections'];

        foreach($sections as $section=>$toggled){
            if($toggled == 'yes')
                $this->sections[] = str_replace('activate_','', $section.'_settings');
        }


        $current_tab_name_attr = 'bswp_'.$this->section_name.'[form_meta_settings][group_tab]';
        $this->current_tab_value = $current_tab_value = $this->get_form_settings('group_tab');
    }


    public function get_form_settings($field){
        $form_meta_settings = $GLOBALS['bswp\Settings\Section']->form_meta_settings;
        $setting = isset($form_meta_settings[$field]) ? $form_meta_settings[$field] : '';
        return $GLOBALS['bswp\Settings\Section']->form_meta_settings[$field];
    }


    /**
     * This is the green top navbar which allows users to navigate the current
     * section's settings
     * @param  [type] $active_tab [description]
     * @param  string $section    [description]
     * @return [type]             [description]
     */
    public function tabs_nav($active = null ){

        if(empty($this->section))
            return;

        $output = '';

        $output .= '<div class="overlay js--overlay js--sections-dropdown-toggle js--sections-dropdown"></div>';
        $output .= '<div id="settings-nav" class="nav-wrapper">';
            $output .= '<div class="components-nav cf">';

                $output .= '<a class="components-nav__link components-nav__link--section js--sections-dropdown-toggle" href="#" >';
                    $output .= '<span class="dashicons dashicons-welcome-widgets-menus"></span>';
                    $output .= ucfirst( str_replace('_',' ', $this->section->name ) );
                $output .= '</a>';
                $output .= $this->sections_dropdown_nav();

                foreach($this->section->groups as $group):

                    $name = $group->name;
                    $display_name = $group->display_name;


                    $active_tab = ( $name == ltrim($this->current_tab_value,'#') ) ? 'active' : '';

                    // if($active_tab == 'active')
                    //     examine($name);

                    $output .= '<a class="components-nav__link js--group-link '.$active_tab.'"';
                        $output .= 'data-toggle="tab"';
                        $output .= 'href="#'.$name.'">';
                            $output .= $display_name;
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
        $find = array('_');
        $replace = array(' ');


        $output .= '<ul id="groups-nav" class="section-dropdown-nav js--sections-dropdown">';

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
