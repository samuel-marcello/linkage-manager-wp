<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 */
class Linkage_Public {

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
        // Enqueue public styles and scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        wp_enqueue_style( 'linkage-public', LINKAGE_MANAGER_PLUGIN_URL . 'assets/css/linkage-public.css', array(), LINKAGE_MANAGER_VERSION, 'all' );
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        wp_enqueue_script( 'linkage-public', LINKAGE_MANAGER_PLUGIN_URL . 'assets/js/linkage-public.js', array( 'jquery' ), LINKAGE_MANAGER_VERSION, false );
    }
}
