<?php


class bswpAdminMenu extends bswpSections{

    public $view;
    public $forms_root = '';
    public function __construct(){
        $theme_root = get_template_directory();
        $this->forms_root = $theme_root.'/lib/admin/functions/new-forms';

    }

    public function add_top_menu(){

        $sections = $this->sections;

        add_menu_page(
            'BSWP new home',
            'BSWP new home',
            'manage_options',
            'bswp_settings',
            array($this, 'display_section'),
            'dashicons-admin-customizer'
        );

        foreach ($sections as $section){
            $find = array('_settings','_');
            $replace = array('',' ');
            $label = str_replace($find,$replace,$section);
            $label = ucwords($label);

            add_submenu_page(
                'bswp_settings',
                $label,
                $label,
                'manage_options',
                'bswp_settings&section='.$section,
                array($this, 'display_section')
            );
        }

    }

    public function display_section(){
        $current_view = 'form';
        include($this->forms_root.'/'.$current_view.'.php');
    }
}


add_action('admin_menu', array(new bswpAdminMenu, 'add_top_menu') );