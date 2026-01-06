<?php

/**
 * Elementor Product List.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;

defined('ABSPATH') || die();

class Rsaddon_Elementor_Pro_Product_Grid2_Widget extends \Elementor\Widget_Base
{

    /**
     * Get widget name.
     *
     * Retrieve counter widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'rts-product-lists2';
    }

    /**
     * Get widget title.
     *
     * Retrieve counter widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('RTS Porduct Grid 2', 'rsaddon');
    }

    /**
     * Get widget icon.
     *
     * Retrieve counter widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'glyph-icon flaticon-shopping-cart';
    }

    /**
     * Retrieve the list of scripts the counter widget depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.3.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */
    public function get_categories()
    {
        return ['rsaddon_category'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @since 2.1.0
     * @access public
     *
     * @return array Widget keywords.
     */
    public function get_keywords()
    {
        return ['product', 'list', 'category'];
    }

    /**
     * Register counter widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {



        $this->start_controls_section(
            'offer_content',
            [
                'label' => esc_html__('Content', 'plugin-name')
            ]
        );


        $this->add_control(
            'offer_text',
            [
                'label' => esc_html__('Offer Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('20% Off', 'plugin-name'),
                'placeholder' => esc_html__('Type your text here', 'plugin-name'),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'offer_title',
            [
                'label' => esc_html__('Title', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default title', 'plugin-name'),
                'placeholder' => esc_html__('Type your title here', 'plugin-name'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'offer_image',
            [
                'label' => esc_html__('Choose Image', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $this->add_control(
            'offer_btn_text',
            [
                'label' => esc_html__('Button Text', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Default title', 'plugin-name'),
                'placeholder' => esc_html__('Type your title here', 'plugin-name'),
                'label_block' => true,
            ]
        );


        $this->add_control(
            'offer_btn_link',
            [
                'label' => esc_html__('Link', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'plugin-name'),
                'default' => [
                    'url' => '#',
                    'is_external' => true,
                    'nofollow' => true,
                    'custom_attributes' => '',
                ],
                'label_block' => true,
            ]
        );


        $this->end_controls_section();


        // =========================Style=================================//

        $this->start_controls_section(
             'style_offer_text',
             [
                'label' => esc_html__('Offer Text', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'style_offer_text_typ',
                'selector' => '{{WRAPPER}} .single-featue-item .left-content-inner span.offer',
        
            ]
        );
        
        $this->add_control(
            'style_offer_text_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-featue-item .left-content-inner span.offer' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_offer_text_margin',
            [
                'label' => esc_html__( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .single-featue-item .left-content-inner span.offer' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'style_offer_text_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-featue-item .left-content-inner span.offer' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        
        
        $this->end_controls_section();


        $this->start_controls_section(
             'style_offer_title',
             [
                'label' => esc_html__('Title', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'style_offer_title_typ',
                'selector' => '{{WRAPPER}} .single-featue-item .left-content-inner .title',
        
            ]
        );
        
        $this->add_control(
            'style_offer_title_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-featue-item .left-content-inner .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'style_offer_title_margin',
            [
                'label' => esc_html__( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .single-featue-item .left-content-inner .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'style_offer_title_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-featue-item .left-content-inner .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        
        
        $this->end_controls_section();


        $this->start_controls_section(
             'style_offer_btn',
             [
                'label' => esc_html__('Button', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        
        
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'style_offer_btn_typography',
                'selector' => '{{WRAPPER}} .rts-btn.btn-primary',
            ]
        );

        $this->add_responsive_control(
            'style_offer_btn_border_radius',
            [
                'label'      => __('Border Radius', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rts-btn.btn-primary' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .rts-btn.btn-primary::before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'style_offer_btn_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rts-btn.btn-primary' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->add_control(
            'style_offer_btn_padding_color',
            [
                'label' => esc_html__( 'Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-btn.btn-primary' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'style_offer_btn_paddingba_color',
            [
                'label' => esc_html__( 'Background Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-btn.btn-primary::before' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'style_offer_btn_paddinghbb_color',
            [
                'label' => esc_html__( 'Hover Background Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rts-btn.btn-primary' => 'background: {{VALUE}}',
                ],
            ]
        );
        
        
        
        $this->end_controls_section();


        $this->start_controls_section(
             'style_offer_card',
             [
                'label' => esc_html__('Card', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );


        $this->add_control(
            'style_offer_card_color',
            [
                'label' => esc_html__( 'Background', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .single-featue-item' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'style_offer_card_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-featue-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control(
            'style_offer_card_border_radius',
            [
                'label'      => __('Border Radius', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .single-featue-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        
        
        
        
        $this->end_controls_section();




    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();


        ?>





        <div class="feature-item-solari-area">
            <div class="shop-container-featuer">
              

                  
                        <div class="single-featue-item">
                            <div class="left-content-inner">
                                <?php if (!empty($settings['offer_text'])) :   ?>
                                    <span class="offer"><?php echo esc_html($settings['offer_text']) ?></span>
                                <?php endif ?>
                                <a href="<?php echo esc_url($settings['offer_btn_link']['url']) ?>">
                                    <h5 class="title">
                                        <?php echo wp_kses($settings['offer_title'], wp_kses_allowed_html('post'))  ?>
                                        <h5 />
                                </a>
                                <?php if (!empty($settings['offer_btn_text'])) :   ?>
                                    <a href="<?php echo esc_url($settings['offer_btn_link']['url']) ?>" class="rts-btn btn-primary">
                                        <?php echo esc_html($settings['offer_btn_text']) ?>
                                    </a>
                                <?php endif ?>

                            </div>
                            <div class="right-img-area">
                                <?php if (!empty($settings['offer_image']['url'])) :   ?>
                                    <img src="<?php echo esc_url($settings['offer_image']['url']) ?>" alt="shop">
                                <?php endif ?>
                            </div>
                        </div>
               
            </div>
        </div>





<?php

    }
}
