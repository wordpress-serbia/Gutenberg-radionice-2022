<?php
/**
 * Custom block styles
 */

register_block_style(
	'core/heading',
	array(
		'name'         => 'all-caps-heading',
		'label'        => __('All Caps Heading', 'textdomain'),
		'inline_style' => '.wp-block-heading.is-style-all-caps-heading { text-transform: uppercase; }',
	)
);

// wp_register_style('custom-button-style', get_template_directory_uri() . '/build/core-button.css');

register_block_style(
	'core/button',
	array(
		'name'         => 'djurino-dugme',
		'label'        => __('Djurino dugme', 'textdomain'),
		'style_handle' => 'wp-block-button',
	)
);

/**
 * Attach extra styles to multiple blocks.
 *
 * https://make.wordpress.org/core/2021/07/01/block-styles-loading-enhancements-in-wordpress-5-8/
 */
function my_theme_enqueue_block_styles()
{
	// An array of blocks.
	$styled_blocks = ['button'];

	foreach ($styled_blocks as $block_name) {
		// Get the stylesheet handle. This is backwards-compatible and checks the
		// availability of the `wp_should_load_separate_core_block_assets` function,
		// and whether we want to load separate styles per-block or not.
		$handle = (function_exists('wp_should_load_separate_core_block_assets') &&
			wp_should_load_separate_core_block_assets()
		) ? "wp-block-$block_name" : 'wp-block-library';

		// Get the styles.
		$styles = file_get_contents(get_theme_file_path("build/core-$block_name.css"));

		// Add frontend styles.
		wp_add_inline_style($handle , $styles);

		// Add editor styles.
		// add_editor_style("build/core-$block_name.css");
		if (file_exists(get_theme_file_path("build/core-$block_name.css"))) {
			add_editor_style("build/core-$block_name.css");
			// wp_enqueue_style($handle, get_template_directory_uri(). "build/core-$block_name.css" );
		}
	}
}
// Add frontend styles.
add_action('wp_enqueue_scripts', 'my_theme_enqueue_block_styles');
// Add editor styles.
add_action('admin_init', 'my_theme_enqueue_block_styles');
// add_action('enqueue_block_editor_assets', 'my_theme_enqueue_block_styles');


