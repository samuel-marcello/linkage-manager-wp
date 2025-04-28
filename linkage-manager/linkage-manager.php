<?php
/**
 * Plugin Name: Linkage Manager
 * Plugin URI: 
 * Description: A plugin to create and manage Linkages with custom fields and shortcodes.
 * Version: 1.0.0
 * Author: Samuel Marcello
 * Author URI: 
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: linkage-manager
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Currently plugin version.
 */
define( 'LINKAGE_MANAGER_VERSION', '1.0.0' );
define( 'LINKAGE_MANAGER_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'LINKAGE_MANAGER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 */
function activate_linkage_manager() {
    require_once LINKAGE_MANAGER_PLUGIN_DIR . 'includes/class-linkage-post-type.php';
    $plugin_post_type = new Linkage_Post_Type();
    $plugin_post_type->register_post_type();
    
    // Clear the permalinks after the post type has been registered.
    flush_rewrite_rules();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_linkage_manager() {
    // Unregister the post type, so the rules are no longer in memory.
    unregister_post_type( 'linkage' );
    
    // Clear the permalinks to remove our post type's rules from the database.
    flush_rewrite_rules();
}

register_activation_hook( __FILE__, 'activate_linkage_manager' );
register_deactivation_hook( __FILE__, 'deactivate_linkage_manager' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require LINKAGE_MANAGER_PLUGIN_DIR . 'includes/class-linkage-manager.php';

/**
 * Begins execution of the plugin.
 */
function run_linkage_manager() {
    $plugin = new Linkage_Manager();
    $plugin->run();
}
run_linkage_manager();
