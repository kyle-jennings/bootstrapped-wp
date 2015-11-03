<?php

class bswpForm{

    public $forms_root = '';
    public $section;
    public function __construct(){
        $this->section = isset($_GET['section']) ? $_GET['section'] : 'theme_settings';
        $this->preview = in_array($this->section, ['sidebar_settings','frontpage_settings'] ) ? false : true ;
    }

    // if there is something like a submit button or a wp_Editor, we grab the output and return it
    public function grab_function_output($func){
        ob_start();
            call_user_func('submit_button');
            $ob_content = ob_get_contents();

        ob_end_clean();

        return $ob_content;
    }


    /**
     * [init description]
     * @param  [array] $settings [nested array with all the section fields]
     * @return [string]           [the markup, dawg]
     */
    public function init($settings){

        if(!$settings)
            return;

        wp_enqueue_media();
        $classes = !$this->preview ? 'fields-wrapper--no-preview' : '';
        $output = '';

        $output .= '<form class="bswp-form" method="post" action="options.php">';
            $output .= '<div class="fields-wrapper '.$classes.'">';

                $output .= '<div class="tab-content">';
                    $output .= $this->settings_tabs($settings);
                $output .= '</div>';

                $output .= $this->grab_function_output('submit_button');

            $output .= '</div>';
        $output .= '</form>';

        if($this->preview){
            $output .= '<div class="preview-options">';
                $output .= kjd_site_preview();
            $output .= '</div>';
        }

        return $output;
    }

    /**
     * Each set of settings (backgrounds, borders, text ect) get their own tab-pane
     * becase we are keeping each section's settings on the same page
     * @return [type] [description]
     */
    public function settings_tabs($settings_group){


        $output = '';
        $i = 0;
        foreach($settings_group as $k=>$settings){
            $active = '';

            $id = $settings['section'];
            if(isset($_GET['tab']) )
                $active = $_GET['tab'] == $id ? 'active': '';
            else
                $active = ($i == 0) ? 'active' : '';


            $output .= '<div id="'.$id.'" class="tab-pane '.$active.'">';
                $output .= $this->field_tabs($settings);
            $output .= '</div>';
            $i++;
        }

        return $output;
    }







    /**
     * This will create the settings fields and the settings dropdown.
     * IE - in the background settings, there are background colors and also
     * background wallpaper. Each of those are in their own tab pans, which are
     * activated with a dropdown menu button
     *
     * @param  array  $settings [description]
     * @return [type]           [description]
     */
    public function field_tabs($settings = array()){

        $tabs = $settings['tabs'];

        if( empty($tabs) )
            return;


        // if there are more than one tab, set this flag
        $multi_tabs = (count($tabs) > 1) ? true : false;

        $output ='';

        // if there is more than one tab we create a dropdown to navigate them
        if( $multi_tabs )
            $output .= $this->fields_tab_dropdown($tabs);

        // get the tab pain
        $output .= $this->fields_tab_pane($multi_tabs, $tabs);

        return $output;
    }

    /**
     * Here is the tab pane which displays the fields as mentioned above
     * @param  [type] $multi_tabs [description]
     * @param  [type] $tabs       [description]
     * @return [type]             [description]
     */
    public function fields_tab_pane($multi_tabs, $tabs){

        $output = '';

        // the tab content
        if( $multi_tabs )
            $output .= '<div class="tab-content tab-content--fields js--fields-tabs-wrapper">';

        // generate the fields
        $i=0;
        foreach($tabs as $tab){
            $output .= $this->create_tab_content($tab,$i);
            $i++;
        }

        // close tab content
        if( $multi_tabs )
            $output .= '</div>';

        return $output;
    }


    // the tab dropdown
    public function fields_tab_dropdown($tabs){

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
                    $output .= $this->fields_tab_dropdown_link($tab);

            $output .= '</ul>';
        $output .= '</div>';

        return $output;
    }

