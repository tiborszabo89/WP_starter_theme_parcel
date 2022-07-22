<?php
// Hide admin bar
show_admin_bar(false);

// Clean up the <head>
function removeHeadLinks() {
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
}
add_action('init', 'removeHeadLinks');
remove_action('wp_head', 'wp_generator');

if (function_exists('register_sidebar')) {
	register_sidebar(array(
		'name' => 'Sidebar Widgets',
		'id'   => 'sidebar-widgets',
		'description'   => 'These are widgets for the sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2>',
		'after_title'   => '</h2>'
		));
}

// Activate post thumbnails
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

// Set up basic menu locations
register_nav_menus (
	array (
		'header-menu' => __( 'Header menu' ),
		'footer-menu' => __( 'Footer menu' ),
		'left-menu' => __( 'Left menu' ),
		'right-menu' => __( 'Right menu' ),
		)
	);

include 'func/scripts_and_stylesheets.php';
