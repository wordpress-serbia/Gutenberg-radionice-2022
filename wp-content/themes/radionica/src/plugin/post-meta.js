import { registerPlugin } from "@wordpress/plugins";
import { PluginSidebar, PluginSidebarMoreMenuItem } from "@wordpress/edit-post";
import { __ } from "@wordpress/i18n";
import { PanelBody, TextControl } from "@wordpress/components";
import { withSelect, withDispatch } from "@wordpress/data";

let PluginMetaFields = (props) => {
	return (
    <>
      <PanelBody
        title={__("Radionica post meta", "textdomain")}
        icon="admin-post"
        intialOpen={ true }
      >
        <TextControl
          value={props.text_metafield}
          label={__("Radionica smiley", "textdomain")}
		  onChange={(value) => props.onMetaFieldChange(value)}
        />
      </PanelBody>
    </>
  )
}

registerPlugin( 'radionica-sidebar', {
  icon: 'smiley',
  render: () => {
    return (
      <>
        <PluginSidebarMoreMenuItem
          target="radionica-sidebar"
        >
          {__('Meta Options', 'textdomain')}
        </PluginSidebarMoreMenuItem>
        <PluginSidebar
			name="radionica-sidebar"
          title={__('Meta Options', 'textdomain')}
        >
          <PluginMetaFields />
        </PluginSidebar>
      </>
    )
  }
})


PluginMetaFields = withSelect(
  (select) => {
    return {
      text_metafield: select('core/editor').getEditedPostAttribute('meta')['_radionica_meta_smiley']
    }
  }
)(PluginMetaFields);

PluginMetaFields = withDispatch(
  (dispatch) => {
    return {
      onMetaFieldChange: (value) => {
        dispatch('core/editor').editPost({meta: {_radionica_meta_smiley: value}})
      }
    }
  }
)(PluginMetaFields);
