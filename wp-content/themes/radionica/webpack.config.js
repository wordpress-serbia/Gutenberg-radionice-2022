const defaultConfig = require( '@wordpress/scripts/config/webpack.config' );


module.exports = {
	...defaultConfig,
	entry: {
		index: './src/index.js',
		editor: './src/editor.js',
		'core-button': './src/block-styles/core-button.scss',
	},
};
