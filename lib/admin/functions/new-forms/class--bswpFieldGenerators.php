<?php

class bswpFieldGenerators {

    // ------------------------------------------
    //  The field generators
    // ------------------------------------------


    /**
     * This is used for saved values which do not need fields
     * @return [type] [description]
     */
    public function no_field_generator(){}


    /**
     * The base field, used for misc values
     * @param  array  $args [description]
     * @param  [type] $tab  [description]
     * @return [type]       [description]
     */
    public function text_field_generator($args=array(), $tab = null){
        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<label>';
            $output .= $label;
        $output .= '</label>';

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
    public function select_field_generator($args=array(), $tab = null){


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
    public function color_field_generator($args=array(), $tab = null){
        extract($args);
        $value = isset($value) ? $value : '';

        $output = '';

        $output .= '<label>'.$label.'</label>';

        $alpha = '1';
        if( is_string($args) && $args == 'transparency'):
            $rgba = $this->find_value($name.'_rgba');
            $alpha = $this->get_alpha($rgba);
        endif;

        // the visible output
        $output .= '<input class="minicolors opacity" data-opacity="'.$alpha.'" name="bswp_'.$this->section.'['.$name.']"
            value="'.$value.'"';
        $output .= '/>';

        if( is_string($args) && $args == 'transparency'){
            $output .= '<input class="rgba-color" name="bswp_'.$this->section.'['.$name.'_rgba]"
            type="hidden" value="'.$rgba.'" />';
        }

        $output .= '<a class="clearColor js--clear-color">Clear</a>';

        return $output;
    }


    /**
     * Produces the file field input
     */
    public function file_field_generator($args=array(), $tab = null){
        extract($args);
        $value = isset($value) ? $value : '';

        $output = '';

        $output .= '<label>'.$label.'</label>';
        $output .= '<input class="media_input"  type="text"  name="bswp_'.$this->section.'['.$name.']"
                    value="'.$value.'" />';
        $output .= '<input class="button upload_image" type="button" value="Upload file" />';

        return $output;
    }


    public function textarea_field_generator($args=array(), $tab = null){
        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<label class="js--extend-field">';
            $output .= $label.'<span class="dashicons dashicons-external"></span>';
        $output .= '</label>';

        if($args == 'wp_editor'){
            ob_start();
                wp_editor( $value, $name, array( 'textarea_rows' => 5 ));
                $ob_content = ob_get_contents();
            ob_end_clean();
            $output .= $ob_content;
        }
        else{
            $output .= '<textarea name="bswp_'.$this->section.'['.$name.']" rows="5">'.$value.'</textarea>';
        }


        return $output;
    }


    /**
     * Creates a BIG section label
     */
    public function label_field_generator($args=array(), $tab = null){
        extract($args);
        $value = isset($value) ? $value : '';
        $output = '';

        $output .= '<h3>'.$label.'</h3>';

        return $output;

    }


    /**
     * field generator for layout sidebar location
     */
    public function sidebar_field_generator($args=array(), $tab = null){

        $output = '';

        // create the first select
        $output .= $this->select_field_generator($args);

        // the extract the args to reuse

        extract($args);
        // output the diagram and device visibility
        $positions = array('none','top','right','bottom','left');

        // get the sidebar value
        $target = key($toggled_by);


        $output .= '<div class="layout_preview">';
            foreach($positions as $position){
                $display = ($this->find_value($target) == $position) ? 'display:block' : 'display:none';
                $output .= '<img class="'.$position.'" style="'.$display.'" src="'.get_bloginfo("template_directory").'/images/widgets'.$position.'.png" >';
            }
        $output .= '</div>';

        // end diagram/visibility output

        return $output;
    }


    /**
     * Sortable fields, used for front page
     */
    public function sortable_field_generator($args=array(), $tab = null){

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

        $output .= '<div id="frontpage-sortables">';

            // the active components
            $output .= '<div class="postbox frontPageLayoutList">';

                // The label and expand button
                $output .= '<label class="js--extend-field">';
                    $output .= '<h3>Active Components';
                        $output .= '<span class="dashicons dashicons-external"></span>';
                    $output .= '</h3>';
                $output .= '</label>';

                // the sortables
                $output .= '<ul id="activeComponents" class="sortables-wrapper connectedSortable">';
                foreach($active_components as $key => $value){
                    $name = $layout_order[$key]['component'];
                    $label = $layout_order[$key]['component'] ? ucwords(str_replace('_',' ',$layout_order[$key]['component'])) : ucwords(str_replace('_',' ',$value));
                    $output .= '<li class="sortable menu-item-handle" data-component="'.$name.'" id="componentOrder_'.$key.'">';
                        $output .= '<h5 class="sortable__title">'.$label.'</h5>';
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
                // end sortables
            $output .= '</div>';
            // end active components

            // The inactive/availble components
            $output .= '<div class="postbox frontPageLayoutList">';

                // the label and expand icon
                $output .= '<label class="js--extend-field">';
                    $output .= '<h3>Inactive Components';
                        $output .= '<span class="dashicons dashicons-external"></span>';
                    $output .= '</h3>';
                $output .= '</label>';

                // the sortables
                $output .= '<ul id="inactiveComponents" class="sortables-wrapper connectedSortable">';
                    foreach($inactiveComponents as $key => $value){
                        $name = $value;
                        $label = ucwords(str_replace('_',' ',$value));
                        $output .= '<li class="sortable menu-item-handle" data-component="'.$name.'">';
                            $output .= '<h5 class="sortable__title">'.$label.'</h5>';
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
                // end sortables
            $output .= '</div>';
            // end inactive comps

        $output .= '</div>';


        return $output;
    }

    // this is gross but im hungover and lay
    public function find_value($target){

        $fields = $this->fields;
        foreach($fields as $field){

            $tabs = $field['tabs'];

            foreach($tabs as $tab){

                $tab_fields = $tab['fields'];
                foreach($tab_fields as $tab_field){

                    if($tab_field['name'] == $target){
                        return $tab_field['value'];
                    }
                }
            }
        }
        return false;
    }


    // get alpha from RGBA
    public function get_alpha($rgba){
        $find = array('rgba','(',')');
        $rgba = str_replace($find,'',$rgba);

        $parts = explode(', ', $rgba);
        $last = $parts[(sizeof($parts)-1)];

        $alpha = $last;
        return $alpha;
    }
}
