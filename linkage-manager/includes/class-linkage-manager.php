<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * @since      1.0.0
 */
class Linkage_Manager {

    /**
     * The loader that's responsible for maintaining and registering all hooks that power
     * the plugin.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Linkage_Post_Type    $post_type    Maintains the custom post type.
     */
    protected $post_type;

    /**
     * The meta boxes handler.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Linkage_Meta_Boxes    $meta_boxes    Handles the meta boxes.
     */
    protected $meta_boxes;

    /**
     * The shortcodes handler.
     *
     * @since    1.0.0
     * @access   protected
     * @var      Linkage_Shortcodes    $shortcodes    Handles the shortcodes.
     */
    protected $shortcodes;

    /**
     * Define the core functionality of the plugin.
     *
     * @since    1.0.0
     */
    public function __construct() {
        $this->load_dependencies();
    }

    /**
     * Load the required dependencies for this plugin.
     *
     * @since    1.0.0
     * @access   private
     */
    private function load_dependencies() {
        /**
         * The class responsible for defining the custom post type.
         */
        require_once LINKAGE_MANAGER_PLUGIN_DIR . 'includes/class-linkage-post-type.php';
        $this->post_type = new Linkage_Post_Type();

        /**
         * The class responsible for defining the meta boxes.
         */
        require_once LINKAGE_MANAGER_PLUGIN_DIR . 'includes/class-linkage-meta-boxes.php';
        $this->meta_boxes = new Linkage_Meta_Boxes();

        /**
         * The class responsible for defining the shortcodes.
         */
        require_once LINKAGE_MANAGER_PLUGIN_DIR . 'includes/class-linkage-shortcodes.php';
        $this->shortcodes = new Linkage_Shortcodes();

        /**
         * The class responsible for defining all actions that occur in the admin area.
         */
        require_once LINKAGE_MANAGER_PLUGIN_DIR . 'admin/class-linkage-admin.php';
        new Linkage_Admin();

        /**
         * The class responsible for defining all actions that occur in the public-facing
         * side of the site.
         */
        require_once LINKAGE_MANAGER_PLUGIN_DIR . 'public/class-linkage-public.php';
        new Linkage_Public();
    }

    /**
     * Run the plugin.
     *
     * @since    1.0.0
     */
    public function run() {
        // Register the custom post type
        add_action( 'init', array( $this->post_type, 'register_post_type' ) );
        
        // Register meta boxes
        add_action( 'add_meta_boxes', array( $this->meta_boxes, 'register_meta_boxes' ) );
        add_action( 'save_post', array( $this->meta_boxes, 'save_meta_boxes' ) );
        
        // Register shortcodes
        add_action( 'init', array( $this->shortcodes, 'register_shortcodes' ) );
    }
}
