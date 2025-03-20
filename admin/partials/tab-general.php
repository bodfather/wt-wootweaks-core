<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<div class="wt-tab-content">
	<h2>General Settings</h2>
	<table class="form-table">
		<tr>
			<th><label for="wt_enable_feature">Enable Feature</label></th>
			<td>
				<input type="checkbox" 
						name="wt_plugin_options[enable_feature]" 
						id="wt_enable_feature" 
						value="1" 
						<?php checked( 1, isset( $this->options['enable_feature'] ) ? $this->options['enable_feature'] : 0 ); ?>>
				<p class="description">Enable or disable the main feature.</p>
			</td>
		</tr>
	</table>
</div>
