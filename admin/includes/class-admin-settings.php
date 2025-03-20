<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WT_Core_Admin_Settings {
	private $options;

	public function init() {
		add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
		add_action( 'admin_init', array( $this, 'page_init' ) );
	}

	public function add_plugin_page() {
		add_menu_page(
			'WooTweaks Core Settings',  // Page title
			'WooTweaks',                // Menu title
			'manage_options',           // Capability
			'wt-wootweaks',             // Menu slug
			array( $this, 'create_admin_page' ),
			'none',
			55.5                        // Position
		);
	}

	public function create_admin_page() {
		$this->options = get_option( 'wt_plugin_options' );
		$plugin_slug   = 'wt-core';
		$tabs          = array(
			'general'  => 'General',
			'advanced' => 'Advanced',
			'apitoken' => 'API Token',

		);
		$active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'general';
		?>
		<div class="wrap wootweaks <?php echo esc_attr( $plugin_slug ); ?>">
			<div class="wootweaks-header header-wrap">
				<h1><?php echo esc_html( 'WooTweaks ' . ucfirst( str_replace( 'wt-', '', $plugin_slug ) ) . ' Settings' ); ?></h1>
			</div>
			<div class="wootweaks-content content-wrap">
				<nav class="wootweaks-tabs settings-tabs" role="tablist">
					<?php foreach ( $tabs as $tab_key => $tab_label ) : ?>
						<a href="?page=wt-wootweaks&tab=<?php echo esc_attr( $tab_key ); ?>" 
							class="nav-tab <?php echo $active_tab === $tab_key ? 'nav-tab-active' : ''; ?>"
							role="tab"
							aria-selected="<?php echo $active_tab === $tab_key ? 'true' : 'false'; ?>">
							<?php echo esc_html( $tab_label ); ?>
						</a>
					<?php endforeach; ?>
				</nav>
				<div class="wootweaks-form">
					<form method="post" action="options.php">
						<?php
						settings_fields( 'wt_plugin_option_group' );
						do_settings_sections( 'wt-wootweaks' );
						if ( array_key_exists( $active_tab, $tabs ) ) {
							include WOOTWEAKS_PLUGIN_DIR . "admin/partials/tab-{$active_tab}.php";
						}
						submit_button();
						?>
					</form>
				</div>
			</div>
		</div>
		<?php
	}

	public function page_init() {
		register_setting(
			'wt_plugin_option_group',
			'wt_plugin_options',
			array( $this, 'sanitize' )
		);
	}

	public function sanitize( $input ) {
		$sanitized_input = array();
		if ( isset( $input['api_key'] ) ) {
			$sanitized_input['api_key'] = sanitize_text_field( $input['api_key'] );
			// Optionally encrypt and store in a separate option for backward compatibility
			$encrypted_key = base64_encode( openssl_encrypt( $input['api_key'], 'aes-256-cbc', AUTH_KEY, 0, WT_WOOTWEAKS_CORE_AUTH_IV ) );
			update_option( 'wt_wootweaks_core_github_api_token', $encrypted_key );
		}
		return $sanitized_input;
	}
}
