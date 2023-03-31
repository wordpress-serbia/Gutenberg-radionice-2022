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
	wp_enqueue_style( 'radionica-style-frontend', get_template_directory_uri() . '/build/index.css' );
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style('radionica-fonts', radionica_fonts_url(), array(), null);
}

add_action('enqueue_block_editor_assets', 'radionica_enqueue_block_assets');

function radionica_enqueue_block_assets() {
	wp_enqueue_style( 'radionica-style', get_template_directory_uri() . '/build/style-editor.css' );

	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style('radionica-fonts', radionica_fonts_url(), array(), null);

	wp_enqueue_script(
		'radionica-editor-js',
		get_template_directory_uri() . '/build/editor.js',
		array('wp-blocks', 'wp-edit-post'),
		filemtime(get_template_directory() . '/build/editor.js')
	);
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

		add_filter('should_load_separate_core_block_assets', '__return_true');

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

include_once get_template_directory() . '/inc/block-styles.php';
include_once get_template_directory() . '/inc/block-patterns.php';

function radionica_comment_form_before() {
	the_ID();
}
// add_action('comment_form_before', 'radionica_comment_form_before' );

function radionica_the_excerpt( $excerpt, $post ) {
	return $excerpt . $post->ID;
}
// add_filter('get_the_excerpt', 'radionica_the_excerpt', 10, 2 );

function radionica_register_block_type_args($args ) {

	if ('core/post-excerpt' == $args['name'] ) {
		$args['render_callback'] = 'radionica_render_block_core_post_excerpt';
	}
	if ('core/paragraph' == $args['name']) {
		$args['render_callback'] = 'radionica_render_block_core_paragraph';
	}

	return $args;
}
add_filter('register_block_type_args', 'radionica_register_block_type_args' );

function radionica_render_block_core_paragraph($attributes, $content, $block) {

	if ( $attributes['isLightbox'] ) {
		return $content . __('Is lightbox', 'radionica');
	}

	return $content;
}

function radionica_render_block_core_post_excerpt($attributes, $content, $block) {
	if (!isset($block->context['postId'])) {
		return '';
	}

	$excerpt = get_the_excerpt();

	if (empty($excerpt)) {
		return '';
	}

	$more_text           = !empty($attributes['moreText']) ? '<a class="wp-block-post-excerpt__more-link" href="' . esc_url(get_the_permalink($block->context['postId'])) . '">' . wp_kses_post($attributes['moreText']) . '</a>' : '';
	$filter_excerpt_more = function ($more) use ($more_text) {
		return empty($more_text) ? $more : '';
	};
	/**
	 * Some themes might use `excerpt_more` filter to handle the
	 * `more` link displayed after a trimmed excerpt. Since the
	 * block has a `more text` attribute we have to check and
	 * override if needed the return value from this filter.
	 * So if the block's attribute is not empty override the
	 * `excerpt_more` filter and return nothing. This will
	 * result in showing only one `read more` link at a time.
	 */
	add_filter('excerpt_more', $filter_excerpt_more);
	$classes = '';
	if (isset($attributes['textAlign'])) {
		$classes .= "has-text-align-{$attributes['textAlign']}";
	}
	$wrapper_attributes = get_block_wrapper_attributes(array('class' => $classes));

	$content               = '<p class="wp-block-post-excerpt__excerpt">' . $excerpt;
	$show_more_on_new_line = !isset($attributes['showMoreOnNewLine']) || $attributes['showMoreOnNewLine'];
	if ($show_more_on_new_line && !empty($more_text)) {
		$content .= '</p><p class="wp-block-post-excerpt__more-text">' . $more_text . '</p>';
	} else {
		$content .= " $more_text</p>";
	}

	if (is_home()) {
		$content .= '<div>' . get_the_ID() . '</div>';
	}

	remove_filter('excerpt_more', $filter_excerpt_more);
	return sprintf('<div %1$s>%2$s</div>', $wrapper_attributes, $content);
}

