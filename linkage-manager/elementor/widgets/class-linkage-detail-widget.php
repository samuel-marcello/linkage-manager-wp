<?php
/**
 * Linkage Detail Widget for Elementor.
 *
 * @since      1.0.1
 */

/**
 * Linkage Detail Widget class.
 */
class Linkage_Detail_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'linkage_detail';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Linkage Detail', 'linkage-manager' );
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-post';
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
            'not_found_message',
            array(
                'label'       => __( 'Not Found Message', 'linkage-manager' ),
                'type'        => \Elementor\Controls_Manager::TEXT,
                'default'     => __( 'Linkage not found.', 'linkage-manager' ),
                'placeholder' => __( 'Enter your message here', 'linkage-manager' ),
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
            'description_color',
            array(
                'label'     => __( 'Description Color', 'linkage-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .linkage-description' => 'color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            array(
                'name'     => 'description_typography',
                'label'    => __( 'Description Typography', 'linkage-manager' ),
                'selector' => '{{WRAPPER}} .linkage-description',
            )
        );

        $this->add_control(
            'container_bg_color',
            array(
                'label'     => __( 'Container Background', 'linkage-manager' ),
                'type'      => \Elementor\Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .linkage-detail-container' => 'background-color: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            array(
                'name'     => 'container_border',
                'label'    => __( 'Container Border', 'linkage-manager' ),
                'selector' => '{{WRAPPER}} .linkage-detail-container',
            )
        );

        $this->add_control(
            'container_border_radius',
            array(
                'label'      => __( 'Border Radius', 'linkage-manager' ),
                'type'       => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} .linkage-detail-container' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'container_box_shadow',
                'label'    => __( 'Box Shadow', 'linkage-manager' ),
                'selector' => '{{WRAPPER}} .linkage-detail-container',
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
            'not_found_message' => $settings['not_found_message'],
        );
        
        // Get shortcode instance
        $shortcodes = new Linkage_Shortcodes();
        
        // Output the shortcode content
        echo $shortcodes->linkage_detail_shortcode( $atts );
    }

    /**
     * Render widget output in the editor.
     */
    protected function _content_template() {
        ?>
        <div class="elementor-linkage-detail-placeholder">
            <h3><?php _e( 'Linkage Detail', 'linkage-manager' ); ?></h3>
            <p><?php _e( 'Linkage detail will be displayed here.', 'linkage-manager' ); ?></p>
        </div>
        <?php
    }
}
