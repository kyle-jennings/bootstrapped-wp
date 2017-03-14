<?php

namespace bswp\Forms\Fields;

class TextArea extends Field {

    public $output;

    public function field_output(){

        $classes = $this->class . ' ' . $this->type;
        $classes .= $this->toggle_fields ? ' js--toggle-field' : '';
        $id = $this->group_name.'-'.$this->tab_name.'-'.$this->name;

        $name = 'bswp_'.$this->section_name.
        '['.$this->group_name.']['.$this->tab_name.']['.$this->name.']';

        // all the data attrs
        $data_preview_deps = $this->preview_dependancies ? 'data-preview_deps="'.$this->preview_dependancies.'"' : '' ;
        $data_preview = $this->preview ? 'data-preview="'.$this->preview.'"' : '';
        $data_field_name = $this->toggle_fields ? 'data-field_name="'.$this->name.'"' : '';
        // list of the fields which are toggled by this one
        $data_target_fields = $this->data_target_fields
        ? 'data-target_fields="'.$this->data_target_fields.'"' : '';


        $type = !empty($this->args['type']) ? $this->args['type'] : null ;

        $output = '';
        $output .= '<label class="js--extend-field">';
            $output .= $this->label.'<a class="js--expand-textarea" href="#"><span class="dashicons dashicons-external"></span></a>';
        $output .= '</label>';

        if($type == 'wp_editor'){

            $id = $this->tab_name.'_'.$this->name;
            $class = !empty($this->args['class'])
                ? $this->args['class']
                : '';
            $args = !empty($this->args['args']) ? $this->args['args'] : null ;
            $editor_args = $args
                ? $args
                : array(
                    'editor_class' => $class,
                    'media_buttons' => false,
                    'teeny' => false,
                    'textarea_name' => $name,
                    'textarea_rows' => 10
                );

            ob_start();
                wp_editor( $this->value, $id, $editor_args);
                $ob_content = ob_get_contents();
            ob_end_clean();
            $output .= $ob_content;
            $output .= '<input type="hidden" disabled
                class="'.$classes.'" id="'.$id.'--hidden"
                name="'.$name.'"
                '.$data_field_name.'
                '.$data_preview.' '.$data_preview_deps.'"
                '.$data_target_fields.'
            />';
        }
        else{
            $output .= '<textarea name="'.$name.'"
                rows="10"
                '.$data_field_name.'
                '.$data_preview.' '.$data_preview_deps.'"
                '.$data_target_fields.'
                >'.$this->value.'</textarea>';
        }


        return $output;

    }


}
