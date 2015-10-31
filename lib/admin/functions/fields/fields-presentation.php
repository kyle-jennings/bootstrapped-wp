<?php

/**
 * Presentation Components
 */

/**
 * Gross shit again - basically all teh components are the same
 * Each component is just a set of color fields, with a couple small exceptions
 * so we do not need to define all the settings, we make the assumption that they
 * are color fields. If there ARE options (via arrays) then we handle that in a function
 */
$tabbed_content = array(
    'tabbed_content_background',
    'tabbed_content_border',
    'tabbed_content_text_color',
    'tabbed_content_link_color',
    'active_tab_background',
    'active_tab_border',
    'active_tab_link_color',
    'inactive_tab_border',
    'inactive_tab_background',
    'inactive_tab_link_color',
    'hovered_tab_background',
    'hovered_tab_border',
    'hovered_tab_link_color',
);
$collapsibles = array(
    'collapible_content_background',
    'collapible_content_border',
    'collapible_content_link_color',
    'collapible_content_text_color',
    'active_title_background',
    'active_title_link_color',
    'inactive_title_background',
    'inactive_title_link_color',
    'hovered_title_background',
    'hovered_title_link_color',
);

$tables = array(
    'table_header_background',
    'table_border',
    'table_header_link_color',
    'table_header_text_color',
    'even_row_background',
    'even_row_link_color',
    'even_row_text_color',
    'odd_row_background',
    'odd_row_link_color',
    'odd_row_text_color',
    'hovered_row_background',
    'hovered_row_link_color',
    'hovered_row_text_color',
);

$pagination = array(
    'pagination_border',
    'pagination_background',
    'pagination_text',
    'pagination_link',
    'pagination_hover_background',
    'pagination_hover_link',
    'pagination_current_background',
    'pagination_current_text',
);

$nav_lists = array(
    'nav_header_color',
    'nav_link',
    'nav_hover_link',
    'bullet_color',
    'decoration',
);


$pre = array(
    'pre_background',
    'pre_border',
    'pre_text',
    'pre_link',
    'pre_hovered_link',
    'border_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
    'padding_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
);

$address = array(
    'address_background',
    'address_border',
    'address_text',
    'address_link',
    'address_hovered link',
    'border_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
    'padding_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
);

$blockquote = array(
    'blockquote_background',
    'blockquote_border',
    'blockquote_text',
    'blockquote_link',
    'blockquote_hovered_link',
    'border_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
    'padding_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
);

$forms = array(
    'form_background',
    'form_border',
    'form_text',
    'field_background',
    'field_border',
    'field_glow',
    'field_text',
    'button_background',
    'button_background end',
    'button_border',
    'button_text',
);

$components = array(
    'tabbed_content'=>array(
        'label'=>'Tabbed Content',
        'fields'=>components_field_settings($tabbed_content)
    ),
    'collapsibles'=>array(
        'label'=>'Collapsibles',
        'fields'=>components_field_settings($collapsibles)
    ),
    'tables'=>array(
        'label'=>'Tables',
        'fields'=>components_field_settings($tables)
    ),
    'pagination'=>array(
        'label'=>'Pagination',
        'fields'=>components_field_settings($pagination)
    ),
    'nav_lists'=>array(
        'label'=>'Nav Lists',
        'fields'=>components_field_settings($nav_lists)
    ),
    'pre'=>array(
        'label'=>'Preformatted',
        'fields'=>components_field_settings($pre)
    ),
    'blockquote'=>array(
        'label'=>'Blockquotes',
        'fields'=>components_field_settings($blockquote)
    ),
    'forms'=>array(
        'label'=>'Forms',
        'fields'=>components_field_settings($forms)
    ),
);

// compiled components fields
$components_fields = array(
    'section'=>'components',
    'tabs'=>$components
);