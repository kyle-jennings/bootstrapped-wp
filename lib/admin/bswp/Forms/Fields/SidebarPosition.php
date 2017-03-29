<?php

namespace bswp\Forms\Fields;


class SidebarPosition extends Field{

    /**
     * Select field
     * 'args' field is in array - used to populate the options
     * if an 'args' a non-associative array then each value is used for both the value and label
     * otherwise the key is the value and the value is the label. huh?
     * @return [type]       [description]
     */
    public function field_output() {

        $output = '';
        $attrs = $this->set_attrs();
        extract($attrs);

        // the label
        $output .= '<label>'.$this->label.'</label>';

        $pos = $this->get_pos();
        $vis= $this->get_vis();
        // the select
        $output .= '<select class="'.$classes.'" data-name="position">';
            $output .= $this->options_markup($pos);
        $output .= '</select>';

        $output .= $this->diagram($pos);

        $output .= $this->get_component_visibility($vis);

        $output .= '<input
            id="'.$id.'"
            name="'.$field_name.'"
            type="hidden"
            value='.$value_str.'
        />';

        return $output;

    }

    private function get_pos()
    {
        foreach($this->value as $value) {
            if($value->name == 'position')
                return $value->value;
        }
    }


    private function get_vis()
    {
        foreach($this->value as $value) {
            if($value->name == 'visibility')
                return $value->value;
        }
    }


    private function options_markup($saved)
    {
        $output = '';
        // loop through the args to set the select options
        foreach ($this->args as $key=>$option):

            $option_test = $option;
            if(is_string($key))
                $option_text = $key;

            $name = strtolower(str_replace(' ','_',$option));
            $data_targets = '';
            $selected = $saved == $option ? 'selected' : '';
            // the option markup
            $output .= '<option value="'.$option.'" '.$selected.'>';
                $output .= str_replace('_',' ',$option);
            $output .= '</option>';

        endforeach;

        return $output;
    }


    private function get_component_visibility($vis)
    {
        $visibilities = array(
            'all',
            'visible_phone',
            'visible_tablet',
            'visible_desktop',
            'hidden_phone',
            'hidden_tablet',
            'hidden_desktop',
        );
        $output = '<span class="sidebar-visibility">';
            // $output .=  '<span class="dashicons dashicons-visibility"></span>';
            $output .=  '<select class="js--sidebar-setting js--no-css-change" data-name="visibility">';
                    foreach($visibilities as $v){
                        $selected = $v == $vis ? 'selected' : '';
                        $output .= '<option value="'.$v.'" '.$selected.'>';
                            $output .= $this->clean_string($v);
                        $output .= '</option>';
                    }

            $output .= '</select>';
        $output .=  '</span>';

        return $output;
    }


    private function diagram($value = 'none')
    {

        $output = '';
        $output .=
        '<div class="diagram js--diagram '.$value.'">
            <div class="diagram-column diagram__content-area">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. In convallis, lectus eu pulvinar viverra, urna nisl varius magna, vel lacinia eros ipsum nec turpis. Integer convallis eros ut dictum auctor. Ut sagittis massa sit amet nibh tincidunt volutpat. Phasellus aliquet urna in leo aliquet, non ullamcorper arcu blandit. Nam nisi libero, tristique sed arcu vel, imperdiet ornare tortor. Vivamus sed nunc urna. Integer arcu elit, porttitor quis dapibus tempor, pulvinar ac velit.
            </div>
            <div class="diagram-column diagram__sidebar"></div>
        </div>';

        return $output;
    }

    private function value_str() {
        $value = json_encode($this->value);
        $value = str_replace('\\','', $value);
        $value = trim($value, '"');
        $value_str = htmlspecialchars($value);


        $this->value = json_decode($this->value);

        return $value_str;
    }

    public function set_attrs(){
        $classes = $this->class . ' ' . $this->type .' js--sidebar-diagram-toggle js--no-css-change js--sidebar-setting';
        $classes .= $this->toggle_fields ? ' js--toggle-field' : '';


        // all the data attrs
        if($this->preview == 'toggle-class'){
            $data_preview_deps = $this->preview_args ? 'data-toggle_class="'.$this->preview_args.'"' : '' ;
        }else{
            $data_preview_deps = $this->preview_dependancies ? 'data-preview_deps="'.$this->preview_dependancies.'"' : '' ;
        }
        $data_preview = $this->preview ? 'data-preview="'.$this->preview.'"' : '';
        $data_field_name = $this->toggle_fields ? 'data-field_name="'.$this->name.'"' : '';

        // list of the fields which are toggled by this one
        $data_target_fields = $this->data_target_fields
        ? 'data-target_fields="'.$this->data_target_fields.'"' : '';

        $value_str = $this->value_str();

        // the id and field name
        $id = $this->group_name.'-'.$this->tab_name.'-'.$this->name;
        $field_name = 'bswp_'.$this->section_name.
            '['.$this->group_name.']['.$this->tab_name.']['.$this->name.']';


        return array(
            'id'=>$id,
            'field_name' => $field_name,
            'value_str' => $value_str,
            'data_target_fields' => $data_target_fields,
            'data_field_name' => $data_field_name,
            'data_preview' => $data_preview,
            'data_preview_deps' => $data_preview_deps,
            'classes' => $classes
        );
    }
}
