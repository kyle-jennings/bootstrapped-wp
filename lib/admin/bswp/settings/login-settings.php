<?php

namespace bswp\forms\fields;
use bswp\forms\fields;

$login_settings_fields = array(
    'login_image'=>select_field(array(
            'name'=>'login_image',
            'label'=>'Login Image',
            'args'=>array('uploaded_logo','different_image', 'none'),
            'toggle_fields'=>array('different_image'=>'file')
        )
    ),
    'file'=>file_field(array(
            'name'=>'file',
            'lable'=>'Upload File',
            'toggled_by'=>array('login_image'=>'different_image')
        )
    ),
);
