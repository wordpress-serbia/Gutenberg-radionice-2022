import { unregisterBlockStyle } from '@wordpress/blocks';

document.addEventListener( 'DOMContentLoaded', () => {
	unregisterBlockStyle( 'core/quote', 'plain' );
} );
