<?php
/**
 * Post meta Gutenberg plugin
 */

// register custom meta tag field
function radionica_register_post_meta() {
    register_post_meta( 'post', '_radionica_meta_smiley', array(
        'show_in_rest' => true,
        'single' => true,
        'type' => 'string',
		'auth_callback' => function() {
			return current_user_can('edit_posts');
		}
    ) );
}
add_action( 'init', 'radionica_register_post_meta' );
