<?php

class bswpAdminMenu{

    public $forms_root = '';
    public function __construct(){
        $theme_root = get_template_directory();
        $this->forms_root = $theme_root.'/lib/admin/functions/new-forms';

    }

    public function add_top_menu(){
        add_menu_page(
            'BSWP new home',
            'BSWP new home',
            'manage_options',
            'bswp_new_home',
            array($this,'home'),
            'dashicons-admin-customizer'
        );

    }

    public function home(){

        include($this->forms_root.'/home.php');
    }
}


add_action('admin_menu', array(new bswpAdminMenu, 'add_top_menu') );