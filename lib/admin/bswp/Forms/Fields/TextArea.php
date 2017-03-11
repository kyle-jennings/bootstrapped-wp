<?php

namespace bswp\Forms\Fields;

class TextArea extends Field {

    public $output;

    public function field_output(){

        $output = '';
        $name = 'bswp_'.$this->section_name.
        '['.$this->group_name.']['.$this->tab_name.']['.$this->name.']';

        // examine($this->args);
        $type = !empty($this->args['type']) ? $this->args['type'] : null ;

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

        }
        else{
            $output .= '<textarea name="'.$name.'"
                rows="10">'.$this->value.'</textarea>';
        }


        return $output;

    }


}
