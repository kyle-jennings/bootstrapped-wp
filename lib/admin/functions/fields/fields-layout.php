<?php
/**
 * Each set of fields can be automatically generated using ths following array
 * structure for settings:
 *
 *
 * $fields = array(
 *    'tabs'=>array(
 *        'tab-name'=>array(
 *            'label'=>'Tab Name',
 *            'fields'=>array(
 *                'color'=>array(
 *                    'name'=>'field-name',
 *                    'label'=>'Field Name',
 *                    'type'=>'field-type',
 *                    'args'=>'{string or array}',
 *                    'toggle_fields'=>array('option'=>'field_1,field_2,field_3'),
 *                    'toggled_by'=>array('field_name'=>'option1,option2,option3'),
 *                    'preview'=>null
 *                 ),
 *             ),
 *         ),
 *     ),
 * );
 */

$frontpage_fields = array(
    'section'=>'front_page',
    'tabs'=>array(
        'front_page'=>array(
            'label'=>'Front Page',
            'fields'=>array(
                'components'=>sortable_field(array(
                        'name'=>'components',
                        'label'=>'components',
                        'args'=>array(
                            'content',
                            'custom_content',
                            'widget_area_1',
                            'widget_area_2',
                            'widget_area_3',
                        ),
                        'preview'=>'no_preview'
                    )
                ),
                'content_title'=>text_field(array(
                        'name'=>'content_title',
                        'label'=>'Content Title',
                    )
                ),
                'custom_title'=>text_field(array(
                        'name'=>'custom_title',
                        'label'=>'Custom Title',
                    )
                ),
                'custom_content'=>textarea_field(array(
                        'name'=>'custom_content',
                        'label'=>'Custom Content',
                        'args'=>'wp_editor'
                    )
                ),
            )
        ),
    )
);


$layout_settings_tabs = array(
    $frontpage_fields,
);