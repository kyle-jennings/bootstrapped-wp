<?php

namespace bswp\forms\fields;
use bswp\forms\fields;

use function bswp\settings\_helpers;
use function bswp\settings\_helpers\border_settings_map;
use function bswp\settings\_helpers\add_px_string;
use function bswp\settings\_helpers\heading_toggle;


$radii = array('top_left','top_right','bottom_right','bottom_left');
$radii_fields = array();

// the border radius fields are all the same so lets set them a single time
foreach($radii as $radius){
    $radii_fields[$radius] = new Select(array(
            'name'=>$radius,
            'label'=>ucfirst(str_replace('_', ' ', $radius)),
            'args'=>array_map('bswp\settings\_helpers\add_px_string', range(1,20))
        )
    );
}
