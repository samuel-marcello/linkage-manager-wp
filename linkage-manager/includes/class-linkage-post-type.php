<?php
/**
 * The class responsible for defining the custom post type.
 *
 * @since      1.0.0
 */
class Linkage_Post_Type {

    /**
     * Register the custom post type.
     *
     * @since    1.0.0
     */
    public function register_post_type() {
        $labels = array(
            'name'                  => _x( 'Linkages', 'Post Type General Name', 'linkage-manager' ),
            'singular_name'         => _x( 'Linkage', 'Post Type Singular Name', 'linkage-manager' ),
            'menu_name'             => __( 'Linkages', 'linkage-manager' ),
            'name_admin_bar'        => __( 'Linkage', 'linkage-manager' ),
            'archives'              => __( 'Linkage Archives', 'linkage-manager' ),
            'attributes'            => __( 'Linkage Attributes', 'linkage-manager' ),
            'parent_item_colon'     => __( 'Parent Linkage:', 'linkage-manager' ),
            'all_items'             => __( 'All Linkages', 'linkage-manager' ),
            'add_new_item'          => __( 'Add New Linkage', 'linkage-manager' ),
            'add_new'               => __( 'Add New', 'linkage-manager' ),
            'new_item'              => __( 'New Linkage', 'linkage-manager' ),
            'edit_item'             => __( 'Edit Linkage', 'linkage-manager' ),
            'update_item'           => __( 'Update Linkage', 'linkage-manager' ),
            'view_item'             => __( 'View Linkage', 'linkage-manager' ),
            'view_items'            => __( 'View Linkages', 'linkage-manager' ),
            'search_items'          => __( 'Search Linkage', 'linkage-manager' ),
            'not_found'             => __( 'Not found', 'linkage-manager' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'linkage-manager' ),
            'featured_image'        => __( 'Logo', 'linkage-manager' ),
            'set_featured_image'    => __( 'Set logo', 'linkage-manager' ),
            'remove_featured_image' => __( 'Remove logo', 'linkage-manager' ),
            'use_featured_image'    => __( 'Use as logo', 'linkage-manager' ),
            'insert_into_item'      => __( 'Insert into linkage', 'linkage-manager' ),
            'uploaded_to_this_item' => __( 'Uploaded to this linkage', 'linkage-manager' ),
            'items_list'            => __( 'Linkages list', 'linkage-manager' ),
            'items_list_navigation' => __( 'Linkages list navigation', 'linkage-manager' ),
            'filter_items_list'     => __( 'Filter linkages list', 'linkage-manager' ),
        );
        
        $args = array(
            'label'                 => __( 'Linkage', 'linkage-manager' ),
            'description'           => __( 'Linkage Description', 'linkage-manager' ),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-admin-links',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'post',
            'show_in_rest'          => true,
            'rest_base'             => 'linkages',
        );
        
        register_post_type( 'linkage', $args );
    }
}