    // The tab links in the dropdown
    public function fields_tab_dropdown_link($tab){


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
    public function create_tab_content($tab, $i=0){


        $name = str_replace(' ','_',strtolower($tab['label']));
        $label = $tab['label'];
        $fields = $tab['fields'];
        $class = $i == 0 ? 'active' : '';
        $output .= '<div class="js--fields-group tab-pane cf '.$class.'" id="'.$name.'">';
            // $output .= '<h2>'.$label.'</h2>';
            $output .= $this->identify_fields($fields);
        $output .= '</div>';

        return $output;
    }




    /**
     * field toggling
     */

    private function get_toggled_by($toggled_bys){

        $output = 'hide js--toggled-field ';

        foreach ($toggled_bys as $field=>$value)
            $output .= $field.' ';


        return $output;
    }

    private function toggle_fields_markup($toggled_by, $name){
        $data_toggled_by = $toggled_by ? $this->get_toggled_by($toggled_by) : '' ;
        $data_toggle_name = $toggled_by ? 'data-toggle-name="'.$name.'"' : '';

        return ['data_toggled_by'=>$data_toggled_by, 'data_toggle_name'=>$data_toggle_name];
    }


    /**
     * Identifies which field to use based on the 'type' key
     */
    public function identify_fields($fields = array()){

        $output = '';

        foreach($fields as $field){

            $type = $field['type'];

            $toggles = $this->toggle_fields_markup($field['toggled_by'], $field['name']);
            extract($toggles);

            $output .= '<div class="option '.$data_toggled_by.'" '.$data_toggle_name.' >';
                $output .= call_user_func( array($this, $type.'_field_generator'), $field);
            $output .= '</div>';
        }

        return $output;
    }


    // ------------------------------------------
    //  The field generators
    // ------------------------------------------

    public function text_field_generator( $args=array() ){
        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<label>'.$label.'</label>';
        $output .='<input type="text" name="kjd_background_settings['.$name.']"
        value="'.$value.'" >';

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

        $output = '';

        $classes = $class;
        $classes .= $toggle_fields ? ' js--toggle-field' : '';

        $data = $toggle_fields ? 'data-field-toggle="'.$name.'"' : '';
        $value = isset($value) ? $value : '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<select class="'.$classes.'" '.$data.' name="kjd_background_settings['.$name.']">';

        foreach ($args as $option):

            $name = strtolower(str_replace(' ','_',$option));
            $data_targets = $toggle_fields[$option] ? 'data-targets="'.$toggle_fields[$option].'"' : '';
            $output .= '<option '.$data_targets.' value="'.$name.'" '.selected( $option, "none", false).'>';
                $output .= str_replace('_',' ',$option);
            $output .= '</option>';

        endforeach;
        $output .= '</select>';

        return $output;

    }

    public function color_field_generator($args=array()){
        extract($args);
        $value = isset($value) ? $value : '';

        $output = '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<input class="minicolors opacity" name="kjd_background_settings['.$name.']"
            value="'.$value.'"';

        if( is_string($args) && $args == 'transparency'):
            $output .= 'data-opacity ="'.$end_rgba.'"';
        endif;
        $output .= '/>';

        if( is_string($args) && $args == 'transparency'):
            $output .= '<input class="rgba-color" name="kjd_background_settings[end_rgba]" type="hidden"
                     value="'.$value.'" />';
        endif;

        $output .= '<a class="clearColor js--clear-color">Clear</a>';

        return $output;
    }

    public function file_field_generator($args=array()){
        extract($args);
        $value = isset($value) ? $value : '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<input class="media_input"  type="text"  name="kjd_background_settings['.$name.']"
                    value="'.$value.'" />';
        $output .= '<input class="button upload_image" type="button" value="Upload file" />';

        return $output;
    }


    public function textarea_field_generator($args=array()){
        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<label>'.$label.'</label>';

        if($args == 'wp_editor'){
            ob_start();
                wp_editor( $value, $name, array( 'textarea_rows' =>1 ));
                $ob_content = ob_get_contents();
            ob_end_clean();
            $output .= $ob_content;
        }
        else{
            $output .= '<textarea name="kjd_background_settings['.$name.']">'.$value.'</textarea>';
        }


        return $output;
    }


    public function label_field_generator($args=array()){
        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<h3>'.$label.'</h3>';

        return $output;

    }

    public function sidebar_field_generator($args = array()){

        $output = '';
        $device_views = array('all','visible-phone','visible-tablet','visible-desktop','hidden-phone','hidden-tablet','hidden-desktop');
        $output .= $this->select_field_generator($args);

        extract($args);

        $visibility = select_field(array(
                    'name'=>$name.'_visibily',
                    'label'=>'Device visibily',
                    'args'=>$device_views,
                ));

        $toggled_by = array($name=>'top,right,bottom,left');
        $toggles = $this->toggle_fields_markup($toggled_by, $name.'_visibility');
        extract($toggles);

        $output .= '<div class="option '.$data_toggled_by.'" '.$data_toggle_name.' >';

            $output .= $this->select_field_generator($visibility);

            $output .= '<div class="layout_preview">';
                $output .= '<img src="'.get_bloginfo("template_directory").'/images/widgetsright.png" class="right">';
                $output .= '<img src="'.get_bloginfo("template_directory").'/images/widgetstop.png" class="top">';
                $output .= '<img src="'.get_bloginfo("template_directory").'/images/widgetsbottom.png" class="bottom">';
                $output .= '<img src="'.get_bloginfo("template_directory").'/images/widgetsleft.png" class="left">';
                $output .= '<img src="'.get_bloginfo("template_directory").'/images/widgetsnone.png" class="none">';
                // $output .= '<img src="'.get_bloginfo("template_directory").'/images/widgets'.$settings[$layout]['position'].'.png" class="'.$settings[$layout]['position'].'" style="display:block;">';
            $output .= '</div>';


        $output .= '</div>';

        return $output;
    }

    public function sortable_field_generator($args = array()){

        extract($args);
        $output = '';
        $layout_order = array();
        $components = array('widget_area_1','widget_area_2','widget_area_3','content','secondary_content');
        $device_views = array('all','visible-phone','visible-tablet','visible-desktop','hidden-phone','hidden-tablet','hidden-desktop');

        $active_components = array();
        if(!empty($layout_order)){
            foreach($layout_order as $order_num)
                array_push($active_components, $order_num['component']);
        }


        $inactiveComponents = array_diff($components, $active_components);

        $output .= '<div id="frontpage-sortables" class="option">';
            $output .= '<div class="postbox frontPageLayoutList">';
                $output .= '<h3><span>Active Page Components</span></h3>';
                $output .= '<ul id="activeComponents" class="connectedSortable">';
                foreach($active_components as $key => $value){
                    $output .= '<li class="menu-item-handle" id="componentOrder_'.$key.'">';
                    $output .= $layout_order[$key]['component'] ? ucwords(str_replace('_',' ',$layout_order[$key]['component'])) : ucwords(str_replace('_',' ',$value));
                    $output .= '<div>';
                    $output .= '<input class="component" type="hidden" name="kjd_frontPage_layout_settings[kjd_frontPage_layout]['.$key.'][component]" value="'.($layout_order[$key]['component'] ? $layout_order[$key]['component'] : $value).'"/>';
                    $output .= '<select class="componentDeviceView" name="kjd_frontPage_layout_settings[kjd_frontPage_layout]['.$key.'][componentDeviceView]">';
                    foreach($device_views as $view){
                        $output .= '<option value="'.$view.'" '.selected( $layout_order[$key]['componentDeviceView'], $view, false).'>';
                        $output .= $view;
                        $output .= '</option>';
                    }
                    $output .= '</select>';
                    $output .= '<input class="componentDisplay" type="hidden" name="kjd_frontPage_layout_settings[kjd_frontPage_layout]['.$key.'][display]" value="'.($layout_order[$key]['componentDisplay'] ? $layout_order[$key]['componentDisplay'] : '').'" />';
                    $output .= '</div>';
                    $output .= '</li>';
                }
                $output .= '</ul>';
            $output .= '</div>';

            $output .= '<div class="postbox frontPageLayoutList">';
                $output .= '<h3><span>Inactive Components</span></h3>';
                $output .= '<ul id="inactiveComponents" class="connectedSortable">';
                    foreach($inactiveComponents as $key => $value){
                        $output .= '<li class="menu-item-handle">';
                            $output .= ucwords(str_replace('_',' ',$value));
                            $output .= '<div>';
                                $output .= '<input class="component" type="hidden" value="'.$value.'" name=""/>';
                                $output .= '<input class="componentDisplay" type="hidden" name="" value=""/>';
                                $output .= '<select class="componentDeviceView" name="">';
                                    foreach($device_views as $view){
                                        $output .= '<option value="" >';
                                        $output .= $view;
                                        $output .= '</option>';
                                    }
                                $output .= '</select>';
                            $output .= '</div>';
                        $output .= '</li>';
                    }
                $output .= '</ul>';
            $output .= '</div>';
        $output .= '</div>';


        return $output;
    }

}