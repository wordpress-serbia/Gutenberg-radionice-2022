<?php
/**
 * Custom block styles
 */

function radionica_enqueue_block_editor_assets() {
	wp_enqueue_script(
		'radionica-block-styles',
		get_template_directory_uri() . '/build/index.js',
		array( 'wp-blocks', 'wp-edit-post' ),
		filemtime(get_template_directory_uri() . '/build/index.js')
	);
}
add_action( 'enqueue_block_editor_assets', 'radionica_enqueue_block_editor_assets' );
