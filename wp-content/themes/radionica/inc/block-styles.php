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

register_block_style(
	'core/heading',
	array(
		'name'         => 'allcaps-heading',
		'label'        => __( 'Caps Heading', 'textdomain' ),
		'inline_style' => '.wp-block-heading.is-style-allcaps-heading { text-transform: uppercase; }',
	)
);
