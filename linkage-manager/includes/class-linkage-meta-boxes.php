<?php
/**
 * The class responsible for defining the meta boxes.
 *
 * @since      1.0.0
 */
class Linkage_Meta_Boxes {

    /**
     * Register meta boxes.
     *
     * @since    1.0.0
     */
    public function register_meta_boxes() {
        add_meta_box(
            'linkage_category',
            __( 'Linkage Category', 'linkage-manager' ),
            array( $this, 'render_category_meta_box' ),
            'linkage',
            'side',
            'default'
        );
    }

    /**
     * Render the category meta box.
     *
     * @since    1.0.0
     * @param    WP_Post    $post    The post object.
     */
    public function render_category_meta_box( $post ) {
        // Add nonce for security and authentication.
        wp_nonce_field( 'linkage_category_nonce_action', 'linkage_category_nonce' );

        // Retrieve an existing value from the database.
        $category = get_post_meta( $post->ID, '_linkage_category', true );

        // Set default value if empty.
        if ( empty( $category ) ) {
            $category = 'public';
        }

        // Form fields.
        ?>
        <p>
            <label for="linkage_category"><?php _e( 'Select Category:', 'linkage-manager' ); ?></label>
            <select name="linkage_category" id="linkage_category" class="widefat">
                <option value="public" <?php selected( $category, 'public' ); ?>><?php _e( 'Public', 'linkage-manager' ); ?></option>
                <option value="private" <?php selected( $category, 'private' ); ?>><?php _e( 'Private', 'linkage-manager' ); ?></option>
            </select>
        </p>
        <?php
    }

    /**
     * Save the meta box data.
     *
     * @since    1.0.0
     * @param    int    $post_id    The post ID.
     */
    public function save_meta_boxes( $post_id ) {
        // Check if our nonce is set.
        if ( ! isset( $_POST['linkage_category_nonce'] ) ) {
            return;
        }

        // Verify that the nonce is valid.
        if ( ! wp_verify_nonce( $_POST['linkage_category_nonce'], 'linkage_category_nonce_action' ) ) {
            return;
        }

        // If this is an autosave, our form has not been submitted, so we don't want to do anything.
        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        // Check the user's permissions.
        if ( isset( $_POST['post_type'] ) && 'linkage' == $_POST['post_type'] ) {
            if ( ! current_user_can( 'edit_post', $post_id ) ) {
                return;
            }
        }

        // Sanitize user input.
        $category = isset( $_POST['linkage_category'] ) ? sanitize_text_field( $_POST['linkage_category'] ) : 'public';

        // Update the meta field in the database.
        update_post_meta( $post_id, '_linkage_category', $category );
    }
}
