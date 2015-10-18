<?php

function field_tab_generator($settings = array()){

    $tabs = $settings['tabs'];
    foreach($tabs as $tab){

        $label = $tab['label'];
        $fields = $tab['fields'];

        echo $label;
        echo '<br>';
        echo '========================';
        echo '<br>';


        identify_fields($fields);

    }

    die;

}

function identify_fields($fields = array()){

    /**
     *
     * Field Attibutes:
     * 'name' =>'field-name',
     * 'label' => 'Field Name',
     * 'type'=>'field-type',
     * 'args'=> '{string or array}',
     * 'toggle_field' => null,
     * 'preview'=>null
     */

    foreach($fields as $field){

        $type = $field['type'];
        call_user_func($type.'_field_generator', $field);
    }

}


function text_field_generator($args=array()){
    extract($args);
    ?>
    <div class="option">
        <label><?php echo $label; ?></label>
        <input type="text" name="kjd_background_settings[<?php echo $name;?>]"
        value="<?php echo $wallpaperSettings[$name] ? $wallpaperSettings[$name] : '' ;?>" >
    </div>
    <?php
}

function select_field_generator($args=array()){
    extract($args);
    ?>
    <div class="option">
        <label><?php echo $label; ?></label>

        <select name="kjd_background_settings][<?php echo $name; ?>]">
            <?php foreach ($args as $option): ?>
                <option <?php echo $toggle_field[$option] ? 'data-targets="'.$toggle_field[$option].'"' : '' ;?> value="none"
                    <?php selected( $option, "none", true) ?>
                >
                    <?php echo $option; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <?php

}
function color_field_generator($args=array()){
    extract($args);
    ?>
    <div class="color_option option">

        <label><?php echo $label; ?></label>
        <input class="minicolors opacity" name="kjd_background_settings][<?php echo $name; ?>]"
            value="<?php echo $colorSettings['endcolor'] ? $colorSettings['endcolor'] : 'none'; ?>"

            <?php if( is_string($args) && $args == 'transparency'): ?>
            data-opacity ="<?php echo $end_rgba; ?>"
            <?php endif ?>
        />

        <?php if( is_string($args) && $args == 'transparency'): ?>
        <input  class="rgba-color" name="kjd_background_settings[end_rgba]" type="hidden"
         value="<?php echo $colorSettings['end_rgba'] ? $colorSettings['end_rgba'] : 'none'; ?>" />
        <?php endif; ?>

        <a class="clearColor js--clear-color">Clear</a>
    </div> <!-- End color select-->
    <?php
}
function file_field_generator($args=array()){
    extract($args);
    ?>
    <div class="option">
        <label><?php echo $label; ?></label>
        <input class="media_input"  type="text"  name="kjd_background_settings[<?php echo $name; ?>]"
        value="<?php echo $wallpaperSettings[$name] ? $wallpaperSettings[$name] : ''; ?>" />
        <input class="button upload_image" type="button" value="Upload file" />
    </div>
    <?php
}


field_tab_generator($background_fields);