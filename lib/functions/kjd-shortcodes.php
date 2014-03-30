<?php

add_action('init', 'add_button');

function add_button() {  
   if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') && get_user_option('rich_editing') == true )  
   {  
     add_filter('mce_external_plugins', 'add_plugin');  
     add_filter('mce_buttons', 'register_button');  
   }  
}  


function register_button($buttons) {  
   array_push($buttons,"|" ,"kjdShortCodeInjection");  
   return $buttons;  
}  

function add_plugin($plugin_array) {  
   $plugin_array['kjdShortCodeInjection'] = get_bloginfo('template_url').'/lib/admin/js/mcePlugin.js';  
   return $plugin_array;  
} 




///////////////////////////////////
// The shortcodes
///////////////////////////////////
add_shortcode('row', 'row');
function row($atts, $content = null){
 	return '<div class="row">' .do_shortcode($content). '</div>';	
}

add_shortcode('column', 'column');
function column($atts, $content = null){
 	extract(shortcode_atts(array(
      "size" => 'size',
      "offset" => 'offset'
    ), $atts));

    return '<div class="span'.$size.' offset'.$offset.'">' . do_shortcode( $content ) . '</div>';
}

///////////////////////////
//// buttons 
add_shortcode('button', 'button');
function button($atts, $content = null){
  extract(shortcode_atts(array(
      "target" => 'target',
      "block" => 'block',
      "size" => 'size',
      "style" => 'style'
    ), $atts));

    return '<a href="'.$target.'" class="btn '.$size.' '.$block.' '.$style.'" style="color:white; text-decoration:none;">' . do_shortcode( $content ) . '</a>';
}

add_shortcode('buttonGroup', 'buttonGroup');
function buttonGroup($atts, $content =null){
  return '<div class="btn-group">'.do_shortcode( $content ).'</div>';
}



///////////////////////////////
// formatting
add_shortcode('badge', 'badge');
function badge($atts, $content = null){
  extract(shortcode_atts(array(
      "style" => 'style'
    ), $atts));

    return '<span class="badge '.$style.'">'. do_shortcode( $content ) . '</span>';
}

add_shortcode('label', 'label');
function label($atts, $content = null){
  extract(shortcode_atts(array(
      "style" => 'style'
    ), $atts));

    return '<span class="label '.$style.'">'. do_shortcode( $content ) . '</span>';
}
///////////////////////////
/// callouts
add_shortcode('callout', 'callout');
function callout($atts, $content = null){
  extract(shortcode_atts(array(
'type' => 'type',
'style' => 'style',
'size' => 'size'
    ), $atts));
  if($type == 'jumbotron'){
    return '<div class="jumbotron" style="background:none; color:inherit;">'. do_shortcode( $content ) . '</div>';
  }elseif($type == 'hero-unit'){
    return '<div class="hero-unit '.$style.' '.$size.'">'. do_shortcode( $content ) . '</div>';
  }elseif($type == 'page-header'){
    return '<div class="page-header" style="background:none; color:inherit;">'. do_shortcode( $content ) . '</div>';
  }elseif($type == 'featurette'){
    return '<div class="featurette" style="background:none; color:inherit;">'. do_shortcode( $content ) . '</div>';
  }elseif($type == 'well'){
    return '<div class="well '.$style.' '.$size.'">'. do_shortcode( $content ) . '</div>';
  }

}
add_shortcode('small', 'small');
function small( $atts, $content = null ) {
  return '<small>'.do_shortcode( $content ).'</small>';
}


//////////////////////////////
/// tabs
add_shortcode('tabs', 'tabs');
// Tabbed content
 function tabs( $atts, $content = null ) {
    
    if( isset($GLOBALS['tabs_count']) )
      $GLOBALS['tabs_count']++;
    else
      $GLOBALS['tabs_count'] = 0;
  extract(shortcode_atts(array(
     'style' => 'style',
     'number' => 'number'
    ), $atts));
    
    // Extract the tab titles for use in the tab widget.
    preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    
    $tab_titles = array();
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
    
    $output = '';
    
    if( count($tab_titles) ){
      $output .='<div class="tabbable '.$style.'">';
      if($style=='tabs-below'){
        $output .= '<div class="tab-content">';
        $output .= do_shortcode( $content );
        $output .= '</div>';
      }
      if($style=='nav-pills'){
        $output .= '<ul class="nav nav-pills" id="custom-tabs-'. rand(1, 1000) .'">';
      }else{
        $output .= '<ul class="nav nav-tabs" id="custom-tabs-'. rand(1, 1000) .'">';
      }
      $i = 0;
      foreach( $tab_titles as $tab ){
        if($i == 0)
          $output .= '<li class="active">';
        else
          $output .= '<li>';

        $output .= '<a href="#custom-tab-' . $GLOBALS['tabs_count'] . '-' . sanitize_title( $tab[0] ) . '"  data-toggle="tab">' . $tab[0] . '</a></li>';
        $i++;
      }
        
        $output .= '</ul>';
      if($style!='tabs-below'){
        $output .= '<div class="tab-content">';
        $output .= do_shortcode( $content );
        $output .= '</div>';
      }
      $output .= '</div>';
    } else {
      $output .= do_shortcode( $content );
    }

    return $output;
  }

