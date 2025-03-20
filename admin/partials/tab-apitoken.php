<?php
// admin/partials/tab-apitoken.php
require_once WOOTWEAKS_PLUGIN_DIR . 'includes/api-token-manager.php'; // Use defined constant

if ( isset( $_GET['tab'] ) && $_GET['tab'] === 'apitoken' ) :
	$options = get_option( 'wt_plugin_options' ); // Fetch current options
	$api_key = isset( $options['api_key'] ) ? $options['api_key'] : wt_wootweaks_core_get_api_token(); // Fallback to existing token
	?>
	<div id="apitoken" class="tab-pane active">
		<h2>API Token</h2>
		<table class="form-table wt-wootweaks-settings">
			<tr>
				<th scope="row"><label for="api_key">API License Key</label></th>
				<td colspan="2">
					<input type="text" name="wt_plugin_options[api_key]" id="api_key" value="<?php echo esc_attr( $api_key ); ?>" class="regular-text">
				</td>
			</tr>
		</table>
	</div>
	<?php
endif;
?>
