<?php 

function ms_theme_page_menu_args( $args ) {
    $args['show_home'] = true;
    return $args;
}
add_filter( 'wp_page_menu_args', 'ms_theme_page_menu_args');

function init_menus() {
    // register menus
    register_nav_menu( 'primary', __('Primary') );
    register_nav_menu( 'secondary', __('Secondary'));
    register_nav_menu( 'footer', __('Footer') );
}

add_action('init', 'init_menus');

function load_accessible_flyout_nav() {
    Accessible_Flyout_Nav::init();
}
add_action('init', 'load_accessible_flyout_nav');