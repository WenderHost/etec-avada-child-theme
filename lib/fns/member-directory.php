<?php

namespace AvadaChild\fns\memberdirectory;

function member_list( $atts ){
  $args = shortcode_atts( [
    'foo' => 'bar',
  ], $atts );

  wp_enqueue_script( 'member-list' );
  wp_enqueue_style( 'datatables' );

  $table = file_get_contents( dirname( __FILE__ ) . '/../html/member-directory.html' );
  return $table;
}
add_shortcode( 'memberlist', __NAMESPACE__ . '\\member_list' );