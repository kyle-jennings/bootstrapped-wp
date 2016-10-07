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
    'tabbed_content_background'=>array('args'=>'transparency'),
    'tabbed_content_background_rgba'=>array('type'=>'no'),
    'tabbed_content_border',
    'tabbed_content_text_color',
    'tabbed_content_link_color',

    'tabbed_inactive_tab_background'=>array('args'=>'transparency'),
    'tabbed_inactive_tab_background_rgba'=>array('type'=>'no'),
    'tabbed_inactive_tab_border',
    'tabbed_inactive_tab_link_color',

    'tabbed_hovered_tab_background'=>array('args'=>'transparency'),
    'tabbed_hovered_tab_background_rgba'=>array('type'=>'no'),
    'tabbed_hovered_tab_border',
    'tabbed_hovered_tab_link_color',
);
$collapsibles = array(
    'collapsible_content_background'=>array('args'=>'transparency'),
    'collapsible_content_background_rgba'=>array('type'=>'no'),
    'collapsible_content_border',
    'collapsible_content_link_color',
    'collapsible_content_text_color',

    'collapsible_active_title_background'=>array('args'=>'transparency'),
    'collapsible_active_title_background_rgba'=>array('type'=>'no'),
    'collapsible_active_title_border',
    'collapsible_active_title_link_color',

    'collapsible_inactive_title_background'=>array('args'=>'transparency'),
    'collapsible_inactive_title_background_rgba'=>array('type'=>'no'),
    'collapsible_inactive_title_border',
    'collapsible_inactive_title_link_color',

    'collapsible_hovered_title_background'=>array('args'=>'transparency'),
    'collapsible_hovered_title_background_rgba'=>array('type'=>'no'),
    'collapsible_hovered_title_border',
    'collapsible_hovered_title_link_color',
);

$tables = array(
    'table_header_background'=>array('args'=>'transparency'),
    'table_header_background_rgba'=>array('type'=>'no'),
    'table_border',
    'table_header_link_color',
    'table_header_text_color',
    'even_row_background'=>array('args'=>'transparency'),
    'even_row_background_rgba'=>array('type'=>'no'),
    'even_row_link_color',
    'even_row_text_color',
    'odd_row_background'=>array('args'=>'transparency'),
    'odd_row_background_rgba'=>array('type'=>'no'),
    'odd_row_link_color',
    'odd_row_text_color',
);

$pagination = array(
    'pagination_border',
    'pagination_background'=>array('args'=>'transparency'),
    'pagination_background_rgba'=>array('type'=>'no'),
    'pagination_text',
    'pagination_link',
    'pagination_hover_background'=>array('args'=>'transparency'),
    'pagination_hover_background_rgba'=>array('type'=>'no'),
    'pagination_hover_link',
    'pagination_current_background'=>array('args'=>'transparency'),
    'pagination_current_background_rgba'=>array('type'=>'no'),
    'pagination_current_text',
);

$nav_lists = array(
    'nav_header_color',
    'nav_link',
    'nav_hover_link',
    'nav_bullet_color',
    'nav_decoration',
);


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

$address = array(
    'address_background'=>array('args'=>'transparency'),
    'address_background_rgba'=>array('type'=>'no'),
    'address_border',
    'address_text',
    'address_link',
    'address_hovered link',
    'adress_border_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
    'address_padding_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
);

$blockquote = array(
    'blockquote_background'=>array('args'=>'transparency'),
    'blockquote_background_rgba'=>array('type'=>'no'),
    'blockquote_border',
    'blockquote_text',
    'blockquote_link',
    'blockquote_hovered_link',
    'border_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
    'padding_size'=>array('type'=>'select', 'args'=>array_map('add_px_string', range(1,20)) ),
);

$forms = array(
    'form_background'=>array('args'=>'transparency'),
    'form_background_rgba'=>array('type'=>'no'),
    'form_border',
    'form_text',
    'field_background'=>array('args'=>'transparency'),
    'field_background_rgba'=>array('type'=>'no'),
    'field_border',
    'field_glow'=>array('args'=>'transparency'),
    'field_glow_rgba'=>array('type'=>'no'),
    'field_text',
    'button_background',
    'button_background end',
    'button_border',
    'button_text',
);

$init = array(
    'iframe_background'=>array('args'=>'transparency'),
    'iframe_background_rgba'=>array('type'=>'no'),
    'iframe_border',
    'iframe_glow'=>array('args'=>'transparency'),
    'iframe_glow_rgba'=>array('type'=>'no'),
    'button_border_color',
    'button_border_style',
    'button_border_width',
    'button_border_radius',
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
