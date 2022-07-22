<?php

function StarterScripts () {
	if (!is_admin()) {

		$lastModifiedJS = filemtime( get_template_directory() . '/dist/index.js' );
    wp_deregister_script('app-bundle');
		wp_register_script('app-bundle', get_template_directory_uri().'/dist/index.js', false, $lastModifiedJS, true);
		wp_enqueue_script('app-bundle');
	}
}
add_action('init', 'StarterScripts');

function StarterStyles () {
  if(!is_admin()){
    
		if (file_exists( get_stylesheet_directory() . '/dist/index.css' )){
			$lastModifiedCSS = filemtime( get_template_directory() . '/dist/index.css' );
			wp_register_style( 'app', get_template_directory_uri() . '/dist/index.css', false, $lastModifiedCSS );
  		wp_enqueue_style( 'app' );
		}

  }
}
add_action('init', 'StarterStyles');

function addDeferAttributeToScripts ($tag, $handle) {
	$scriptsToDefer = array(
		'app-bundle',
		'wp-embed'
	);

	foreach($scriptsToDefer as $script) {
		if($script === $handle) {
			return str_replace(' src', ' defer src', $tag);
		}
	}

	return $tag;
}
add_filter('script_loader_tag', 'addDeferAttributeToScripts', 10, 2);