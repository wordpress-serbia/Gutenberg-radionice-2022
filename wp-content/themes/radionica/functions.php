<?php
/**
 * Radionica Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package radionica
 */

add_action( 'wp_enqueue_scripts', 'radionica_parent_theme_enqueue_styles' );

/**
 * Enqueue scripts and styles.
 */
function radionica_parent_theme_enqueue_styles() {
	wp_enqueue_style( 'radionica-style', get_template_directory_uri() . '/style.css' );
}

if (!function_exists('radionica_support')) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * @since Twenty Twenty-Two 1.0
	 *
	 * @return void
	 */
	function radionica_support()
	{

		// Add support for block styles.
		add_theme_support('wp-block-styles');

		// Enqueue editor styles.
		add_editor_style('style.css');
	}

endif;

add_action('after_setup_theme', 'radionica_support');
