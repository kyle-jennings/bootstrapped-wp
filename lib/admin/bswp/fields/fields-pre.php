<?php

$pre = array(
    'pre_background'=>array('args'=>'transparency'),
    'pre_background_rgba'=>array('type'=>'no'),
    'pre_border',
    'pre_text',
    'pre_link',
    'pre_hovered_link',
    'pre_border_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
    'pre_padding_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
);
