<?php

namespace AvadaChild\fns\enqueues;

function enqueue_scripts(){
  wp_dequeue_style( 'avada-dynamic-css' );
  wp_enqueue_style( 'avada-child', get_stylesheet_directory_uri() . '/lib/css/main.css', null, filemtime( get_stylesheet_directory() . '/lib/css/main.css' ) );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts', 20 );