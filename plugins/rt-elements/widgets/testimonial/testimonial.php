<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Utils;


defined('ABSPATH') || die();

class ReacTheme_Elementor_Testimonial_Widget extends \Elementor\Widget_Base
{
    /**
     * Get widget name.
     *
     * Retrieve rsgallery widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'rt-testimonial';
    }

    /**
     * Get widget title.
     *
     * Retrieve rsgallery widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('RT Testimonial', 'rtelements');
    }

    /**
     * Get widget icon.
     *
     * Retrieve rsgallery widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'glyph-icon flaticon-slider-3';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the rsgallery widget belongs to.
     *
     * @since 1.0.0
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['pielements_category'];
    }

    public function get_style_depends()
    {

        wp_register_style('rtelements-style-portfolio-slider', plugins_url('portfolio-slider-css/portfolio-slider.css', __FILE__));

        return [
            'rtelements-style-portfolio-slider'
        ];
    }

    /**
     * Register rsgallery widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {
        $this->start_controls_section(
            'testimonial_content',
            [
                'label' => esc_html__('General', 'plugin-name')
            ]
        );


        // Repeater
        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'list_content',
            [
                'label' => esc_html__('Content', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::WYSIWYG,
                'default' => esc_html__('List Content', 'plugin-name'),
                'show_label' => false,
            ]
        );



        $repeater->add_control(
            'list_icon',
            [
                'label' => esc_html__('Choose Icon', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'list_name',
            [
                'label' => esc_html__('Name', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Name', 'plugin-name'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'list_designation',
            [
                'label' => esc_html__('Designation', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Designation', 'plugin-name'),
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'testi_image',
            [
                'label' => esc_html__('Author Image', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );


        $repeater->add_control(
            'rating',
            [
                'label' => esc_html__('Rating', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 5,
                'step' => 1,
                'default' => 5,
            ]
        );



        $this->add_control(
            'list_repeater',
            [
                'label' => esc_html__('Testimonial List', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'list_name' => esc_html__('Testimonial', 'plugin-name'),
                    ],
                ],
                'title_field' => '{{{ list_name }}}',
            ]
        );



        $this->end_controls_section();


        // ===========================Style=====================================//

        $this->start_controls_section(
             'testimonial_style_description',
             [
                'label' => esc_html__('Description', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'testimonial_style_description_typ',
                'selector' => '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri p.dsic',
        
            ]
        );
        
        $this->add_control(
            'testimonial_style_description_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri p.dsic' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonial_style_description_margin',
            [
                'label' => esc_html__( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri p.dsic' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'testimonial_style_description_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri p.dsic' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        
        $this->end_controls_section();


        $this->start_controls_section(
             'testimonial_style_name',
             [
                'label' => esc_html__('Name', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'testimonial_style_name_typ',
                'selector' => '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri .author-area .title',
        
            ]
        );
        
        $this->add_control(
            'testimonial_style_name_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri .author-area .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonial_style_name_margin',
            [
                'label' => esc_html__( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri .author-area .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'testimonial_style_name_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri .author-area .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        
        
        $this->end_controls_section();


        $this->start_controls_section(
             'testimonial_style_designation',
             [
                'label' => esc_html__('Designation', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label'    => esc_html__('Typography', 'plugin-name'),
                'name'     => 'testimonial_style_designation_typ',
                'selector' => '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri .author-area span',
        
            ]
        );
        
        $this->add_control(
            'testimonial_style_designation_color',
            [
                'label'     => esc_html__('Color', 'plugin-name'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri .author-area span' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'testimonial_style_designation_margin',
            [
                'label' => esc_html__( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri .author-area span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'testimonial_style_designation_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri .author-area span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );
        
        
        
        $this->end_controls_section();


        $this->start_controls_section(
             'testimonial_style_rat',
             [
                'label' => esc_html__('Rating', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        
        
        $this->add_control(
            'rat_color',
            [
                'label' => esc_html__( 'Rating Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonials-review-main-wrapper .single-review-area-soalri .author-area .star-area i' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        
        $this->end_controls_section();


        $this->start_controls_section(
             'testimonial_style_nbav',
             [
                'label' => esc_html__('Navigation', 'plugin-name'),
                'tab'   => Controls_Manager::TAB_STYLE,
             ]
        );
        
        
        $this->add_control(
            'testimonial_style_nbav_color',
            [
                'label' => esc_html__( 'Active Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mySwiper-testimonials-solari span.swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}} !important',
                ],
            ]
        );
        
        
        $this->end_controls_section();
    }

    /**
     * Render rsgallery widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {

        $settings    = $this->get_settings_for_display();
        ?>

        <script>
            jQuery(document).ready(function() {
                var swiper = new Swiper(".mySwiper-testimonials-solari", {
                    pagination: {
                        el: ".swiper-pagination",
                        clickable: true
                    },
                    loop: true,
                    autoplay: {
                        delay: 3000,
                    },
                });
            });
        </script>


        <div class="testimonials-review-main-wrapper">

            <div class="swiper mySwiper-testimonials-solari">
                <div class="swiper-wrapper">

                    <?php foreach ($settings['list_repeater'] as $item) : ?>
                        <div class="swiper-slide">
                            <!-- single review area start -->
                            <div class="single-review-area-soalri">
                                <?php if (!empty($item['list_icon']['url'])) :   ?>
                                    <img src="<?php echo esc_url($item['list_icon']['url']) ?>" alt="<?php echo esc_attr('image') ?>" class="quote">
                                <?php endif ?>
                                <p class="dsic">
                                    <?php if (!empty($item['list_content'])) :   ?>
                                        <?php echo esc_html($item['list_content']) ?>
                                    <?php endif ?>
                                </p>
                                <div class="author-area">
                                    <?php if (!empty($item['testi_image']['url'])) :   ?>
                                        <img src="<?php echo esc_url($item['testi_image']['url']) ?>" alt="<?php echo esc_attr('image') ?>" class="authoe">
                                    <?php endif ?>

                                    <?php if (!empty($item['list_name'])) :   ?>
                                        <h6 class="title"><?php echo esc_html($item['list_name']) ?></h6>
                                    <?php endif ?>
                                    <?php if (!empty($item['list_designation'])) :   ?>
                                        <span><?php echo esc_html($item['list_designation']) ?></span>
                                    <?php endif ?>
                                    <div class="star-area">
                                        <?php
                                                    $rating = intval($item['rating']);
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        $star_class = ($i <= $rating) ? 'fas fa-star' : '';
                                                        echo '<i class="' . $star_class . '"></i>';
                                                    }
                                                    ?>
                                    </div>

                                </div>
                            </div>
                            <!-- single review area end -->
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="swiper-pagination"></div>
                
            </div>
        </div>





<?php
    }
} ?>