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
wp_register_style( 'radionica-list-block-style', get_template_directory_uri() . '/src/block-styles/core-list.css');
register_block_style(
	'core/list',
	array(
		'name'         => 'list-background',
		'label'        => __( 'List Background', 'textdomain' ),
		'style_handle' => 'radionica-list-block-style',
	)
);
