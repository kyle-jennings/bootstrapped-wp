<?php

class bswpFieldGenerators {

    // ------------------------------------------
    //  The field generators
    // ------------------------------------------

    public function text_field_generator($args=array(),$tab){
        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<label>'.$label.'</label>';
        $output .='<input type="text" name="bswp_'.$this->section.'['.$name.']"
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
    public function select_field_generator($args=array(),$tab){

        extract($args);

        $output = '';

        $classes = $class;
        $classes .= $toggle_fields ? ' js--toggle-field' : '';

        $data = $toggle_fields ? 'data-field-toggle="'.$name.'"' : '';
        $value = isset($value) ? $value : '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<select class="'.$classes.'" '.$data.' name="bswp_'.$this->section.'['.$name.']">';

        foreach ($args as $option):

            $name = strtolower(str_replace(' ','_',$option));
            $data_targets = '';
            if(isset($toggle_fields[$option])){

                $data_targets = is_string($toggle_fields[$option]) ? 'data-targets="'.$toggle_fields[$option].'"' : '' ;
            }

            $output .= '<option '.$data_targets.' value="'.$name.'" '.selected( $name, $value, false).'>';
                $output .= str_replace('_',' ',$option);
            $output .= '</option>';

        endforeach;
        $output .= '</select>';

        return $output;

    }


    /**
     * produces color field
     */
    public function color_field_generator($args=array(),$tab){
        extract($args);
        $value = isset($value) ? $value : '';

        $output = '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<input class="minicolors opacity" name="bswp_'.$this->section.'['.$name.']"
            value="'.$value.'"';

        if( isset($end_rgba) && is_string($args) && $args == 'transparency'):
            $output .= 'data-opacity ="'.$end_rgba.'"';
        endif;
        $output .= '/>';

        if( is_string($args) && $args == 'transparency'):
            $output .= '<input class="rgba-color" name="bswp_'.$this->section.'['.$name.'_rgba]" type="hidden"
                     value="'.$value.'" />';
        endif;

        $output .= '<a class="clearColor js--clear-color">Clear</a>';

        return $output;
    }


    /**
     * Produces the file field input
     */
    public function file_field_generator($args=array(),$tab){
        extract($args);
        $value = isset($value) ? $value : '';

        $output = '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<input class="media_input"  type="text"  name="bswp_'.$this->section.'['.$name.']"
                    value="'.$value.'" />';
        $output .= '<input class="button upload_image" type="button" value="Upload file" />';

        return $output;
    }


    public function textarea_field_generator($args=array(),$tab){
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
            $output .= '<textarea name="bswp_'.$this->section.'['.$name.']">'.$value.'</textarea>';
        }


        return $output;
    }


    public function label_field_generator($args=array(),$tab){
        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<h3>'.$label.'</h3>';

        return $output;

    }

    public function sidebar_field_generator($args=array(),$tab){

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

    public function sortable_field_generator($args=array(),$tab){

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
                    $name = $layout_order[$key]['component'];
                    $label = $layout_order[$key]['component'] ? ucwords(str_replace('_',' ',$layout_order[$key]['component'])) : ucwords(str_replace('_',' ',$value));
                    $output .= '<li class="menu-item-handle" data-component="'.$name.'" id="componentOrder_'.$key.'">';
                        $output .= $label;
                        $output .= '<div>';
                            $output .= '<input class="component" type="hidden" name="bswp_frontPage_layout_settings[bswp_frontPage_layout]['.$key.'][component]" value="'.($layout_order[$key]['component'] ? $layout_order[$key]['component'] : $value).'"/>';

                            $output .= '<select class="componentDeviceView" name="bswp_frontPage_layout_settings[bswp_frontPage_layout]['.$key.'][componentDeviceView]">';
                                foreach($device_views as $view){
                                    $output .= '<option value="'.$view.'" '.selected( $layout_order[$key]['componentDeviceView'], $view, false).'>';
                                       $output .= $view;
                                    $output .= '</option>';
                                }
                            $output .= '</select>';

                            $output .= '<input class="componentDisplay" type="hidden" name="bswp_frontPage_layout_settings[bswp_frontPage_layout]['.$key.'][display]" value="'.($layout_order[$key]['componentDisplay'] ? $layout_order[$key]['componentDisplay'] : '').'" />';

                        $output .= '</div>';
                    $output .= '</li>';
                }
                $output .= '</ul>';
            $output .= '</div>';

            $output .= '<div class="postbox frontPageLayoutList">';
                $output .= '<h3><span>Inactive Components</span></h3>';
                $output .= '<ul id="inactiveComponents" class="connectedSortable">';
                    foreach($inactiveComponents as $key => $value){
                        $name = $value;
                        $label = ucwords(str_replace('_',' ',$value));
                        $output .= '<li class="menu-item-handle" data-component="'.$name.'">';
                            $output .= $label;
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