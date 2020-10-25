<?php 

function parse_valid_args($args, $default) {
    $valid_args = array_intersect_key($args, $default);
    $args = wp_parse_args( $valid_args, $default);
    return $args;
}