<?php

/**
 * Marquee widget class
 *
 */
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

defined('ABSPATH') || die();

class Rsaddon_Elementor_pro_Marquee_Widget extends \Elementor\Widget_Base {


    /**
     * Get widget name.
     *    
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name()
    {
        return 'rt-marquee';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title()
    {
        return esc_html__('RT Marquee', 'rtelements');
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }


    public function get_categories()
    {
        return ['pielements_category'];
    }

    public function get_keywords()
    {
        return ['logo', 'clients', 'brand', 'parnter', 'image'];
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__('Content Settings', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'scrl_text_style',
            [
                'label'   => esc_html__('Select Video Style', 'pielements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'pielements'),
                    'style2' => esc_html__('Style 2', 'pielements'),
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'default' => 'Watch Video',
            ]
        );

        $this->add_control(
            'text_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ text }}}',
                'default' => [
                    ['text' => 'Watch Video'],
                    ['text' => 'Watch Video'],
                    ['text' => 'Watch Video'],
                    ['text' => 'Watch Video'],
                    ['text' => 'Watch Video'],
                ]
            ]
        );


        $this->add_responsive_control(
            '_color',
            [
                'label' => esc_html__('Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-srl-style2 .scrl-marquee-text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'rtelements'),
                'name'     => '_title_typ',
                'selector' => '{{WRAPPER}} .rt-srl-style2 .scrl-marquee-text, {{WRAPPER}} .rt-srl-style1 .scrl-marquee-text',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        if (empty($settings['text_list'])) {
            return;
        } ?>

        <div class="rts-product-area-six rt-srl-<?php echo esc_html($settings['scrl_text_style']); ?>">
                <div class="rt-scrl-marquee">
                    <div class="scrl-marquee-text">
                        <?php 
                            if ( ! empty( $settings['text_list'] ) ) {
                                foreach ( $settings['text_list'] as $item ) {                                    
                                    echo esc_html( $item['text'] );
                                    
                                }
                            }
                        ?>
                    </div>
                </div>                
        </div>  
    <?php
    }
}
