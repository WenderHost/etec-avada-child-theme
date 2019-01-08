<?php

namespace AvadaChild\fns\enqueues;

function enqueue_scripts(){
  wp_dequeue_style( 'avada-dynamic-css' );
  wp_enqueue_style( 'avada-child', get_stylesheet_directory_uri() . '/lib/css/main.css', null, filemtime( get_stylesheet_directory() . '/lib/css/main.css' ) );

  if( is_front_page() )
    wp_enqueue_script( 'front-page', get_stylesheet_directory_uri() . '/lib/js/front-page.js', ['jquery'], filemtime( get_stylesheet_directory() . '/lib/js/front-page.js'), true );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts', 20 );