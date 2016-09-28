<?php

namespace bswp\css;


/**
 * Background Colors
 */
class background {

    public $start_color;
    public $end_color;
    public $background_start_color;
    public $background_start_color_rgba;
    public $background_end_color;
    public $background_end_color_rgba;

    public $background_gradient;

    public $background_use_wallpaper;
    public $background_image;
    public $background_repeat;
    public $background_attachment;
    public $background_position;
    public $background_positionX;
    public $background_positionY;
    public $background_size;
    public $background_percentage;


    public $output = '';

    // magic methods

    public function __construct( $args = array() ){

        if(!is_array($args))
            return false;

        $this->set_values($args);
        $this->set_true_color('start');
        $this->set_true_color('end');

    }

    public function __toString(){
        return $this->output;
    }

    // custom methods

    public function add_breaklines(){

        $first_char = $this->output[0];
        $this->output = "\n".$this->output;
        $this->output = str_replace(';', "; \n", $this->output);
    }


    public function set_values($args = array()){


        if( empty($args) )
            return false;

        foreach($args as $k=>$v){
            $this->$k = $v;
        }

    }


    public function set_true_color($point = 'start'){

        $target_color = "background_${point}_color";
        $target_color_rgba = "background_${point}_color_rgba";
        $true_value = "${point}_color";

        if( !empty($this->$target_color ) ){
            if( empty($this->$target_color_rgba ) )
                $this->$true_value = $this->$target_color;
            else
                $this->$true_value = $this->$target_color_rgba;
        }else{
            $this->$true_value = 'transparent';
        }

    }


    public function colors(){

        if($this->background_gradient != 'none'){

            switch($this->background_gradient):
                case 'solid':
                    $this->solid();
                    break;
                case 'vertical':
                    $this->linear_gradient('top');
                    break;
                case 'horizontal':
                    $this->linear_gradient('left');
                    break;
                case 'radial':
                    $this->radial_gradient();
                    break;
                default:
                    $this->solid();
                    break;
            endswitch;

        }else {
            $this->transparent();
        }
    }


    /**
     * Background Color Functions
     * @return [type] [description]
     */
    public function solid(){

        // start color
        $output = '';

        $output .= 'background-color: ';
            $output .= $this->start_color;
        $output .= ';';

        $this->output .= $output;
    }


    public function linear_gradient($direction = 'top'){

        $output .= $this->solid();
        $output .= 'background-image: linear-gradient('.$direction.', '.$this->start_color.', '.$this->end_color.');';

        $output .= 'filter:  progid: DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr="'.$this->start_color.'", endColorstr="'.$this->end_color.'");';
		$output .= '-ms-filter: "progid: DXImageTransform.Microsoft.gradient(GradientType=1,startColorstr="'.$this->start_color.'", endColorstr="'.$this->end_color.'");';

        $this->output .= $output;
    }


    public function radial_gradient(){
        $output = $this->solid();
        $output .= 'background-image: radial-gradient(circle farthest-side at right, '.$this->start_color.', '.$this->end_color.');';

        $this->output .= $output;

    }


    public function transparent(){
        $this->output .= 'background-color: transparent';
    }


    public function wallpaper(){


        if($this->background_use_wallpaper !== 'yes' || empty($this->background_image) )
            return false;

        $output = '';
        $this->background_positionX = !empty($this->background_positionX) ? $this->background_positionX : '0' ;
    	$this->background_positionY = !empty($this->background_positionY) ? $this->background_positionY : '0' ;
    	$this->background_percentage = !empty($this->background_percentage) ? $this->background_percentage : '0' ;;



        if(!empty($this->background_attachment)){
        	$output .= 'background-attachment: '. $this->background_attachment .';';
        }

    	if( !empty($this->background_image) ){
    		$output .= 'background-image: url('. $this->background_image .');';
    	}

        if( !empty($this->background_position) ) {

            if(  $this->background_position !='custom'){
                $output .= 'background-position: '. $this->background_position .';';
            }else {
                $output .= 'background-position: '. $this->background_positionX .'px '. $this->background_positionY .'px;';
            }

        }


    	if( !empty($this->background_repeat ) ){
    		$output .= 'background-repeat: '. $this->background_repeat .';';
    	}

    	if( !empty($this->background_size) ){
    		if( $this->background_size == 'percentage' ){

    			$output .= 'background-size: '. $this->background_percentage .'% auto ;';

    		}else{

    			$output .= 'background-size: '. $this->background_size .';';
    		}
    	}

        $this->output .= $output;
    }


}
