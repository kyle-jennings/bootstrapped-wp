<?php

namespace bswp\Forms\Fields;
use bswp\Forms\Fields;

use function bswp\Settings\_helpers;
use function bswp\Settings\_helpers\border_settings_map;
use function bswp\Settings\_helpers\border_corners_toggle_map;

use function bswp\Settings\_helpers\add_px_string;
use function bswp\Settings\_helpers\heading_toggle;


$radii = array('top_left','top_right','bottom_right','bottom_left');
$radii_fields = array();
$radii_fields['all_corners'] = new Select(
    array(
        'name'=>'all_corners',
        'label'=>'All Corners',
        'args'=>array_map('bswp\Settings\_helpers\add_px_string', range(1,20))
    )
);

$radii_fields['style_corners'] = new Select(
    array(
        'name'=> 'style_corners',
        'args'=>array('no', 'yes'),
        'toggle_fields' => border_corners_toggle_map('toggle')
    )
);
// the border radius fields are all the same so lets set them a single time
foreach($radii as $radius){
    $radii_fields[$radius] = new Select(
        array(
            'name'=>$radius,
            'label'=>ucfirst(str_replace('_', ' ', $radius)),
            'args'=>array_map('bswp\Settings\_helpers\add_px_string', range(1,20)),
            'toggled_by'=>array('style_corners' => border_corners_toggle_map('toggled_by') )
        )
    );
}
