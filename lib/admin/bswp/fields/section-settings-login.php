<?php

$login_settings_fields = array(
    'section'=>'settings',
    'tabs' => array(

        'general_settings'=>array(
            'label'=>'Settings',
            'fields'=>array(
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

            ),
        ),
    )
);


// remove most of the presentation components
$unset = ['tabbed_content','collapsibles', 'tables','pagination','nav_lists','pre','blockquote'];
foreach($unset as $v)
    unset($components_fields['tabs'][$v]);


$login_settings_tabs = array(
    $background_fields,
    $text_fields,
    $components_fields,
    $login_settings_fields
);