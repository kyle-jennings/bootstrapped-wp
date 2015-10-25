<?php

class bswpFieldGenerators{

    public $forms_root = '';
    public $fields;
    public function __construct(){

        $this->fields = new fieldsClass;
    }

    public function field_tab_generator($settings = array()){

        $tabs = $settings['tabs'];

        if( empty($tabs) )
            return;

        // if there are more than one tab, set this flag
        $multi_tabs = (count($tabs) > 1) ? true : false;

        $output ='';

        // if there is more than one tab
        if( $multi_tabs )
            $output .= create_tab_dropdown($tabs);

        $output .= create_tab_pane($multi_tabs, $tabs);

        return $output;
    }


    public function create_tab_pane($multi_tabs, $tabs){

        $output = '';

        // the tab content
        if( $multi_tabs )
            $output .= '<div class="tab-content">';

        // generate the fields
        foreach($tabs as $tab)
            $output .= $this->create_tab_content($tab);

        // close tab content
        if( $multi_tabs )
            $output .= '</div>';

        return $output;
    }


    // the tab dropdown
    public function create_tab_dropdown($tabs){

        $output = '';

        $first_tab = reset($tabs);
        $first_label = $first_tab['label'];

        $output .= '<div class="btn-group tab-switcher">';
            $output .= '<a class="btn btn-primary dropdown-toggle tab-switcher__dropdown" data-toggle="dropdown" href="#">';
                $output .= '<span class="btn-face">'.$first_label.'</span>';
                $output .= '<span class="caret"></span>';
            $output .= '</a>';
            $output .= '<ul class="dropdown-menu">';

                foreach($tabs as $tab)
                    $output .= $this->create_tab_link($tab);

            $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }


    public function create_tab_link($tab){


        $label = $tab['label'];
        $name = str_replace(' ','_',strtolower($tab['label']));

        $output = '';
            $output .= '<li>';
                $output .= '<a href="#'.$name.'" data-toggle="tab">'.$label.'</a>';
            $output .= '</li>';

        return $output;
    }

    /**
     * Generates the markup for the tab contents
     */
    public function create_tab_content($tab){

        $name = str_replace(' ','_',strtolower($tab['label']));
        $fields = $tab['fields'];

        $output .= '<div class="tab-pane cf" id="'.$name.'">';
            $output .= $this->identify_fields($fields);
        $output .= '</div>';

        return $output;
    }

    /**
     * Identifies which field to use based on the 'type' key
     */
    public function identify_fields($fields = array()){

        $output = '';

        foreach($fields as $field){

            $type = $field['type'];

            ob_start();
                call_user_func( array($this, $type.'_field_generator'), $field);
                $ob_content = ob_get_contents();
            ob_end_clean();

            $output .= $ob_content;
        }

        return $output;
    }


    // Here are the actual fields


    public function text_field_generator( $args=array() ){
        extract($args);

        $data_field_toggle = $field_toggle ? $this->get_field_toggle($field_toggle) : '' ;
        $data_toggle_name = $field_toggle ? 'data-toggle-name="'.$name.'"' : '';
        $output = '';

        ?>
        <div class="option <?php echo $data_field_toggle; ?>" <?php echo $data_toggle_name; ?> >
            <label><?php echo $label; ?></label>
            <input type="text" name="kjd_background_settings[<?php echo $name;?>]"
            value="<?php echo $wallpaperSettings[$name] ? $wallpaperSettings[$name] : '' ;?>" >
        </div>
        <?php
    }

    private function get_field_toggle($field_toggles){

        $output = 'hide js-toggled-field ';

        foreach ($field_toggles as $field=>$value)
            $output .= $field.' ';


        return $output;
    }

    /**
     * Select field
     * 'args' field is in array - used to populate the options
     * if an 'args' a non-associative array then each value is used for both the value and label
     * otherwise the key is the value and the value is the label. huh?
     * @return [type]       [description]
     */
    public function select_field_generator($args=array()){
        extract($args);

        $classes = '';
        $classes .= $toggle_field ? ' js--toggle-field' : '';
        $data = $toggle_field ? 'data-field-toggle="'.$name.'"' : '';
        ?>
        <div class="option">
            <label><?php echo $label; ?></label>

            <select class="<?php echo $classes ;?>" <?php echo $data;?> name="kjd_background_settings[<?php echo $name; ?>]">
                <?php
                    foreach ($args as $option):
                        $name = strtolower(str_replace(' ','_',$option));
                        $data_targets = $toggle_field[$option] ? 'data-targets="'.$toggle_field[$option].'"' : '';
                ?>
                    <option <?php echo $data_targets; ;?> value="<?php echo $name;?>"
                        <?php selected( $option, "none", true) ?>
                    >
                        <?php echo $option; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <?php

    }

    public function color_field_generator($args=array()){
        extract($args);
        ?>
        <div class="color-field option">

            <label><?php echo $label; ?></label>
            <input class="minicolors opacity" name="kjd_background_settings[<?php echo $name; ?>]"
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

    public function file_field_generator($args=array()){
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


}