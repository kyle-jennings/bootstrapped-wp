<?php

class bswpNav {

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
        'presentation',
        'images',
        'misc'
    );

    public function tabs_nav($active_tab = null, $section = 'theme'){
        $tabs = $this->tabs;
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
                    href="#<?php echo $tab; ?>">
                    <?php echo $title; ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }

    public function sections_dropdown_nav(){
        $sections = $this->sections;

        $find = array('_settings','_');
        $replace = array('',' ');
    ?>
        <div class="overlay js--overlay js--sections-dropdown-toggle js--sections-dropdown"></div>
        <ul class="section-dropdown-nav js--sections-dropdown">
            <?php
                foreach($sections as $section):
                    $name = str_replace($find,$replace,$section);
                    $label = ucwords($name);
            ?>
            <li>
                <a href="?page=bswp_settings&section=<?php echo $name; ?>">
                    <?php echo $label;  ?>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }
}