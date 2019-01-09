<?php

namespace AvadaChild\fns\enqueues;

function enqueue_scripts(){
  wp_dequeue_style( 'avada-dynamic-css' );
  wp_enqueue_style( 'avada-child', get_stylesheet_directory_uri() . '/lib/css/main.css', null, filemtime( get_stylesheet_directory() . '/lib/css/main.css' ) );

  if( is_front_page() )
    wp_enqueue_script( 'front-page', get_stylesheet_directory_uri() . '/lib/js/front-page.js', ['jquery'], filemtime( get_stylesheet_directory() . '/lib/js/front-page.js'), true );

  wp_register_script( 'datatables', 'https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js', ['jquery'], '1.10.19', true );
  wp_register_script( 'member-list', get_stylesheet_directory_uri() . '/lib/js/member-list.js', ['datatables'], filemtime( get_stylesheet_directory() . '/lib/js/member-list.js'), true );
  wp_localize_script( 'member-list', 'wpvars', [
    'endpoint' => rest_url('memberdirectory/v1/members'),
    'nonce' => wp_create_nonce( 'wp_rest' )
  ]);
  wp_register_style( 'datatables', 'https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css', null, '1.10.19', 'all' );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts', 20 );