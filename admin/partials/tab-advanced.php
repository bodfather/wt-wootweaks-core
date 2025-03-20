<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="wt-tab-content">
	<h2>Advanced Settings</h2>
	<table class="form-table">
		<tr>
			<th><label for="wt_cache_timeout">Cache Timeout</label></th>
			<td>
				<input type="number" 
						name="wt_plugin_options[cache_timeout]" 
						id="wt_cache_timeout" 
						value="<?php echo esc_attr( isset( $this->options['cache_timeout'] ) ? $this->options['cache_timeout'] : '3600' ); ?>"
						class="small-text">
				<p class="description">Set cache timeout in seconds.</p>
			</td>
		</tr>
	</table>
</div>
