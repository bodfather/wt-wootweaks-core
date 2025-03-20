=== WooTweaks Core ===
Contributors: bodfather
Tags: woocommerce, tweaks, customization, admin, ecommerce
Requires at least: 5.0
Tested up to: 6.7
Stable tag: 0.0.2
Requires PHP: 7.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

The core plugin for managing the WooTweaks suite, enhancing WooCommerce with customizable settings and automatic updates.

== Description ==

WooTweaks Core serves as the foundation for the WooTweaks suite of plugins, providing a centralized admin interface to manage WooCommerce enhancements. Designed for store owners and developers, it offers a streamlined settings page with tabbed navigation and automatic updates from GitHub, including support for private repositories via encrypted API tokens.

Features include:

- Centralized management for WooTweaks suite plugins.
- Tabbed admin interface with General, API Token, and Advanced settings.
- Automatic updates via GitHub with private repo support.
- Secure API token encryption for private repository access.
- Customizable WooCommerce tweaks (expandable with additional plugins).
- Responsive admin styling with Font Awesome integration.

== Installation ==

1. Download `wt-wootweaks-core.zip` from [releases](https://github.com/bodfather/wt-wootweaks-core/releases).
2. Upload via **Plugins > Add New > Upload Plugin** in WordPress.
3. Activate the plugin from the **Plugins** menu.
4. Go to **WooTweaks** in the admin menu to configure settings.

== Frequently Asked Questions ==

= How do I update the plugin? =
The plugin auto-checks for updates from GitHub. For private repos, save a GitHub API token in the **API Token** tab.

= How do I use a private GitHub repository? =
Generate a Personal Access Token on GitHub, then enter it in the **API Token** tab under the WooTweaks settings and save.

= Can I extend this plugin with additional tweaks? =
Yes, WooTweaks Core is designed as a foundation. Add more functionality by developing companion plugins that hook into its framework.

= Where can I get support? =
Visit the [GitHub Issues page](https://github.com/bodfather/wt-wootweaks-core/issues).

== Screenshots ==

1. The WooTweaks admin dashboard with tabbed navigation.
2. API Token tab for configuring private repo updates.
3. General settings tab (placeholder for future expansions).

== Changelog ==

= 0.0.2 - 2025-03-20 =
- Added tabbed settings interface with General, API Token, and Advanced tabs.
- Integrated GitHub updater with private repo support via encrypted API tokens.
- Improved admin styling with responsive design and Font Awesome icons.
- Fixed constant naming (`WOOTWEAKS_PLUGIN_DIR` consistency).
- Laid groundwork for future WooTweaks suite expansions.

= 0.0.1 - 2025-03-15 =
- Initial release with basic plugin structure.
- Added admin menu and settings page framework.

== Upgrade Notice ==

= 0.0.2 =
Introduces a robust settings interface and automatic updates. Ensure proper file permissions with `chmod -R u=rwX,g=rwX,o=rX /var/www/html` for security.

= 0.0.1 =
Initial release—update to 0.0.2 for enhanced features and stability.

== Contributing ==

Contributions are welcome! Fork the repo, make changes, and submit a pull request to the `main` branch at [GitHub](https://github.com/bodfather/wt-wootweaks-core).