<?php

/**
 * Each set of fields can be automatically generated using ths following array
 * structure for settings:
 *
 *
 * $fields = array(
 *    'tabs'=>array(
 *        'tab-name'=>array(
 *            'label'=>'Tab Name',
 *            'fields'=>array(
 *                'color'=>array(
 *                    'name'=>'field-name',
 *                    'label'=>'Field Name',
 *                    'type'=>'field-type',
 *                    'args'=>'{string or array}',
 *                    'toggle_field'=>null,
 *                    'field_toggle'=>array('field_name'=>'option'),
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

// Reusable fields
function text_field($settings = array()){
    extract($settings);
    $name = isset($name) ? $name : 'field';
    return array(
       'name'=> $name,
       'label'=> isset($label) ? $label : ucfirst(str_replace(array('-','_'), ' ', $name ) ),
       'type'=> isset($type) ? $type : 'text',
       'args'=> isset($args) ? $args : null,
       'toggle_field'=> isset($toggle_field) ? $toggle_field : null,
       'field_toggle'=> isset($field_toggle) ? $field_toggle : null,
       'preview'=>null
    );
};

function text_decoration_field($args = array()){
    $args['name'] = isset($args['name']) ? $args['name'] : 'text_decoration';
    $args['label'] = isset($args['label']) ? $args['label'] : 'Text Decoration';

    $args['args'] = array(
                    'none',
                    'overline',
                    'underline',
                    'line-through',
                    'text-shadow',
                );
    $args['toggle_field']= array('text_shadow_color');
    return select_field($args);
}

function text_shadow_color_field($args=array()){
    $args['name'] = isset($args['name']) ? $args['name'] : 'text_shadow_color';
    return color_field($args);
}

function color_field($args = array()){
    $args['name'] = isset($args['name']) ? $args['name'] : 'color';
    $args['type'] = 'color';
    return text_field($args);
}

function select_field($args = array()){
    $args['type'] = 'select';
    return text_field($args);
};

function file_field($args = array()){
    $args['type'] = 'file';
    return text_field($args);
}

function textarea_field($args = array()){
    $args['type'] = 'textarea';
    return text_field($args);
}

function label_field($args = array()){
    extract($args);
    $args['type'] = 'label';
    return text_field($args);
}

/**
 * Helpers
 */

// All the components are basically just a bunch of color fields
function components_field_settings($fields = array()){

    $array = array();
    foreach($fields as $k=>$v){

        $args = array();

        if(is_array($v)){
            $args = array(
                'name'=>str_replace(' ','_',strtolower($k) ),
                'type'=>$v['type'] ? $v['type'] : 'color',
                'args'=>$v['args'] ? $v['args'] : null,
            );
        }
        else{
            $args = array(
                'name'=>str_replace(' ','_',strtolower($v) ),
                'type'=>'color'
            );
        }


        $array[ $args['name'] ] = call_user_func($args['type'].'_field', $args);
    }
    return $array;
}

/**
 * Pixel width helper - Adds 'px' to each step in the range
 * used for stuff like border widths
 * @param [type] $index [description]
 */
function add_px_string($index){
    return ($index.'px');
}

/**
 * Hell if I'm going to write down all the border styles each time
 * @var array
 */
$border_styles = array(
    'none',
    'solid',
    'dotted',
    'dashed',
    'double',
    'groove',
    'ridge',
    'inset',
    'outset',
);




/**
 * Global fields
 *
 * These fields appear in most, if not all sections
 */
include('fields-background.php');
include('fields-border.php');
include('fields-headings.php');
include('fields-text.php');
include('fields-presentation.php');
include('fields-image.php');


/**
 * Section specific fields
 *
 * These files contina the sections' misc settings fields, or the wierd one offs
 * like the general theme settings, or the "special backgrounds", page temaplates ect
 */

include('section-settings-theme.php');
include('section-settings-header.php');
include('section-settings-navbar.php');
include('section-settings-nav-dropdown.php');
include('section-settings-mobile-nav.php');
include('section-settings-page-title.php');
include('section-settings-body.php');
include('section-settings-feed.php');
include('section-settings-footer.php');
