<?php
/**
 * Provide a admin area view for the plugin settings
 *
 * @since      1.0.0
 */
?>

<div class="wrap">
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
    
    <div class="linkage-manager-settings">
        <h2><?php _e( 'Shortcode Usage', 'linkage-manager' ); ?></h2>
        
        <div class="linkage-manager-shortcode-info">
            <h3><?php _e( 'Linkage List Shortcode', 'linkage-manager' ); ?></h3>
            <p><?php _e( 'Use this shortcode to display a list of all linkages:', 'linkage-manager' ); ?></p>
            <code>[linkage_list]</code>
            
            <p><?php _e( 'Optional parameters:', 'linkage-manager' ); ?></p>
            <ul>
                <li><code>category</code> - <?php _e( 'Filter by category (public or private)', 'linkage-manager' ); ?></li>
                <li><code>layout</code> - <?php _e( 'Display layout (grid or list, default: grid)', 'linkage-manager' ); ?></li>
                <li><code>columns</code> - <?php _e( 'Number of columns for grid layout (default: 3)', 'linkage-manager' ); ?></li>
                <li><code>details_page</code> - <?php _e( 'URL of the details page (default: current page)', 'linkage-manager' ); ?></li>
            </ul>
            
            <p><?php _e( 'Example with parameters:', 'linkage-manager' ); ?></p>
            <code>[linkage_list category="public" layout="grid" columns="4" details_page="https://example.com/linkage-details"]</code>
            
            <h3><?php _e( 'Linkage Detail Shortcode', 'linkage-manager' ); ?></h3>
            <p><?php _e( 'Use this shortcode on your details page to display a single linkage:', 'linkage-manager' ); ?></p>
            <code>[linkage_detail]</code>
            
            <p><?php _e( 'Optional parameters:', 'linkage-manager' ); ?></p>
            <ul>
                <li><code>not_found_message</code> - <?php _e( 'Custom message to display when no linkage is found', 'linkage-manager' ); ?></li>
            </ul>
            
            <p><?php _e( 'Example with parameters:', 'linkage-manager' ); ?></p>
            <code>[linkage_detail not_found_message="Sorry, the requested linkage could not be found."]</code>
        </div>
    </div>
</div>
