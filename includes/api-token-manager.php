<?php
defined( 'ABSPATH' ) || exit;

define( 'WT_WOOTWEAKS_CORE_AUTH_IV', substr( AUTH_SALT, 0, 16 ) );

function wt_wootweaks_core_handle_api_token_submission() {
	if ( isset( $_POST['save_api_key'] ) && isset( $_POST['form_id'] ) && $_POST['form_id'] === 'wt_wootweaks_core' ) {
		if ( check_admin_referer( 'wt_wootweaks_core_save_api_key', 'wt_wootweaks_core_nonce' ) ) {
			$api_key       = sanitize_text_field( $_POST['api_key'] );
			$encrypted_key = base64_encode( openssl_encrypt( $api_key, 'aes-256-cbc', AUTH_KEY, 0, WT_WOOTWEAKS_CORE_AUTH_IV ) );
			update_option( 'wt_wootweaks_core_github_api_token', $encrypted_key );
			set_transient( 'wt_wootweaks_core_api_key_saved', true, 30 );
			// Use query parameter instead of hash
			wp_redirect( admin_url( 'admin.php?page=wt_wootweaks&tab=apitoken' ) );
			exit;
		}
	}
}
add_action( 'admin_init', 'wt_wootweaks_core_handle_api_token_submission' );

function wt_wootweaks_core_display_api_key_notice() {
	if ( get_transient( 'wt_wootweaks_core_api_key_saved' ) ) {
		echo '<div class="notice notice-success is-dismissible"><p>API Key saved!</p></div>';
		delete_transient( 'wt_wootweaks_core_api_key_saved' );
	}
}
add_action( 'admin_notices', 'wt_wootweaks_core_display_api_key_notice' );

function wt_wootweaks_core_get_api_token() {
	$encrypted_key = get_option( 'wt_wootweaks_core_github_api_token' );
	return $encrypted_key ? openssl_decrypt( base64_decode( $encrypted_key ), 'aes-256-cbc', AUTH_KEY, 0, WT_WOOTWEAKS_CORE_AUTH_IV ) : '';
}
