<?php
/**
 * The class responsible for defining the shortcodes.
 *
 * @since      1.0.0
 */
class Linkage_Shortcodes {

    /**
     * Register shortcodes.
     *
     * @since    1.0.0
     */
    public function register_shortcodes() {
        add_shortcode( 'linkage_list', array( $this, 'linkage_list_shortcode' ) );
        add_shortcode( 'linkage_detail', array( $this, 'linkage_detail_shortcode' ) );
    }

    /**
     * Callback for the linkage_list shortcode.
     *
     * @since    1.0.0
     * @param    array    $atts    Shortcode attributes.
     * @return   string            Shortcode output.
     */
    public function linkage_list_shortcode( $atts ) {
        $atts = shortcode_atts(
            array(
                'category' => '',
                'layout' => 'grid', // grid or list
                'columns' => 3,
                'details_page' => '', // URL of the details page
            ),
            $atts,
            'linkage_list'
        );

        // Query arguments
        $args = array(
            'post_type' => 'linkage',
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC',
        );

        // Filter by category if specified
        if ( ! empty( $atts['category'] ) ) {
            $args['meta_query'] = array(
                array(
                    'key' => '_linkage_category',
                    'value' => $atts['category'],
                    'compare' => '=',
                ),
            );
        }

        // Get linkages
        $linkages = new WP_Query( $args );

        // Start output buffering
        ob_start();

        if ( $linkages->have_posts() ) {
            // Container class based on layout
            $container_class = 'linkage-list-container';
            $container_class .= ' linkage-layout-' . esc_attr( $atts['layout'] );
            
            if ( 'grid' === $atts['layout'] ) {
                $container_class .= ' linkage-columns-' . intval( $atts['columns'] );
            }
            
            echo '<div class="' . esc_attr( $container_class ) . '">';
            
            while ( $linkages->have_posts() ) {
                $linkages->the_post();
                
                // Get linkage data
                $id = get_the_ID();
                $title = get_the_title();
                $category = get_post_meta( $id, '_linkage_category', true );
                $category_label = ucfirst( $category );
                
                // Item class based on category
                $item_class = 'linkage-item';
                $item_class .= ' linkage-category-' . esc_attr( $category );
                
                echo '<div class="' . esc_attr( $item_class ) . '">';
                
                // Logo/thumbnail
                if ( has_post_thumbnail() ) {
                    echo '<div class="linkage-logo">';
                    the_post_thumbnail( 'thumbnail' );
                    echo '</div>';
                }
                
                // Title
                echo '<h3 class="linkage-title">' . esc_html( $title ) . '</h3>';
                
                // Category
                echo '<div class="linkage-category-label">' . esc_html( $category_label ) . '</div>';
                
                // Details button
                $details_url = ! empty( $atts['details_page'] ) 
                    ? esc_url( $atts['details_page'] ) . '?linkage=' . $id 
                    : '?linkage=' . $id;
                
                echo '<div class="linkage-details-button">';
                echo '<a href="' . esc_url( $details_url ) . '" class="button">' . __( 'View Details', 'linkage-manager' ) . '</a>';
                echo '</div>';
                
                echo '</div>'; // .linkage-item
            }
            
            echo '</div>'; // .linkage-list-container
            
            // Reset post data
            wp_reset_postdata();
        } else {
            echo '<p class="linkage-not-found">' . __( 'No linkages found.', 'linkage-manager' ) . '</p>';
        }

        // Return the buffered output
        return ob_get_clean();
    }

    /**
     * Callback for the linkage_detail shortcode.
     *
     * @since    1.0.0
     * @param    array    $atts    Shortcode attributes.
     * @return   string            Shortcode output.
     */
    public function linkage_detail_shortcode( $atts ) {
        $atts = shortcode_atts(
            array(
                'not_found_message' => __( 'Linkage not found.', 'linkage-manager' ),
            ),
            $atts,
            'linkage_detail'
        );

        // Get linkage ID from URL parameter
        $linkage_id = isset( $_GET['linkage'] ) ? intval( $_GET['linkage'] ) : 0;

        // Start output buffering
        ob_start();

        if ( $linkage_id > 0 ) {
            // Get linkage
            $linkage = get_post( $linkage_id );

            if ( $linkage && 'linkage' === $linkage->post_type ) {
                // Get linkage data
                $title = get_the_title( $linkage );
                $description = apply_filters( 'the_content', $linkage->post_content );
                $category = get_post_meta( $linkage_id, '_linkage_category', true );
                $category_label = ucfirst( $category );

                echo '<div class="linkage-detail-container linkage-category-' . esc_attr( $category ) . '">';
                
                // Title
                echo '<h2 class="linkage-title">' . esc_html( $title ) . '</h2>';
                
                // Category
                echo '<div class="linkage-category-label">' . esc_html( $category_label ) . '</div>';
                
                // Logo
                if ( has_post_thumbnail( $linkage_id ) ) {
                    echo '<div class="linkage-logo">';
                    echo get_the_post_thumbnail( $linkage_id, 'medium' );
                    echo '</div>';
                }
                
                // Description
                echo '<div class="linkage-description">' . $description . '</div>';
                
                echo '</div>'; // .linkage-detail-container
            } else {
                echo '<p class="linkage-not-found">' . esc_html( $atts['not_found_message'] ) . '</p>';
            }
        } else {
            echo '<p class="linkage-not-found">' . esc_html( $atts['not_found_message'] ) . '</p>';
        }

        // Return the buffered output
        return ob_get_clean();
    }
}
