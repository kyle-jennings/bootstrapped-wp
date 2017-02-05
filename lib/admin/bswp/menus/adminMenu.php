<?php

namespace bswp\menus;

use bswp\pageSections;
use bswp\menus\nav;
use bswp\forms\form;

class adminMenu extends pageSections{

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
                'bswp_settings', // parent slug
                $label,
                $label,
                'manage_options',
                'bswp_settings&section='.$section, // page slug
                array($this, 'display_section')
            );
        }

    }

    public function display_section(){


        // get the current section, settings tab, and sub settings
        $bswp_nav = new nav;
        $form = new form;


        settings_errors();
        echo $bswp_nav->tabs_nav();
        echo $form->init();


    }
}
