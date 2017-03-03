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
        $sections = !empty( $options['available_sections']) ?  $options['available_sections'] : array();
        $sections = array_merge($this->sections,$sections);


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

        $output .= '<div class="overlay js--overlay"></div>';
        $output .= '<div id="settings-nav" class="nav-wrapper">';
            $output .= '<div class="components-nav cf">';

                $output .= '<a class="components-nav__link
                            components-nav__link--dropdown
                            components-nav__link--section
                            js--nav-dropdown-toggle"
                            data-target="section-nav" href="#" >';
                    $output .= '<span class="dashicons dashicons-welcome-widgets-menus"></span>';
                    $output .= ucfirst( str_replace('_',' ', $this->section->name ) );
                $output .= '</a>';
                $output .= $this->dropdown_nav($this->sections, 'js--sections-dropdown', 'nav-dropdown--section', 'section-nav');


                $output .= '<a class="components-nav__link
                            components-nav__link--dropdown
                            components-nav__link--group
                            js--nav-dropdown-toggle"
                            data-target="group-nav"
                            href="#" >';
                    $output .= reset($this->section->groups)->display_name;
                $output .= '</a>';
                $output .= $this->dropdown_nav($this->section->groups, 'js--group-link', 'nav-dropdown--group', 'group-nav');

                // examine($this->section->groups);

            $output .= '</div>';
        $output .= '</div>';

        return $output;

    }

    /**
     * This dropdown appears at the beginning of the green nav bar, it allows
     * users to navigate between the different sections
     * @return [type] [description]
     */
    public function dropdown_nav($links = array(), $js = '', $class ='', $id =''){


        $output = '';


        $find = array('_');
        $replace = array(' ');

        // examine($links);
        $output .= '<ul id="'.$id.'" class="nav-dropdown '.$class.' '.$js.'">';

        foreach($links as $link):
            //set up the label
            if(is_object($link))
                $label =  $link->display_name;
            else {
                $label = str_replace($find,$replace ,$link);
                $label = ucwords($label);
            }

            // set up the section arg
            if(is_object($link))
                $arg = '#'.$link->name;
            else
                $arg = ($link != 'site_settings') ? '?page=bswp_settings&section='.$link : $link;

            // examine($link);
            $output .= '<li>';
                $output .= '<a href="'.$arg.'">';
                    $output .= $label;
                $output .= '</a>';
            $output .= '</li>';
        endforeach;

        $output .= '</ul>';

        return $output;
    }

}
