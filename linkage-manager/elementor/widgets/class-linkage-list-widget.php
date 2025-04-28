<?php
/**
 * Linkage List Widget for Elementor.
 *
 * @since      1.0.1
 */

/**
 * Linkage List Widget class.
 */
class Linkage_List_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'linkage_list';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Linkage List', 'linkage-manager' );
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-grid';
    }

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return array( 'linkage-manager' );
    }

    /**
     * Register widget controls.
     */
    protected function _register_controls() {
        $this->start_controls_section(
            'section_content',
            array(
                'label' => __( 'Content', 'linkage-manager' ),
            )
        );

        $this->add_control(
            'category',
            array(
                'label'   => __( 'Category', 'linkage-manager' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => array(
                    ''        => __( 'All', 'linkage-manager' ),
                    'public'  => __( 'Public', 'linkage-manager' ),
                    'private' => __( 'Private', 'linkage-manager' ),
                ),
            )
        );

        $this->add_control(
            'layout',
            array(
                'label'   => __( 'Layout', 'linkage-manager' ),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 'grid',
                'options' => array(
                    'grid' => __( 'Grid', 'linkage-manager' ),
                    'list' => __( 'List', 'linkage-manager' ),
                ),
            )
        );

        $this->add_control(
            'columns',
            array(
                'label'     => __( 'Columns', 'linkage-manager' ),
                'type'      => \Elementor\Controls_Manager::SELECT,
                'default'   => '3',
                'options'   => array(
                    '2' => '2',
                    '3' => '3',
                    '4' => '4',
                ),
                'condition' => array(
                    'layout' => 'grid',
                ),
            )
        );

        $this->add_control(
            'details_page',
            array(
                'label'       => __( 'Details Page URL', 'linkage-manager' ),
                'type'        => \Elementor\Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'linkage-manager' ),
                'default'     => array(
                    'url' => '',
                ),
                'label_block' => true,
            )
        );

        $this->end_controls_section();

        // Style section
        $this->start_controls_section(
            'section_style',
            array(
                'label' => __( 'Style', 'linkage-manager' ),
                'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'     => __( 'Title Color', 'linkage-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .linkage-title' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'label'    => __( 'Title Typography', 'linkage-manager' ),
                'selector' => '{{WRAPPER}} .linkage-title',
            )
        );

        $this->add_control(
            'item_bg_color',
            array(
                'label'     => __( 'Item Background', 'linkage-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .linkage-item' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            array(
                'name'     => 'item_border',
                'label'    => __( 'Item Border', 'linkage-manager' ),
                'selector' => '{{WRAPPER}} .linkage-item',
            )
        );

        $this->add_control(
            'item_border_radius',
            array(
                'label'      => __( 'Border Radius', 'linkage-manager' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .linkage-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'item_box_shadow',
                'label'    => __( 'Box Shadow', 'linkage-manager' ),
                'selector' => '{{WRAPPER}} .linkage-item',
            )
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        
        // Prepare shortcode attributes
        $atts = array(
            'category' => $settings['category'],
            'layout'   => $settings['layout'],
            'columns'  => $settings['columns'],
        );
        
        // Add details page URL if set
        if ( ! empty( $settings['details_page']['url'] ) ) {
            $atts['details_page'] = $settings['details_page']['url'];
        }
        
        // Get shortcode instance
        $shortcodes = new Linkage_Shortcodes();
        
        // Output the shortcode content
        echo $shortcodes->linkage_list_shortcode( $atts );
    }

    /**
     * Render widget output in the editor.
     */
    protected function _content_template() {
        ?>
        <div class="elementor-linkage-list-placeholder">
            <h3><?php _e( 'Linkage List', 'linkage-manager' ); ?></h3>
            <p><?php _e( 'Linkage list will be displayed here.', 'linkage-manager' ); ?></p>
        </div>
        <?php
    }
}
