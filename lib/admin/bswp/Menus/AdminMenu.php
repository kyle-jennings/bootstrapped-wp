<?php

namespace bswp\Menus;

use bswp\Menus\Nav;
use bswp\Forms\Form;

class AdminMenu {

    public $view;
    public $forms_root = '';
    public $sections = array();


    public function __construct(){


        $options = get_option('bswp_site_settings');
        $sections = !empty( $options['available_sections']) ?  $options['available_sections'] : array();
        $sections = array_merge($this->sections,$sections);


        foreach($sections as $section=>$toggled){

            if($toggled == 'yes')
            $this->sections[] = str_replace('activate_','', $section.'_settings');
        }



        $theme_root = get_template_directory();
        $this->forms_root = $theme_root.'/lib/admin/functions/new-forms';

    }

    public function add_top_menu(){


        // add_menu_page(
        //     'My Page Title',
        //     'My Menu Title',
        //     'manage_options',
        //     'my-menu',
        //     'my_menu_output'
        // );
        // add_submenu_page(
        //     'my-menu',
        //     'Submenu Page Title',
        //     'Whatever You Want',
        //     'manage_options',
        //     'my-menu'
        // );


        add_menu_page(
            'BSWP', // page title
            'BSWP', // menu title
            'manage_options', // caps
            'bswp_settings', // slug
            array($this, 'display_section'), // function
            'dashicons-admin-customizer' // icon
        );

        add_submenu_page(
            'bswp_settings', // parent slug
            'Site Settings', // page title`
            'Site Settings', // menu title
            'manage_options', // caps
            'bswp_settings', // page slug
            null // function
        );

        foreach ($this->sections as $section){
            $find = array('_');
            $replace = array(' ');
            $label = str_replace($find,$replace,$section);
            $label = ucwords($label);

            add_submenu_page(
                'bswp_settings', // parent slug
                $label, // page title
                $label, // menu title
                'manage_options', // caps
                'bswp_settings&section='.$section, // page slug
                array($this, 'display_section') // function
            );
        }

    }





    public function display_section(){

        // get the current section, settings tab, and sub settings
        $nav = new Nav;
        $form = new Form;

        settings_errors();
        echo $nav->create_nav();

        $form->the_form();


    }
}
