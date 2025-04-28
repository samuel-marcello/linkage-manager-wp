<?php
/**
 * Elementor integration for Linkage Manager.
 *
 * @since      1.0.1
 */

// If Elementor is not active, return
if ( ! did_action( 'elementor/loaded' ) ) {
    return;
}

/**
 * Linkage Elementor Integration class.
 */
class Linkage_Elementor {

    /**
     * Initialize the class.
     */
    public function __construct() {
        // Register widgets
        add_action( 'elementor/widgets/widgets_registered', array( $this, 'register_widgets' ) );
        
        // Register widget categories
        add_action( 'elementor/elements/categories_registered', array( $this, 'register_widget_categories' ) );
        
        // Enqueue styles and scripts
        add_action( 'elementor/frontend/after_enqueue_styles', array( $this, 'enqueue_styles' ) );
        add_action( 'elementor/frontend/after_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
    }

    /**
     * Register widget categories.
     *
     * @param \Elementor\Elements_Manager $elements_manager Elementor elements manager.
     */
    public function register_widget_categories( $elements_manager ) {
        $elements_manager->add_category(
            'linkage-manager',
            array(
                'title' => __( 'Linkage Manager', 'linkage-manager' ),
                'icon'  => 'fa fa-link',
            )
        );
    }

    /**
     * Register widgets.
     */
    public function register_widgets() {
        // Include widget files
        require_once LINKAGE_MANAGER_PLUGIN_DIR . 'elementor/widgets/class-linkage-list-widget.php';
        require_once LINKAGE_MANAGER_PLUGIN_DIR . 'elementor/widgets/class-linkage-detail-widget.php';
        
        // Register widgets
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Linkage_List_Widget() );
        \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Linkage_Detail_Widget() );
    }

    /**
     * Enqueue styles.
     */
    public function enqueue_styles() {
        wp_enqueue_style( 'linkage-public', LINKAGE_MANAGER_PLUGIN_URL . 'assets/css/linkage-public.css', array(), LINKAGE_MANAGER_VERSION, 'all' );
    }

    /**
     * Enqueue scripts.
     */
    public function enqueue_scripts() {
        wp_enqueue_script( 'linkage-public', LINKAGE_MANAGER_PLUGIN_URL . 'assets/js/linkage-public.js', array( 'jquery' ), LINKAGE_MANAGER_VERSION, false );
    }
}
