import { registerBlockExtension } from '@10up/block-components';

import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl, TextControl, Button } from '@wordpress/components';
import { __ } from '@wordpress/i18n';

const newAttributes = {
    isLightbox: {
        type: 'boolean',
        default: false
    }
};

function generateClassName( attributes ) {
    const { isLightbox } = attributes;
    let className = '';
    if ( isLightbox ) {
        className = 'is-lightbox';
    }
    return className;
}

function LightboxBlockEdit( props ) {
    const { attributes, setAttributes } = props;
    const { isLightbox, items } = attributes;

    return (
		<>
			<InspectorControls>
				<PanelBody title="Lightbox Options">
					<ToggleControl
						label="Enable Lightbox"
						checked={ isLightbox }
						onChange={ value => setAttributes({ isLightbox: value }) }
					/>
				</PanelBody>
			</InspectorControls>
			{isLightbox && (
				__( 'Is lightbox', 'radionica' )
			) }
		</>
    );
}


registerBlockExtension(
    `core/paragraph`,
    {
        extensionName: 'lightbox',
        attributes: newAttributes,
        classNameGenerator: generateClassName,
        Edit: LightboxBlockEdit
    }
);