add_shortcode('tab', 'tab');
  function tab( $atts, $content = null ) {

    if( !isset($GLOBALS['current_tabs']) ) {
      $GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
      $state = 'active';
    } else {

      if( $GLOBALS['current_tabs'] == $GLOBALS['tabs_count'] ) {
        $state = ''; 
      } else {
        $GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
        $state = 'active';
      }
    }

    $defaults = array( 'title' => 'Tab');
    extract( shortcode_atts( $defaults, $atts ) );
    
    return '<div id="custom-tab-' . $GLOBALS['tabs_count'] . '-'. sanitize_title( $title ) .'" class="tab-pane ' . $state . '">'. do_shortcode( $content ) .'</div>';
  }


///////////////////////////////
////// collapsible
add_shortcode('collapsibles', 'collapsibles');
  function collapsibles( $atts, $content = null ) {
    
    if( isset($GLOBALS['collapsibles_count']) )
      $GLOBALS['collapsibles_count']++;
    else
      $GLOBALS['collapsibles_count'] = 0;

     $defaults = array('group'=>'group');
    extract( shortcode_atts( $defaults, $atts ) );
    
    // Extract the tab titles for use in the tab widget.
    preg_match_all( '/collapsible title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    
    $tab_titles = array();
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
    
    $output = '';

    $output .= '<div class="accordion" id="accordion-' . $GLOBALS['collapsibles_count'] . '">';
    $output .= do_shortcode( $content );
    $output .= '</div>';

    return $output;
  }
  
add_shortcode('collapsible', 'collapsible');
  function collapsible( $atts, $content = null ) {

    if( !isset($GLOBALS['current_collapse']) )
      $GLOBALS['current_collapse'] = 0;
    else 
      $GLOBALS['current_collapse']++;


    $defaults = array( 'title' => 'Tab', 'state' => '');
    extract( shortcode_atts( $defaults, $atts ) );
    
    if (!empty($state)) 
      $state = 'in';

    return '
    <div class="accordion-group">
      <div class="accordion-heading">
        <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion-' . $GLOBALS['collapsibles_count'] . '" href="#collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'">
          ' . $title . ' 
        </a>
      </div>
      <div id="collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'" class="accordion-body collapse ' . $state . '">
        <div class="accordion-inner">
          ' . do_shortcode( $content ) . ' 
        </div>
      </div>
    </div>
    ';
  }


add_shortcode('image', 'image');
function image($atts, $content = null){

    extract( shortcode_atts( array( 
      'style' => 'rounded'
      ),
       $atts ) 
    );
    
    return '<div class="image '.$style.'">'.do_shortcode( $content ).'</div>';
}

/////////////////////////////
// sliders
add_shortcode('imageSlider', 'imageSlider');
function imageSlider($atts, $content = null){
    $root=get_bloginfo('template_directory'); 
    extract( shortcode_atts( array( 
      'style' => 'nivo'
      ),
       $atts ) 
    );
 

  if($style =="flexslider"){

    $imageSlider ='<link rel="stylesheet" href="'.$root.'/lib/scripts/flexslider/flexslider.css" type="text/css">
<script src="'.$root.'/lib/scripts/flexslider/flexslider.js"></script>'; 
    $imageSlider .= '<script type="text/javascript" charset="utf-8">
  jQuery(window).load(function() { jQuery(".flexslider").flexslider({  animation: "slide",selector: ".slides > img" }) }); </script>';
    $imageSlider .= '<div class="flexslider"><div class="slides">';
    $imageSlider .= do_shortcode( $content );
    $imageSlider .='</div>'; 
    $imageSlider .='</div>'; 
    $imageSlider .='</div>'; 

  }else{
    $imageSlider = '<script type="text/javascript" src="'.$root.'/lib/scripts/nivo/nivoSliderPack.js"></script>';
    $imageSlider .='<script type="text/javascript">jQuery(window).load(function() { jQuery(".nivoSlider").nivoSlider() });</script>';
    $imageSlider .='<link media="all" type="text/css" href="'.$root.'/lib/scripts/nivo/nivoSlider.css" id="nivo" rel="stylesheet">';
    $imageSlider .= '<link media="all" type="text/css" href="'.$root.'/lib/scripts/nivo/themes/default/default.css" id="nivoTheme" rel="stylesheet">';
    $imageSlider .= '<div class="imageSlider">';
    $imageSlider .= '<div class="nivoSlider">';
    $imageSlider .= do_shortcode( $content );
    $imageSlider .='</div>';
    $imageSlider .='</div>'; 

  }



    return $imageSlider;
}

////////////////////////////
// tables


////////////////////////
/// Magic
add_shortcode('hideTitle', 'hideTitle');
function hideTitle($atts, $content = null){
    return '<script>jQuery(document).ready(function() { jQuery("#pageTitle").hide();  });</script>';
}