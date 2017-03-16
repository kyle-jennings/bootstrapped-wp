<?php


namespace bswp\Menus;

class Nav {

    public $page;
    public $section;

    public $tab;
    public $settings;
    public $sections = array(
        'site_settings' => array(
            'label' => 'Site Settings',
            'name' => 'site_settings'
        )
    );
    public $groups;
    public $groups_tabs;


    public function __construct(){

        $this->page = isset($_GET['page']) ? $_GET['page'] : null;
        $this->section = isset($GLOBALS['bswp\Settings\Section']) ? $GLOBALS['bswp\Settings\Section'] : null;
        $this->tab = isset($_GET['tab']) ? $_GET['tab'] : null;

        $options = get_option('bswp_site_settings');
        $sections = !empty( $options['available_sections']) ?  $options['available_sections'] : array();
        $sections = array_merge($this->sections,$sections);

        $this->set_sections($sections);
        $this->set_groups($this->section->groups);
        $this->set_tabs($this->section->groups);


        // the current group
        $current_group_name_attr = 'bswp_'.$this->section_name.'[form_meta_settings][group_tab]';
        $this->current_group_value = $current_group_value = $this->get_form_settings('group_tab');
        // examine($this->section);
        // the current tab
        $current_tab_name_attr = 'bswp_'.$this->section_name.'[form_meta_settings][field_tab]';
        $this->current_tab_value = $current_tab_value = $this->get_form_settings('field_tab');
    }


    // collect the sections
    public function set_sections($sections) {
        foreach($sections as $section=>$toggled){
            if($toggled !== 'yes')
                continue;

            $name = str_replace('activate_','', $section.'_settings');

            $label = str_replace('_',' ',$replace ,$name);
            $label = ucwords($label);

            $this->sections[$name] = array(
                'label' => $label,
                'name' => $name
            );

        }
    }


    // collect groups
    public function set_groups($groups) {

        // collect the groups
        $this->groups = array_map(function($v){
            return array(
                'label'=> $v->display_name,
                'name'=>$v->name
            );
        }, $groups);
    }


    // collect tabs
    public function set_tabs($groups) {
        $groups_arr = array();
        // we hate nest forloops, but sometimes it makes more sense then to have
        // useless function
        foreach($groups as $group){
            // get the tabs for the group
            $groups_arr[$group->name];
            $tabs = $group->tabs;

            // for each of the tabs, get the tab name
            foreach($tabs as $name => $tab){
                $groups_arr[$group->name][$name] = array(
                    'label'=> ucfirst(str_replace('_',' ',$name)),
                    'name'=> 'fields_'.$group->name.'_'.$name
                );

            }
        }

        $this->groups_tabs = $groups_arr;
    }



    // need to get the form settings for some specifc info
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
    public function create_nav($active = null ){

        if(empty($this->section))
            return;

        $section_name = ucfirst( str_replace('_',' ', $this->section->name ) );
        $group_name = $this->group_saved_label(reset($this->section->groups)->display_name );

        $active_group = $this->current_group_value ? $this->current_group_value : null;

        $output = '';

        $output .= '<div class="overlay js--overlay"></div>';
        $output .= '<div id="settings-nav" class="nav-wrapper">';
            $output .= '<div class="components-nav cf">';

                $output .= $this->subnav_label($section_name, 'section-nav', 'welcome-widgets-menus', 'section-nav');
                $output .= $this->subnav_links($this->sections, 'section-nav', null, 'page-change', 'section-nav');

                $output .= $this->subnav_label($group_name, 'group-nav', null, 'group-nav');
                $output .= $this->subnav_links($this->groups, 'group-nav', '#groups-tabs', null, 'group-nav', $active_group);


                // examine($this->groups_tabs);
                $count = 0;
                foreach($this->groups_tabs as $group_name => $tabs){
                    $output .= $this->groups_tabs_nav($count, $group_name, $tabs);
                }

            $output .= '</div>';
        $output .= '</div>';

        return $output;

    }


    // the group's tabs are numeraous and unwiedly, so i gave them their own function
    public function groups_tabs_nav(&$count = 0, $group_name, $tabs) {

        $tab_name = $this->get_active_field_tab_label(key($tabs), $group_name );
        $class = 'tabs-nav';

        $hide = $this->unhide_first_or_saved_fields_nav($count, $group_name);
        $active = $this->current_tab_value ? $this->current_tab_value : null;



        $output = '';
        $output .= '<div id="'.$group_name.'-tabs-nav-wrapper'.'" class="components-nav__link-wrapper '.$hide.'">';
            $output .= $this->subnav_label($tab_name, $group_name.'-tabs-nav', null, $class);
            // the subnavs
            $output .= $this->subnav_links(
                $tabs,
                $group_name.'-tabs-nav',
                '#groups-tabs > #'.$group_name .' > .tab-content',
                null,
                'tab-nav',
                $active
            );
        $output .= '</div>';

        return $output;
    }


