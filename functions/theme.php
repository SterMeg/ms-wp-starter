<?php 

function load_ms_theme_setup() {
    $theme_array = json_decode(file_get_contents( get_template_directory_uri() . '/theme.json', FILE_USE_INCLUDE_PATH), true);

    MS_Theme_setup::init($theme_array);
}

add_action( 'after_setup_theme', 'load_ms_theme_setup');