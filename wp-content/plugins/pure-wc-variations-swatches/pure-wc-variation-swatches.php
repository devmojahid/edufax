<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://themepure.net
 * @since             1.1.2
 * @package           Tp_Wvs
 *
 * @wordpress-plugin
 * Plugin Name:       Pure WC Variation Swatches
 * Plugin URI:        https://themepure.net/plugin/pure-variation-swatches.zip
 * Description:       Nice and easy woocommerce product color variation swatches. Design your store with more modern looks.
 * Version:           1.1.2
 * Author:            ThemePure
 * Author URI:        https://themepure.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       pure-wc-swatches
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 * Start at version 1.1.2 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'TP_WVS_VERSION', '1.1.2' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-pure-wc-swatches-activator.php
 */
if( !function_exists('activate_tp_wvs') ){
    function activate_tp_wvs() {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-pure-wc-swatches-activator.php';
        Tp_Wvs_Activator::activate();
    }
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-pure-wc-swatches-deactivator.php
 */
if( !function_exists('deactivate_tp_wvs') ){
    function deactivate_tp_wvs() {
        require_once plugin_dir_path( __FILE__ ) . 'includes/class-pure-wc-swatches-deactivator.php';
        Tp_Wvs_Deactivator::deactivate();
    }   
}
register_activation_hook( __FILE__, 'activate_tp_wvs' );
register_deactivation_hook( __FILE__, 'deactivate_tp_wvs' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-pure-wc-swatches.php';
require plugin_dir_path( __FILE__ ) . 'shortcodes/pure-wc-swatches-shortcodes.php';


if( !function_exists('pure_swatches_admin') ){
    function pure_swatches_admin(){
        if( !isset($GLOBALS['pure_swatches_admin_object']) ){
            $GLOBALS['pure_swatches_admin_object'] = new Tp_Wvs_Admin('pure-wc-swatches', '1.1.2');
        }

        return $GLOBALS['pure_swatches_admin_object'];
    }
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.1.2
 */
if( !function_exists('run_tp_wvs') ){
    function run_tp_wvs() {

        $plugin = new Tp_Wvs();
        $plugin->run();
    
    }
    run_tp_wvs();
}