<?php
/*
Plugin Name: Sample Gutenberg Block
Plugin URI: https://mintplugins.com
Description: A sample Gutenberg Block
Version: 1.0
Author: Phil Johnston
Author URI: https://mintplugins.com
Text Domain: sample-gutenberg-block
Domain Path: languages
License: GPL2
*/

function my_block_editor_scripts(){

	// Required things to build Gutenberg Blocks
	$required_scripts = array(
		'wp-blocks',
		'wp-i18n',
		'wp-element',
		'wp-components',
		'wp-editor'
	);

	// Add Babel File
	wp_enqueue_script( 'babel', 'https://unpkg.com/babel-standalone@6/babel.min.js', $required_scripts );
	$required_scripts[] = 'babel';

	// Gutenberg Block JSX code
	wp_register_script( 'my-custom-script', plugin_dir_url( __FILE__ ) . 'sample-gutenberg-block.js', $required_scripts, time() );

	register_block_type( 'mynamespace/mycustomblock', array(
	 	'script' => 'my-custom-script',
	) );
}
add_action( 'init', 'my_block_editor_scripts' );

// This allows us to use JSX by changing it to text/babel
function my_block_editor_modify_jsx_tag( $tag, $handle, $src ) {

	// Convert the custom block file to be recognized as a JSX file
	if ( 'my-custom-script' == $handle ) {
		$tag = str_replace( "<script type='text/javascript'", "<script type='text/babel'", $tag );
	}

	return $tag;
}
add_filter( 'script_loader_tag', 'my_block_editor_modify_jsx_tag', 10, 3 );
