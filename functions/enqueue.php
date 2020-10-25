<?php

function starter_enqueue_style() {
    wp_enqueue_style('styles', get_stylesheet_uri());
    wp_enqueue_style('google-fonts',  "https://fonts.googleapis.com/css2?family=Lora&family=Raleway&display=swap", false);
}

function starter_enqueue_scripts() {
    wp_enqueue_script(
        'scripts', 
        get_template_directory_uri() . '/js/main.min.js',
        array( 'jquery'),
        null,
        true
    );
    wp_enqueue_script(
        'fontawesome',
        'https://kit.fontawesome.com/6e62decaf8.js',
    );
}

add_action( 'wp_enqueue_scripts', 'starter_enqueue_style');
add_action( 'wp_enqueue_scripts', 'starter_enqueue_scripts');

add_filter('script_loader_tag', 'font_awesome_modifier', 10, 3);

function font_awesome_modifier($tag, $handle, $src) {
    if ('fontawesome' === $handle ) {
        return '<script src="' . $src . '" crossorigin="anonymous"></script>' . "\n";
    }
    return $tag;
}