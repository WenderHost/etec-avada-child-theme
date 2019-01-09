<?php

namespace AvadaChild\fns\bodyclass;

/**
 * Add classes to body_class()
 *
 * @param      array  $classes  Classes for body_class()
 *
 * @return     array  Modified $classes for body_class()
 */
function add_body_classes( $classes ){
  // Add .page-slug and .light since we're not adding $avada_color_scheme inside header.php
  global $post;
  $extra_classes = ['light', $post->post_name];

  if( is_page_template( 'blank.php' ) )
    $extra_classes[] = 'body_blank';

  if( is_front_page() )
    $extra_classes[] = 'front-page';

  return array_merge( $classes, $extra_classes );
}
add_filter( 'body_class', __NAMESPACE__ . '\\add_body_classes' );