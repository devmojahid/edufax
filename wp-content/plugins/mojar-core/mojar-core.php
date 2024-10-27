<?php

/**
 * Plugin Name: Mojar Core
 * Description:	Mojar Core is a plugin that adds custom post types, custom fields, and custom taxonomies to the WordPress admin.
 * Plugin URI:  https://mojar.io/
 * Version:     1.0.0
 * Author:      Mojahidul Islam
 * Author URI:  https://github.com/devmojahid
 * Text Domain: mscore
 * Elementor tested up to: 3.15.3
 */



if (!defined('ABSPATH')) exit; // Exit if accessed directly

// Load Composer autoloader
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
	require __DIR__ . '/vendor/autoload.php';
}

use Elementor\Controls_Manager;

/**
 * Define
 */
define('MSCORE_ADDONS_URL', plugins_url('/', __FILE__));
define('MSCORE_ADDONS_DIR', dirname(__FILE__));
define('MSCORE_ADDONS_PATH', plugin_dir_path(__FILE__));
define('MSCORE_ELEMENTS_PATH', MSCORE_ADDONS_DIR . '/include/elementor');
define('MSCORE_WIDGET_PATH', MSCORE_ADDONS_DIR . '/include/widgets');
define('MSCORE_INCLUDE_PATH', MSCORE_ADDONS_DIR . '/include');
define('MS_API_URL', 'http://mojar.com/elementor-block/');
define('MS_EXT_LOGO_URL', MSCORE_ADDONS_URL . 'include/elementor/templates/img/logo-black.svg');
define('MS_EXT_LOGO_ICON_URL', MSCORE_ADDONS_URL . 'assets/img/logo.png');
define('MS_ADDONS_FILE_', __FILE__);
define('MS_ADDONS_VERSION_', '3.1.3');


/**
 * 
 * Elementor blocks
 */


if (did_action('elementor/loaded')) {
	include_once(MSCORE_ADDONS_DIR . '/include/elementor/templates/api.php');
	include_once(MSCORE_ADDONS_DIR . '/include/elementor/templates/init.php');
	include_once(MSCORE_ADDONS_DIR . '/include/elementor/templates/import.php');
	include_once(MSCORE_ADDONS_DIR . '/include/elementor/templates/load.php');


	\MS_ELEMENTOR\Templates\MS_Templates::instance()->init();
	\MS_ELEMENTOR\Templates\MS_Import::instance()->load();
	\MS_ELEMENTOR\Templates\MS_Load::instance()->load();
}


/**
 * Include all files
 */
include_once(MSCORE_ADDONS_DIR . '/include/custom-post-header.php');
include_once(MSCORE_ADDONS_DIR . '/include/custom-post-footer.php');
// include_once(MSCORE_ADDONS_DIR . '/include/custom-post-portfolio.php');
// include_once(MSCORE_ADDONS_DIR . '/include/custom-post-services.php');
include_once(MSCORE_ADDONS_DIR . '/include/common-functions.php');
include_once(MSCORE_ADDONS_DIR . '/include/class-ocdi-importer.php');
include_once(MSCORE_ADDONS_DIR . '/include/allow-svg.php');

include_once(plugin_dir_path(__FILE__) . '/include/post-view.php');

include_once(plugin_dir_path(__FILE__) . '/include/ms-el-woo.php');

function edufax_coupon_init()
{
	if (class_exists('WooCommerce')) {
		include_once(plugin_dir_path(__FILE__) . '/include/ms-woo.php');
	}
}
add_action('init', 'edufax_coupon_init');

include_once(MSCORE_ADDONS_DIR . '/include/menu/menu.php');

/**
 * MS Custom Widget
 */
include_once(MSCORE_WIDGET_PATH . '/ms-blog-post-sidebar.php');
include_once(MSCORE_WIDGET_PATH . '/ms-populer-course-single.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-latest-posts-footer.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-footer-post-no-thumb.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-footer-post-thumb.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-sidebar-form-widget.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-portfolio-info-widget.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-service-list.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-service-contact.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-subscriber-widget.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-subscriber2-widget.php');
// include_once(MSCORE_WIDGET_PATH . '/ms-subscriber3-widget.php');




/**
 * Main Ms Core Class
 *
 * The init class that runs the Hello World plugin.
 * Intended To make sure that the plugin's minimum requirements are met.
 *
 * You should only modify the constants to match your plugin's needs.
 *
 * Any custom code should go inside Plugin Class in the plugin.php file.
 * @since 1.2.0
 */
final class MS_Core
{

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 * @var string The plugin version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.2.0
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.2.0
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct()
	{

		// Init Plugin
		add_action('plugins_loaded', array($this, 'init'));
	}

	/**
	 * Initialize the plugin
	 *
	 * Validates that Elementor is already loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed include the plugin class.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.2.0
	 * @access public
	 */
	public function init()
	{

		// Check if Elementor installed and activated
		if (!did_action('elementor/loaded')) {
			add_action('admin_notices', array($this, 'admin_notice_missing_main_plugin'));
			return;
		}

		// Check for required Elementor version
		if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
			add_action('admin_notices', array($this, 'admin_notice_minimum_elementor_version'));
			return;
		}

		// Check for required PHP version
		if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
			add_action('admin_notices', array($this, 'admin_notice_minimum_php_version'));
			return;
		}

		\Carbon_Fields\Carbon_Fields::boot();


		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once('plugin.php');
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'mscore'),
			'<strong>' . esc_html__('Edufax Core', 'mscore') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'mscore') . '</strong>'
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'mscore'),
			'<strong>' . esc_html__('Ms Core', 'mscore') . '</strong>',
			'<strong>' . esc_html__('Elementor', 'mscore') . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version()
	{
		if (isset($_GET['activate'])) {
			unset($_GET['activate']);
		}

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'mscore'),
			'<strong>' . esc_html__('Ms Core', 'mscore') . '</strong>',
			'<strong>' . esc_html__('PHP', 'mscore') . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
	}
}

// Instantiate MS_Core.
new MS_Core();
