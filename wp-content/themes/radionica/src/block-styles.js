import { unregisterBlockStyle, registerBlockStyle } from "@wordpress/blocks";

document.addEventListener('DOMContentLoaded', () => {
	unregisterBlockStyle( 'core/quote', 'plain' );

	registerBlockStyle( 'core/paragraph', {
    	name: 'djurin-paragraf',
    	label: 'Djurin paragraf'
	} );
});