    // get the saved field tab
    public function get_active_field_tab_label($default, $group_name){

        if(!$this->current_tab_value || !$this->current_group_value || $group_name !== $this->current_group_value)
            return $default;

        $saved_tab = ltrim($this->current_tab_value,'#');
        $saved_group = ltrim($this->current_group_value, '#');
        $find = array('fields_', $saved_group.'_', '_');
        $replace = array('','',' ');

        $label = str_replace($find, $replace, $saved_tab);

        $label = ucwords( $label );
        return $label;
    }



    // unhides the correct fields subnav
    public function unhide_first_or_saved_fields_nav(&$count = 0, $group_name) {

        $hide = 'hide';

        // unhide the correct nav
        if($this->current_tab_value && $this->current_group_value){


            // examine( $this->current_group_value .','. $this->current_tab_value);

            $saved_group = ltrim($this->current_group_value,'#');
            $saved_tab = ltrim($this->current_tab_value,'#');

            // unhide the nav
            if( strtolower($saved_group) == strtolower($group_name)){
                $hide = '';
            }else
                $hide = 'hide';
        }else
            $hide = ($count > 0) ? 'hide' : '';


        $count++;
        return $hide;
    }


    // gets and cleans up the group name label
    public function group_saved_label($default){


        $saved_tab = ltrim($this->current_tab_value,'#');
        $saved_group = ltrim($this->current_group_value,'#');
        $saved = $default;

        if(!$this->current_group_value)
            return $default;

        $saved = $this->current_group_value;
        $saved = str_replace('#','', $saved_group);



        return ucwords($saved);

    }


    /**
     * [subnav_label description]
     * @param  string $label  [description]
     * @param  string $target [description]
     * @param  [type] $icon   [description]
     * @return [type]         [description]
     */
    public function subnav_label($label = '', $target = '', $icon = null, $class = '') {
        if(is_null($label) || $label == '')
            return;

        $output = '';
        $data_target = $target ?'data-target="'.$target.'"' : '';


        $label = ucfirst(str_replace('_',' ', $label));
        $output .= '<a class="components-nav__link components-nav__dropdown js--nav-dropdown-toggle '.$class.'"
                    data-target="'.$target.'" href="#" >';
            if($icon)
                $output .= '<span class="dashicons dashicons-'.$icon.'"></span>';

            $output .= $label;
        $output .= '</a>';

        return $output;
    }


    /**
     * This dropdown appears at the beginning of the green nav bar, it allows
     * users to navigate between the different sections
     * @param  array $links  array of links
     * @param  string $js  js--hookname
     * @param  string $class  classname
     * @param  string $id  id
     * @param  string $type section/group/tab
     */
    public function subnav_links($links = array(), $id = '', $target = null, $type = 'tab-switch', $class = null, $active_name = null){

        // examine($links);

        $output = '';


        $data_target = $target ? 'data-target="'.$target.'"' : null;
        $output .= '<ul id="'.$id.'" class="nav-dropdown '.$class.'">';

        foreach($links as $k=>$v):
            $name = $v['name'] ? $v['name'] : $k;
            $label = $v['label'] ? $v['label'] : ucfirst(str_replace('_',' ',$name));
            $url = $this->get_link_url($type, $name);


            // do the saved_value and the current name match? then its active
            $active = ( strpos( $active_name, $name) !== false) ? 'active' : '';

            $output .= '<li>';
                $output .= '<a class="'.$class.' '.$active.'" data-type="'.$class.'" href="'.$url.'" '.$data_target.'>';
                    $output .= $label;
                $output .= '</a>';
            $output .= '</li>';
        endforeach;

        $output .= '</ul>';

        return $output;
    }




    // only the section nav will changes pages, groups and field navs just change tabs
    public function get_link_url($type, $name) {
        $url = '';
        switch($type):
            case 'page-change':
                $url = ($name != 'site_settings') ? '?page=bswp_settings&section='.$name : '?page=bswp_settings';
                break;
            default:
                $url = '#'.$name;
                break;
        endswitch;

        return $url;
    }




    // just compares the currently selected group to what is saved in the form
    // returns true or false
    public function is_saved_group( $saved_group_name, $current_group_name) {

        if($saved_group_name == $current_group_name || strpos($saved_group_name, $current_group_name) != false ){
            return true;
        }

        return false;

    }


    // just compares the currently selected tab to what is saved in the form
    // returns true or false
    public function is_saved_tab($saved_tab_name, $current_tab_name) {

        if($saved_tab_name == $current_tab_name || strpos($saved_tab_name, $current_tab_name) != false ){
            return true;
        }

        return false;
    }

}
