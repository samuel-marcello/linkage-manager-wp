<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @since      1.0.0
 */
class Linkage_Admin {

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
        // Enqueue admin styles and scripts
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        
        // Add admin menu
        add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
        
        // Add admin notices
        add_action( 'admin_notices', array( $this, 'admin_notices' ) );
        
        // Add custom columns to the linkage post type list
        add_filter( 'manage_linkage_posts_columns', array( $this, 'set_custom_columns' ) );
        add_action( 'manage_linkage_posts_custom_column', array( $this, 'custom_column_content' ), 10, 2 );
        
        // Add filter dropdown for category
        add_action( 'restrict_manage_posts', array( $this, 'add_category_filter' ) );
        add_filter( 'parse_query', array( $this, 'filter_by_category' ) );
    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {
        // Only enqueue on linkage post type pages
        $screen = get_current_screen();
        if ( $screen && ( 'linkage' === $screen->post_type || 'linkage_page_linkage-manager-settings' === $screen->id ) ) {
            wp_enqueue_style( 'linkage-admin', LINKAGE_MANAGER_PLUGIN_URL . 'assets/css/linkage-admin.css', array(), LINKAGE_MANAGER_VERSION, 'all' );
        }
    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {
        // Only enqueue on linkage post type pages
        $screen = get_current_screen();
        if ( $screen && ( 'linkage' === $screen->post_type || 'linkage_page_linkage-manager-settings' === $screen->id ) ) {
            wp_enqueue_script( 'linkage-admin', LINKAGE_MANAGER_PLUGIN_URL . 'assets/js/linkage-admin.js', array( 'jquery' ), LINKAGE_MANAGER_VERSION, false );
        }
    }

    /**
     * Add admin menu items.
     *
     * @since    1.0.0
     */
    public function add_admin_menu() {
        add_submenu_page(
            'edit.php?post_type=linkage',
            __( 'Linkage Manager Settings', 'linkage-manager' ),
            __( 'Settings', 'linkage-manager' ),
            'manage_options',
            'linkage-manager-settings',
            array( $this, 'display_settings_page' )
        );
    }

    /**
     * Display the settings page.
     *
     * @since    1.0.0
     */
    public function display_settings_page() {
        include_once LINKAGE_MANAGER_PLUGIN_DIR . 'admin/partials/linkage-admin-settings.php';
    }

    /**
     * Display admin notices.
     *
     * @since    1.0.0
     */
    public function admin_notices() {
        // Display notices if needed
    }

    /**
     * Set custom columns for the linkage post type.
     *
     * @since    1.0.0
     * @param    array    $columns    The existing columns.
     * @return   array                The modified columns.
     */
    public function set_custom_columns( $columns ) {
        $new_columns = array();
        
        // Insert columns after title
        foreach ( $columns as $key => $value ) {
            $new_columns[ $key ] = $value;
            
            if ( 'title' === $key ) {
                $new_columns['thumbnail'] = __( 'Logo', 'linkage-manager' );
                $new_columns['category'] = __( 'Category', 'linkage-manager' );
            }
        }
        
        return $new_columns;
    }

    /**
     * Display content for custom columns.
     *
     * @since    1.0.0
     * @param    string    $column     The column name.
     * @param    int       $post_id    The post ID.
     */
    public function custom_column_content( $column, $post_id ) {
        switch ( $column ) {
            case 'thumbnail':
                if ( has_post_thumbnail( $post_id ) ) {
                    echo get_the_post_thumbnail( $post_id, array( 50, 50 ) );
                } else {
                    echo '—';
                }
                break;
                
            case 'category':
                $category = get_post_meta( $post_id, '_linkage_category', true );
                echo ucfirst( $category );
                break;
        }
    }

    /**
     * Add category filter dropdown to the linkage post type list.
     *
     * @since    1.0.0
     */
    public function add_category_filter() {
        global $typenow;
        
        if ( 'linkage' === $typenow ) {
            $selected = isset( $_GET['linkage_category'] ) ? $_GET['linkage_category'] : '';
            ?>
            <select name="linkage_category">
                <option value=""><?php _e( 'All Categories', 'linkage-manager' ); ?></option>
                <option value="public" <?php selected( $selected, 'public' ); ?>><?php _e( 'Public', 'linkage-manager' ); ?></option>
                <option value="private" <?php selected( $selected, 'private' ); ?>><?php _e( 'Private', 'linkage-manager' ); ?></option>
            </select>
            <?php
        }
    }

    /**
     * Filter linkages by category.
     *
     * @since    1.0.0
     * @param    WP_Query    $query    The query object.
     */
    public function filter_by_category( $query ) {
        global $pagenow, $typenow;
        
        if ( 'edit.php' === $pagenow && 'linkage' === $typenow && isset( $_GET['linkage_category'] ) && ! empty( $_GET['linkage_category'] ) ) {
            $query->query_vars['meta_key'] = '_linkage_category';
            $query->query_vars['meta_value'] = sanitize_text_field( $_GET['linkage_category'] );
        }
    }
}
