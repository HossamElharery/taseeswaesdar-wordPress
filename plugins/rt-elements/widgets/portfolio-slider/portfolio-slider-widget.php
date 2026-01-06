<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Utils;


defined('ABSPATH') || die();

class ReacTheme_Portfolio_Slider_Widget extends \Elementor\Widget_Base
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
        return 'rt-portfolio-slider';
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
        return __('Portfolio Slider', 'rtelements');
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
            'content_section',
            [
                'label' => esc_html__('Content Settings', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'portfolio_slider_style',
            [
                'label'   => esc_html__('Select Style', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => [
                    '1' => 'Style 1',
                ],
            ]
        );
        $this->add_control(
            'portfolio_category',
            [
                'label'   => esc_html__('Category', 'rtelements'),
                'type'    => Controls_Manager::SELECT2,
                'default' => 0,
                'options' => $this->getCategories(),
                'multiple' => true,
                'separator' => 'before',
            ]

        );
        $this->add_control(
            'title_word_count',
            [
                'label' => esc_html__('Title Word Count', 'rtelements'),
                'type' => Controls_Manager::NUMBER,
                'default' => 1
            ]
        );
        $this->add_control(
            'per_page',
            [
                'label' => esc_html__('Portfolio Show Per Page', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__('example 3', 'rtelements'),
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ],
                'separator' => 'before',
            ]
        );


        $this->end_controls_section();


        $this->start_controls_section(
            'content_slider',
            [
                'label' => esc_html__('Slider Settings', 'rtelements'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'col_xl',
            [
                'label'   => esc_html__('Wide Screen > 1399px', 'rsaddon'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rsaddon'),
                    '2' => esc_html__('2 Column', 'rsaddon'),
                    '2.4' => esc_html__('2.4 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rsaddon'),
                    '3.8' => esc_html__('3.8 Column', 'rsaddon'),
                    '4' => esc_html__('4 Column', 'rsaddon'),
                    '4.5' => esc_html__('4.5 Column', 'rsaddon'),
                    '5' => esc_html__('5 Column', 'rsaddon'),
                    '6' => esc_html__('6 Column', 'rsaddon'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__('Desktops > 1199px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '2.4' => esc_html__('2.4 Column', 'rsaddon'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',
            ]

        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__('Laptop > 991px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__('Tablets > 767px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 2,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__('Tablets < 768px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 1,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__('Slide To Scroll', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 2,
                'options' => [
                    '1' => esc_html__('1 Item', 'rtelements'),
                    '2' => esc_html__('2 Item', 'rtelements'),
                    '3' => esc_html__('3 Item', 'rtelements'),
                    '4' => esc_html__('4 Item', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'rt_pslider_effect',
            [
                'label' => esc_html__('Slider Effect', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'rsaddon'),
                    'fade' => esc_html__('Fade', 'rsaddon'),
                    'flip' => esc_html__('Flip', 'rsaddon'),
                    'cube' => esc_html__('Cube', 'rsaddon'),
                    'coverflow' => esc_html__('Coverflow', 'rsaddon'),
                    'creative' => esc_html__('Creative', 'rsaddon'),
                    'cards' => esc_html__('Cards', 'rsaddon'),
                ],
            ]
        );

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__('Navigation Dots', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'slider_dots_color',
            [
                'label' => esc_html__('Navigation Dots Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}} !important;',
                ],
                'condition' => ['slider_dots' => 'true',],
            ]
        );

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__('Navigation Nav', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );
        $this->add_control(
            'slider_prev_icon',
            [
                'label' => esc_html__('Prev Icon', 'rtelements'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rt rt-arrow-left',
                    'library' => 'rt-icons',
                ], 
                'condition' => ['slider_nav' => 'true',],               
            ]
        );
        $this->add_control(
            'slider_next_icon',
            [
                'label' => esc_html__('Next Icon', 'rtelements'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'rt rt-arrow-right',
                    'library' => 'rt-icons',
                ],                
                'condition' => ['slider_nav' => 'true',],
            ]
        );

        $this->add_control(
            'pcat_nav_text_bg',
            [
                'label' => esc_html__('Nav Background', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-swiper-navigation .swiper-prev, .portfolio-swiper-navigation .swiper-next' => 'background: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_color_icon',
            [
                'label' => esc_html__('Nav Icon Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-swiper-navigation .swiper-prev i, .portfolio-swiper-navigation .swiper-next i' => 'color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_text_bg_hover',
            [
                'label' => esc_html__('Nav Hover Background', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-swiper-navigation .swiper-prev:hover, .portfolio-swiper-navigation .swiper-next:hover' => 'background: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );
        $this->add_control(
            'pcat_nav_hover_icon_color',
            [
                'label' => esc_html__('Nav Icon Hover Color', 'rsaddon'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-swiper-navigation .swiper-prev:hover i, .portfolio-swiper-navigation .swiper-next:hover i' => 'color: {{VALUE}} !important;',
                ],
                'condition' => ['slider_nav' => 'true',],
            ]
        );        

        $this->add_control(
            'slider_autoplay',
            [
                'label'   => esc_html__('Autoplay', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__('Autoplay Slide Speed', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3000,
                'options' => [
                    '1000' => esc_html__('1 Seconds', 'rtelements'),
                    '2000' => esc_html__('2 Seconds', 'rtelements'),
                    '3000' => esc_html__('3 Seconds', 'rtelements'),
                    '4000' => esc_html__('4 Seconds', 'rtelements'),
                    '5000' => esc_html__('5 Seconds', 'rtelements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );

        $this->add_control(
            'slider_interval',
            [
                'label'   => esc_html__('Autoplay Interval', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3000,
                'options' => [
                    '5000' => esc_html__('5 Seconds', 'rtelements'),
                    '4000' => esc_html__('4 Seconds', 'rtelements'),
                    '3000' => esc_html__('3 Seconds', 'rtelements'),
                    '2000' => esc_html__('2 Seconds', 'rtelements'),
                    '1000' => esc_html__('1 Seconds', 'rtelements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );

        $this->add_control(
            'slider_stop_on_interaction',
            [
                'label'   => esc_html__('Stop On Interaction', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );

        $this->add_control(
            'slider_stop_on_hover',
            [
                'label'   => esc_html__('Stop on Hover', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',
                'condition' => [
                    'slider_autoplay' => 'true',
                ],
            ]

        );

        $this->add_control(
            'slider_loop',
            [
                'label'   => esc_html__('Loop', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',

            ]
        );

        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__('Center Mode', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__('Enable', 'rtelements'),
                    'false' => esc_html__('Disable', 'rtelements'),
                ],
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__('Item Middle Gap', 'rtelements'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],

                'selectors' => [
                    '{{WRAPPER}} .reactheme-addon-slider .testimonial-item' => 'margin-left:{{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .reactheme-addon-slider .testimonial-item' => 'margin-right:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_gap_custom_bottom',
            [
                'label' => esc_html__('Item Bottom Gap', 'rtelements'),
                'type' => Controls_Manager::SLIDER,
                'show_label' => true,
                'range' => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'size' => 15,
                ],

                'selectors' => [
                    '{{WRAPPER}} .reactheme-addon-slider .testimonial-item' => 'margin-bottom:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'section_slider_style',
			[
				'label' => esc_html__( 'Style', 'rtelements' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .left-content .title' => 'color: {{VALUE}};'   
                ],                
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .left-content .title:hover' => 'color: {{VALUE}};',                                     
                ],                
            ]
            
        );
        $this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rtelements' ),
				'selector' => '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .left-content .title',                    
			]
		);
        $this->add_control(
            'category_color',
            [
                'label' => esc_html__( 'Category Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .left-content .pre a' => 'color: {{VALUE}};',                 

                ],                
            ]
        );
        $this->add_control(
            'category_color_hover',
            [
                'label' => esc_html__( 'Category Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .left-content .pre a:hover' => 'color: {{VALUE}};',                     
                ],                
            ]            
        ); 
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'spinddner_typography',
				'label' => esc_html__( 'Category Typography', 'rtelements' ),
				'selector' => '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .left-content .pre a',
			]
		);
        $this->end_controls_section();

        	$this->start_controls_section(
        		    '_section_style_button',
        		    [
        		        'label' => esc_html__( 'Button', 'rtelements' ),
        		        'tab' => Controls_Manager::TAB_STYLE,
        		    ]
        		);
        		$this->start_controls_tabs( '_tabs_button' );

        		$this->start_controls_tab(
                    'style_normal_tab',
                    [
                        'label' => esc_html__( 'Normal', 'rtelements' ),
                    ]
                ); 

        		$this->add_control(
        		    'btn_text_color',
        		    [
        		        'label' => esc_html__( 'Text Color', 'rtelements' ),
        		        'type' => Controls_Manager::COLOR,		      
        		        'selectors' => [
        		            '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .right a i' => 'color: {{VALUE}};',
        		        ],
        		    ]
        		);

        		$this->add_group_control(
        		    Group_Control_Background::get_type(),
        			[
        				'name' => 'background_normal',
        				'label' => esc_html__( 'Background', 'rtelements' ),
        				'types' => [ 'classic', 'gradient' ],
        				'selector' => '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .right a',
        			]
        		);

        	$this->end_controls_tab();

        	$this->start_controls_tab(
                    'style_hover_tab',
                    [
                        'label' => esc_html__( 'Hover', 'rtelements' ),
                    ]
                ); 

        		$this->add_control(
        		    'btn_text_hover_color',
        		    [
        		        'label' => esc_html__( 'Text Color', 'rtelements' ),
        		        'type' => Controls_Manager::COLOR,		      
        		        'selectors' => [
        		            '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .right a:hover i' => 'color: {{VALUE}};',
        		        ],
        		    ]
        		);

        		$this->add_group_control(
        		    Group_Control_Background::get_type(),
        			[
        				'name' => 'background',
        				'label' => esc_html__( 'Background', 'rtelements' ),
        				'types' => [ 'classic', 'gradient' ],
        				'selector' => '{{WRAPPER}} .siongle-portfolio-box-style .inner-content .right a:hover',
        			]
        		);

        		$this->end_controls_tab();
        		$this->end_controls_tabs();	
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
        $placeholder = Utils::get_placeholder_image_src();
        $imgId       = !empty($settings['card_image']) ? $settings['card_image']['id'] : '';
        if (!empty($imgId)) {
            $img_link = wp_get_attachment_image_src($imgId, 'large')[0];
        } else {
            $img_link = $placeholder;
        }
        $imgId2 = !empty($settings['card_image_shape']) ? $settings['card_image_shape']['id'] : '';
        if (!empty($imgId2)) {
            $img_link2 = wp_get_attachment_image_src($imgId2, 'large')[0];
        } else {
            $img_link2 = $placeholder;
        }

        $col_xl          = $settings['col_xl'];
        $col_xl          = !empty($col_xl) ? $col_xl : 3;
        $slidesToShow    = $col_xl;
        $autoplaySpeed   = $settings['slider_autoplay_speed'];
        $autoplaySpeed   = !empty($autoplaySpeed) ? $autoplaySpeed : '1000';
        $interval        = $settings['slider_interval'];
        $interval        = !empty($interval) ? $interval : '3000';
        $slidesToScroll  = $settings['slides_ToScroll'];
        $slider_autoplay = $settings['slider_autoplay'] === 'true' ? 'true' : 'false';
        $pauseOnHover    = $settings['slider_stop_on_hover'] === 'true' ? 'true' : 'false';
        $pauseOnInter    = $settings['slider_stop_on_interaction'] === 'true' ? 'true' : 'false';
        $sliderDots      = $settings['slider_dots'] == 'true' ? 'true' : 'false';
        $sliderNav       = $settings['slider_nav'] == 'true' ? 'true' : 'false';
        $infinite        = $settings['slider_loop'] === 'true' ? 'true' : 'false';
        $centerMode      = $settings['slider_centerMode'] === 'true' ? 'true' : 'false';
        $col_lg          = $settings['col_lg'];
        $col_md          = $settings['col_md'];
        $col_sm          = $settings['col_sm'];
        $col_xs          = $settings['col_xs'];
        $item_gap   = $settings['item_gap_custom']['size'] ?? '';
        $item_gap   = !empty($item_gap) ? $item_gap : '30';
        $prev_text  = $settings['pcat_prev_text'] ?? '';
        $prev_text  = !empty($prev_text) ? $prev_text : '';
        $next_text  = $settings['pcat_next_text'] ?? '';
        $next_text  = !empty($next_text) ? $next_text : '';
        $unique = rand(2012, 35120);
        if ($slider_autoplay == 'true') {
            $slider_autoplay = 'autoplay: { ';
            $slider_autoplay .= 'delay: ' . $interval;
            if ($pauseOnHover == 'true') {
                $slider_autoplay .= ', pauseOnMouseEnter: true';
            } else {
                $slider_autoplay .= ', pauseOnMouseEnter: false';
            }
            if ($pauseOnInter == 'true') {
                $slider_autoplay .= ', disableOnInteraction: true';
            } else {
                $slider_autoplay .= ', disableOnInteraction: false';
            }
            $slider_autoplay .= ' }';
        } else {
            $slider_autoplay = 'autoplay: false';
        }
        $effect = $settings['rt_pslider_effect'];

        if ($effect == 'fade') {
            $seffect = "effect: 'fade', fadeEffect: { crossFade: true, },";
        } elseif ($effect == 'cube') {
            $seffect = "effect: 'cube',";
        } elseif ($effect == 'flip') {
            $seffect = "effect: 'flip',";
        } elseif ($effect == 'coverflow') {
            $seffect = "effect: 'coverflow',";
        } elseif ($effect == 'creative') {
            $seffect = "effect: 'creative', creativeEffect: { prev: { translate: [0, 0, -400], }, next: { translate: ['100%', 0, 0], }, },";
        } elseif ($effect == 'cards') {
            $seffect = "effect: 'cards',";
        } else {
            $seffect = '';
        }
        ?>
       

        <?php if ($sliderNav == 'true') : ?>
            <div class="portfolio-swiper-navigation">
                <div class="swiper-prev">
                    <i class="<?php echo $settings['slider_prev_icon']['value']; ?>"></i>
                </div>
                <div class="swiper-next">
                    <i class="<?php echo $settings['slider_next_icon']['value']; ?>"></i>
                </div>
            </div>
        <?php endif; ?>
        <div class="float-right-div-case-studies">
            <div class="swiper rtaddon-portfolio-slider-<?php echo esc_attr($unique); ?>  rsaddon-unique-slider rs-addon-slider rt-portfolio-slider rt-portfolio rt-portfolio-style<?php echo esc_attr($settings['portfolio_slider_style']); ?> slider-style-<?php echo esc_attr($settings['portfolio_slider_style']); ?> center-mode-<?php echo $centerMode; ?>">
                <div class="swiper-wrapper">
                    <?php 
                    if ('1' == $settings['portfolio_slider_style']) {
                            include plugin_dir_path(__FILE__) . "/style1.php";
                        }else {
                            include plugin_dir_path(__FILE__) . "/style1.php";
                        }
                    ?>
                </div>
            </div>
        </div>
        <?php if ($sliderDots == 'true') : ?> 
            <div class="portfolio-swiper-pagination"></div>                   
        <?php endif; ?>      

        <script type="text/javascript">
            jQuery(document).ready(function() {
                var swiper = new Swiper(".rtaddon-portfolio-slider-<?php echo esc_attr($unique); ?>", {
                    slidesPerView: <?php echo $slidesToShow; ?>,                    
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,
                    loop: <?php echo esc_attr($infinite); ?>,
                    <?php echo esc_attr($slider_autoplay); ?>,                 
                    spaceBetween: <?php echo esc_attr($item_gap); ?>,
                    centeredSlides: <?php echo esc_attr($centerMode); ?>,
                    <?php if ($sliderNav == 'true') : ?>
                        navigation: {
                            nextEl: ".swiper-next",
                            prevEl: ".swiper-prev",
                        },
                    <?php endif; ?>

                    <?php if ($sliderDots == 'true') : ?>
                        pagination: {
                            el: ".portfolio-swiper-pagination",
                            clickable: true
                        },
                    <?php endif; ?>

                    breakpoints: {
                        0: {
                            slidesPerView: <?php echo esc_attr($col_xs); ?>,

                        },
                        <?php echo (!empty($col_xs)) ?  '575: { slidesPerView: ' . $col_xs . ' },' : '';
                                echo (!empty($col_sm)) ?  '767: { slidesPerView: ' . $col_sm . ' },' : '';
                                echo (!empty($col_md)) ?  '991: { slidesPerView: ' . $col_md . ' },' : '';
                                echo (!empty($col_lg)) ?  '1199: { slidesPerView: ' . $col_lg . ' },' : '';
                                ?>
                        1399: {
                            slidesPerView: <?php echo esc_attr($col_xl); ?>,
                            spaceBetween: <?php echo esc_attr($item_gap); ?>
                        }
                    }
                });

            });

            
        </script>
<?php
    }
    public function getCategories()
    {
        $cat_list = [];
        if (post_type_exists('rt-portfolios')) {
            $terms = get_terms(array(
                'taxonomy'    => 'rt-portfolio-category',
                'hide_empty'  => true
            ));

            foreach ($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }
        return $cat_list;
    }
} ?>