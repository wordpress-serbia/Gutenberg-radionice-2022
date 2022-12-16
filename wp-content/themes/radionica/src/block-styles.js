import { unregisterBlockStyle, registerBlockStyle } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';

document.addEventListener( 'DOMContentLoaded', () => {
	unregisterBlockStyle( 'core/quote', 'plain' );

	registerBlockStyle( 'core/paragraph', {
		name: 'fancy-paragraph',
		label: __( 'Fancy paragraph' ),
		// isDefault: true
	} );
} );
