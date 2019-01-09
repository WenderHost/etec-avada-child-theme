<?php

namespace AvadaChild\fns\restapi;

add_action( 'rest_api_init', function(){
  register_rest_route( 'memberdirectory/v1', '/members', [
    'methods'   => 'GET',
    'callback'  => __NAMESPACE__ . '\\member_directory_json',
    'permission_callback' => __NAMESPACE__ . '\\member_directory_permissions_check',
  ]);
});

function member_directory_json(){
  $users_query_args = [
    'role'      => 'subscriber',
    'order'     => 'ASC',
    'orderby'   => 'meta_value',
    'meta_key'  => 'nickname',
  ];
  $users = get_users( $users_query_args );

  $members = [];
  if( $users ){
    $x = 1;
    foreach( $users as $user ){
      $user_meta = get_user_meta( $user->ID );

      $url = $user->user_url;
      $address = str_replace(['http://','https://'], '', $url );
      if( '/' == substr( $address, -1 ) )
        $address = substr( $address, 0, -1);

      $member = [
        'id' => $x,
        'company'     => $user->display_name,
        'description' => ( isset( $user_meta['description'][0] ) && ! empty( $user_meta['description'][0] ) )? $user_meta['description'][0] : null,
        'website' => [
          'url'     => ( ! empty( $url ) )? $url : null,
          'address' => ( ! empty( $address ) )? $address : null,
        ],
        'address' => [
          'street'  => $user_meta['addr1'][0],
          'city'    => $user_meta['city'][0],
          'state'   => $user_meta['thestate'][0],
          'zip'     => $user_meta['zip'][0],
        ],
        'primary_contact' => [
          'name'  => ( isset( $user_meta['first_name'][0] ) && ! empty( $user_meta['first_name'][0] ) )? $user_meta['first_name'][0] . ' ' .$user_meta['last_name'][0] : null,
          'first_name' => ( isset( $user_meta['first_name'][0] ) && ! empty( $user_meta['first_name'][0] ) )? $user_meta['first_name'][0] : null,
          'last_name' => ( isset( $user_meta['last_name'][0] ) && ! empty( $user_meta['last_name'][0] ) )? $user_meta['last_name'][0] : null,
          'title' => ( isset( $user_meta['Title'][0] ) && ! empty( $user_meta['Title'][0] ) )? $user_meta['Title'][0] : null,
          'email' => ( isset( $user->user_email ) && ! empty( $user->user_email ) )? $user->user_email : null,
          'phone' => ( isset( $user_meta['phone1'][0] ) && ! empty( $user_meta['phone1'][0] ) )? $user_meta['phone1'][0] : null,
          'cell'  => ( isset( $user_meta['Cell_Phone'][0] ) && ! empty( $user_meta['Cell_Phone'][0] ) )? $user_meta['Cell_Phone'][0] : null,
        ],
        'alt_contact' => [
          'name'  => ( isset( $user_meta['alt_contact'][0] ) && ! empty( $user_meta['alt_contact'][0] ) )? $user_meta['alt_contact'][0] : null,
          'title' => ( isset( $user_meta['AlternateContactTitle'][0] ) && ! empty( $user_meta['AlternateContactTitle'][0] ) )? $user_meta['AlternateContactTitle'][0] : null,
          'email' => ( isset( $user_meta['alt_email'][0] ) && ! empty( $user_meta['alt_email'][0] ) )? $user_meta['alt_email'][0] : null,
          'phone' => ( isset( $user_meta['alt_phone'][0] ) && ! empty( $user_meta['alt_phone'][0] ) )? $user_meta['alt_phone'][0] : null,
        ]
      ];
      $members[] = $member;
      $x++;
    }
  }
  return rest_ensure_response( $members );
}

function member_directory_permissions_check(){
  if( ! current_user_can( 'read' ) )
    return new \WP_Error( 'rest_forbidden', 'You do not have permission to view this resource.' );

  return true;
}