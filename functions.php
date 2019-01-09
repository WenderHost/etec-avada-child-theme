<?php

require_once( get_stylesheet_directory() . '/lib/fns/body-class.php');
require_once( get_stylesheet_directory() . '/lib/fns/enqueues.php');
require_once( get_stylesheet_directory() . '/lib/fns/js_composer.php');
require_once( get_stylesheet_directory() . '/lib/fns/member-directory.php');
require_once( get_stylesheet_directory() . '/lib/fns/rest-api.php');

function create_post_type() {
	register_post_type( 'news',
		array(
			'labels' => array(
				'name' => __( 'News Articles' ),
				'singular_name' => __( 'News Article' )
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats'),
			'can_export' => true,
		)
	);
	/*
	register_post_type( 'speakers',
		array(
			'labels' => array(
				'name' => __( 'Friday Speakers' ),
				'singular_name' => __( 'Friday Speaker' )
			),
			'public' => true,
			'has_archive' => true,
			'supports' => array('title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'page-attributes', 'post-formats'),
			'can_export' => true,
		)
	);
	register_post_type( 'press',
		array(
			'labels' => array(
				'name' => __( 'Press' ),
				'singular_name' => __( 'Press' )
			),
		'public' => true,
		'has_archive' => true,
		)
	);
	*/
}
add_action( 'init', 'create_post_type' );

register_sidebar(array(
  'name' => __( 'News Sidebar' ),
  'id' => 'news_sidebar',
  'description' => __( 'Widgets in this area will be shown on the news sidebar.' ),
  'before_title' => '<h2>',
  'after_title' => '</h2>'
));

function replace_howdy( $wp_admin_bar ) {
	$my_account=$wp_admin_bar->get_node('my-account');
	$newtitle = str_replace( 'Howdy,', 'Welcome,', $my_account->title );
	$wp_admin_bar->add_node( array(
	'id' => 'my-account',
	'title' => $newtitle,
	) );
}
add_filter( 'admin_bar_menu', 'replace_howdy',25 );

// create taxonomy for the post type "news"
function my_taxonomies_news() {
	$labels = array(
		'name'              => _x( 'News Categories', 'taxonomy general name' ),
		'singular_name'     => _x( 'News Category', 'taxonomy singular name' ),
		'search_items'      => __( 'Search News Categories' ),
		'all_items'         => __( 'All News Categories' ),
		'parent_item'       => __( 'Parent News Category' ),
		'parent_item_colon' => __( 'Parent News Category:' ),
		'edit_item'         => __( 'Edit News Category' ),
		'update_item'       => __( 'Update News Category' ),
		'add_new_item'      => __( 'Add New News Category' ),
		'new_item_name'     => __( 'New News Category' ),
		'menu_name'         => __( 'News Categories' ),
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => true,
	);
	register_taxonomy( 'news_category', 'news', $args );
}

add_action( 'init', 'my_taxonomies_news', 0 );

add_action('init', 'tribe_allow_large_joins');
function tribe_allow_large_joins(){
global $wpdb;
$wpdb->query('SET SQL_BIG_SELECTS=1');
}

?>