<?php

namespace bswp\Settings;

use bswp\Forms\Fields\Divider;
use bswp\Forms\Fields\Label;
use bswp\Forms\Fields\ColorPicker;
use bswp\Forms\Fields\Hidden;
use bswp\Forms\Fields\Select;
use bswp\Forms\Fields\SidebarPosition;
use bswp\Forms\Fields\TextArea;
use bswp\Forms\Fields\Text;
use bswp\Forms\Fields\Sortable;

use function bswp\Settings\_helpers\remove_link_decoration;
use function bswp\Settings\_helpers\remove_link_bg;
use function bswp\Settings\_helpers\border_settings_map;



$layouts->add_tab('frontpage', array(
    'frontpage_layout_sortable' => new Sortable(array(
        'name'=>'frontpage_layout_sortable',
        'label' => "Frontpage Layout",
        'args'=>array(
            'frontpage_widgets_1',
            'frontpage_widgets_2',
            'frontpage_widgets_3',
            'content',
        ),
        'preview'=>'form_save_warning'
    )),
));
