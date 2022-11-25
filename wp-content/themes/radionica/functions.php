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
	wp_enqueue_style( 'radionica-style', get_template_directory_uri() . '/build/style-index.css' );
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style('radionica-fonts', radionica_fonts_url(), array(), null);
}

add_action('enqueue_block_assets', 'radionica_enqueue_block_assets');

function radionica_enqueue_block_assets() {
	wp_enqueue_style( 'radionica-style', get_template_directory_uri() . '/build/index.css' );
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style('radionica-fonts', radionica_fonts_url(), array(), null);
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

/**
 * Register custom fonts.
 */
function radionica_fonts_url()
{
	$fonts_url = '';

	$font_families = array();

	$font_families[] = 'Island Moments:400';

	$query_args = array(
		'family'  => urlencode(implode('|', $font_families)),
		'subset'  => urlencode('latin,latin-ext'),
		'display' => urlencode('fallback'),
	);

	$fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');

	return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since Twenty Seventeen 1.0
 *
 * @param array  $urls          URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array URLs to print for resource hints.
 */
function radionica_resource_hints($urls, $relation_type)
{
	if (wp_style_is('radionica-fonts', 'queue') && 'preconnect' === $relation_type) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter('wp_resource_hints', 'radionica_resource_hints', 10, 2);
