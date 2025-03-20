<?php
class WT_Wootweaks_Core_Plugin_Info {
	private function parse_readme( $readme_file ) {
		$content  = file_get_contents( $readme_file );
		$sections = array();
		$pattern  = '/==\s+(.+?)\s+==(.*?)(?=\n==\s+|\Z)/s'; // Adjusted for readme.txt format
		preg_match_all( $pattern, $content, $matches, PREG_SET_ORDER );
		foreach ( $matches as $match ) {
			$section_title            = trim( $match[1] );
			$section_content          = trim( $match[2] );
			$section_key              = strtolower( str_replace( ' ', '_', $section_title ) );
			$sections[ $section_key ] = $section_content;
		}
		return $sections;
	}

	public function plugin_info( $res, $action, $args ) {
		if ( $action !== 'plugin_information' ) {
			return $res;
		}

		if ( isset( $args->slug ) && $args->slug === 'wt-wootweaks-core' ) { // Correct slug
			$plugin_data = get_file_data(
				WOOTWEAKS_PLUGIN_DIR . 'wt-wootweaks-core.php', // Use constant
				array(
					'name'             => 'Plugin Name',
					'version'          => 'Version',
					'author'           => 'Author',
					'homepage'         => 'Plugin URI',
					'requires'         => 'Requires at Least',
					'tested'           => 'Tested Up To',
					'requires_php'     => 'Requires PHP',
					'compatible_up_to' => 'Compatible up to',
				)
			);

			$readme_path       = WOOTWEAKS_PLUGIN_DIR . 'readme.txt'; // Use readme.txt
			$sections          = file_exists( $readme_path ) ? $this->parse_readme( $readme_path ) : array();
			$last_updated      = get_option( 'wt_wootweaks_core_last_updated' ); // Unique option name
			$last_updated_date = $last_updated ? date( 'F j, Y', strtotime( $last_updated ) ) : 'March 20, 2025'; // Default date

			// Include Parsedown if needed (ensure it's in includes/parsedown/)
			if ( file_exists( WOOTWEAKS_PLUGIN_DIR . 'includes/parsedown/Parsedown.php' ) ) {
				require_once WOOTWEAKS_PLUGIN_DIR . 'includes/parsedown/Parsedown.php';
				$parsedown = new Parsedown();
				foreach ( $sections as $key => $section ) {
					$sections[ $key ] = $parsedown->text( $section );
				}
			}

			$res                   = new stdClass();
			$res->name             = $plugin_data['name'];
			$res->slug             = 'wt-wootweaks-core'; // Correct slug
			$res->version          = $plugin_data['version'] ?: '0.0.2';
			$res->author           = $plugin_data['author'] ?: 'Bodfather';
			$res->homepage         = $plugin_data['homepage'] ?: 'https://github.com/bodfather/wt-wootweaks-core';
			$res->requires         = $plugin_data['requires'] ?: '5.0';
			$res->tested           = $plugin_data['tested'] ?: '6.7';
			$res->requires_php     = $plugin_data['requires_php'] ?: '7.2';
			$res->last_updated     = $last_updated_date;
			$res->compatible_up_to = $plugin_data['compatible_up_to'] ?: '6.7';
			$res->sections         = array(
				'description'    => $sections['description'] ?? 'The core plugin for managing the WooTweaks suite.',
				'installation'   => $sections['installation'] ?? '',
				'faq'            => $sections['frequently_asked_questions'] ?? '', // Match readme.txt
				'changelog'      => $sections['changelog'] ?? '',
				'upgrade_notice' => $sections['upgrade_notice'] ?? '',
				'contributing'   => $sections['contributing'] ?? '',
			);
			$res->banners          = array( 'high' => plugins_url( 'assets/banner-772x250.jpg', WOOTWEAKS_PLUGIN_DIR . 'wt-wootweaks-core.php' ) );
			$res->icons            = array( '1x' => plugins_url( 'assets/icon-128x128.png', WOOTWEAKS_PLUGIN_DIR . 'wt-wootweaks-core.php' ) );
		}
		return $res;
	}

	public function plugin_row_meta( $links, $file ) {
		if ( plugin_basename( WOOTWEAKS_PLUGIN_DIR . 'wt-wootweaks-core.php' ) === $file ) {
			$row_meta = array(
				'github' => '<a href="https://github.com/bodfather/wt-wootweaks-core" target="_blank">GitHub</a>',
			);
			return array_merge( $links, $row_meta );
		}
		return (array) $links;
	}
}
