<?php


    $tabs = array(
        0 => 'background',
        1 => 'borders',
        2 => 'headings',
        3 => 'text',
        4 => 'presentation',
        5 => 'images',
        6 => 'misc'
    );

    if($section == "cycler"){
        array_pop($tabs);
        array_push($tabs, 'image_banner_settings', 'image_banner_images');
    }
    if($section =='bodyTag' || $section =='htmlTag' || $section =='cycler'){
        unset($tabs[2]);
        unset($tabs[3]);
        unset($tabs[4]);
    }
    if($section =='dropdown-menu'){
        unset($tabs[2]);

        unset($tabs[4]);
        unset($tabs[5]);
    }
    if($section =="navbar"){
        unset($tabs[2]);
        // unset($tabs[4]);
    }
    if($section =='login'){
        unset($tabs[1]);
    }
    if($section =="pageTitle"){
        unset($tabs[4]);
    }
    if($section == "mobileNav"){

        unset($tabs[2]);

        //  mobile nav settings
        $mobileNavSettings = get_option('kjd_mobileNav_misc_settings');
        $mobileNavSettings = $mobileNavSettings['kjd_mobileNav_misc'];
        $override_nav = $mobileNavSettings['override_nav'];
        if( $override_nav == 'true') {
            $mobilenav_style = $mobileNavSettings['mobilenav_style'];
        }

    }
    if( $section == 'sidr'){
        unset($tabs[2]);
        unset($tabs[5]);
        unset($tabs[6]);
    }


    if( isset( $_GET[ 'tab' ] ) ) {
     $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'background';
    }else{
     $active_tab = 'background';
    }

    $fields_wrapper_class = (
            $active_tab != 'image_banner_images' && $active_tab != 'image_banner_settings') ?
            'fields-wrapper ' : 'banner-fields-wrapper';


function nav_tabs($tabs, $active_tab, $section = 'theme'){

?>

    <div class="nav-wrapper">
        <div class="components-nav cf">

            <a class="components-nav__link components-nav__link--section js--sections-dropdown-toggle" href="#" >
                <span class="dashicons dashicons-welcome-widgets-menus"></span>
                <?php echo ucfirst( str_replace('_',' ', $section ) );?>
            </a>

            <?php
                foreach($tabs as $tab):
                    if($tab == 'misc')
                        $title = 'Settings';
                    else
                        $title = ucwords( str_replace('_',' ', $tab ) );
            ?>
            <a class="components-nav__link <?php echo $active_tab == $tab ? 'active' : ''; ?>"
                href="?page=kjd_<?php echo strtolower($section);?>_settings&tab=<?php echo $tab; ?>">
                <?php echo $title; ?>
            </a>
            <?php endforeach; ?>
        </div>
    </div>

    <?php
}

function sections_dropdown_nav(){
    $sections = array('theme','header','navbar','dropdown-menu','mobileNav',
    'cycler','pageTitle','body', 'posts','footer','login',
    'misc_background','page_layout');
    ?>
    <ul class="section-dropdown-nav js--sections-dropdown">
        <?php foreach($sections as $link): ?>
        <li>
            <a href="?page=kjd_<?php echo $link; ?>_settings">
                <?php echo ucwords(str_replace('_',' ',$link)); ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php
}