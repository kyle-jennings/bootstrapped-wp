<?php

class bswpNav {

    public $sections = array('theme','header','navbar','dropdown-menu','mobileNav',
        'cycler','pageTitle','body', 'posts','footer','login',
        'misc_background','page_layout');

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
                    href="?page=kjd_<?php echo $section;?>_settings&tab=<?php echo $tab; ?>">
                    <?php echo $title; ?>
                </a>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }

    public function sections_dropdown_nav(){
        $sections = $this->sections;
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
}