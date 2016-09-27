<?php

namespace bswp\forms\fields;

class sortableField extends field  {

    public $output;

    public function __construct($args=array(), $tab = null){

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


        $this->output = $output;

    }

    public function __toString(){
        return $this->output;
    }
}
