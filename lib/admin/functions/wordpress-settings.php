<?php


function summary_settings_section_callback() {
    echo "<h4>Feed Summary Settings</h4>";
}


function summary_length_callback($args = array() ) {
    extract($args);

    $value = $length ? $length : '20';
    $output = '';
    $output .= '<input name="summary_settings[length]" type="number" min="20" max="500" step="5" value="'.$value.'"/>';
    $output .= '<label for="summary_settings[length]">Trim feed posts to X characers</label>';

    echo $output;
}


function summary_read_more_callback($args = array() ) {
    extract($args);

    $value = $read_more ? $read_more : '...';
    $output = '';
    $output .= '<input name="summary_settings[read_more]" type="text" value="'.$value.'"/>';
    $output .= '<label for="summary_settings[read_more]">Text for the "read more" link.</label>';

    echo $output;
}

function summary_settings_callback($args = array() ){
    echo '<p>When setting "summary" in the "For each article in a feed, show"
    section above, you\'ll need to set the summary length and what the
    "read more" link will say </p>';
}

function bswp_summary_settings() {
    add_settings_section(
        'summary_settings_section',
        'Summary Settings',
        null,
        'reading'
    );

    $args = get_option('summary_settings', true);

    // add_settings_field(
    //     'summary_settings',
    //     null,
    //     'summary_settings_callback',
    //     'reading',
    //     'summary_settings_section',
    //     $args
    // );

    add_settings_field(
        'summary_length',
        'Summary Length',
        'summary_length_callback',
        'reading',
        'summary_settings_section',
        $args
    );

    add_settings_field(
        'summary_read_more',
        'Summary Read More Text',
        'summary_read_more_callback',
        'reading',
        'summary_settings_section',
        $args
    );

    register_setting("reading", "summary_settings");

}
add_action('admin_init', 'bswp_summary_settings');
