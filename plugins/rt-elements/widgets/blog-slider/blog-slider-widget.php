<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;


defined( 'ABSPATH' ) || die();

class ReacTheme_Elementor_Blog_Slider_Widget extends \Elementor\Widget_Base {

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
    public function get_name() {
        return 'rt-blog-slider';
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
    public function get_title() {
        return __( 'RT Blog Slider', 'rtelements' );
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
    public function get_icon() {
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
    public function get_categories() {
        return [ 'pielements_category' ];
    }
    
    protected function register_controls() {    
        

        $this->start_controls_section(
            'content_section',
            [
                'label' => esc_html__( 'Content Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );


        $this->add_control(
            'blog_slider_style',
            [
                'label'   => esc_html__( 'Select Style', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',               
                'options' => [
                    '1' => 'Style 1',             
                    '2' => 'Style 2',             
                    '3' => 'Style 3'             
                ],                                          
            ]
        );


        $this->add_control(
            'blog_category',
            [
                'label'   => esc_html__( 'Category', 'rtelements' ),
                'type'    => Controls_Manager::SELECT2, 
                'default' => 0,         
                'options' => $this->getCategories(),
                'multiple' => true, 
                'separator' => 'before',        
            ]

        );        

        $this->add_control(
            'per_page',
            [
                'label' => esc_html__( 'Blog Show Per Page', 'rtelements' ),
                'type' => Controls_Manager::NUMBER,
                'placeholder' => esc_html__( '3', 'rtelements' ),
                'separator' => 'before',
            ]
        );      
        $this->add_control(
            'title_word_count',
            [
                'label' => esc_html__( 'Title Word Limit', 'rtelements' ),
                'type' => Controls_Manager::NUMBER,   
                'placeholder' => esc_html__( '20', 'rtelements' ),
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
            'meta_section',
            [
                'label' => esc_html__( 'Meta Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $this->add_control(
            'blog_avatar_show_hide',
            [
                'label' => esc_html__( 'Category Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'blog_meta_show_hide',
            [
                'label' => esc_html__( 'Date Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'yes',
                'options' => [
                    'yes' => esc_html__( 'Yes', 'rtelements' ),
                    'no' => esc_html__( 'No', 'rtelements' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'button_section',
            [
                'label' => esc_html__( 'Button Settings', 'rtelements' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );  
        $this->add_control(
            'blog_readmore_text',
            [
                'label' => esc_html__( 'Read More Button text', 'rtelements' ),
                'type' => Controls_Manager::TEXT,         
                'separator' => 'before',
                'default' => 'Read More',
            ]
        );
        $this->end_controls_section();

 $this->start_controls_section(
    'content_slider',
    [
        'label' => esc_html__( 'Slider Settings', 'rtelements' ),
        'tab'   => Controls_Manager::TAB_CONTENT,               
    ]
  );

        $this->add_control(
            'col_xl',
            [
                'label'   => esc_html__( 'Wide Screen > 1399px', 'rsaddon' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'rsaddon' ), 
                    '2' => esc_html__( '2 Column', 'rsaddon' ),
                    '3' => esc_html__( '3 Column', 'rsaddon' ),
                    '4' => esc_html__( '4 Column', 'rsaddon' ),
                    '4.5' => esc_html__( '4.5 Column', 'rsaddon' ),
                    '5' => esc_html__( '5 Column', 'rsaddon' ),
                    '6' => esc_html__( '6 Column', 'rsaddon' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_lg',
            [
                'label'   => esc_html__( 'Desktops > 1199px', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,
                'options' => [
                    '1' => esc_html__( '1 Column', 'rtelements' ), 
                    '2' => esc_html__( '2 Column', 'rtelements' ),
                    '3' => esc_html__( '3 Column', 'rtelements' ),
                    '4' => esc_html__( '4 Column', 'rtelements' ),
                    '6' => esc_html__( '6 Column', 'rtelements' ),                 
                ],
                'separator' => 'before',                            
            ]
            
        );

        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__( 'Laptop > 991px', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rtelements' ), 
                    '2' => esc_html__( '2 Column', 'rtelements' ),
                    '3' => esc_html__( '3 Column', 'rtelements' ),
                    '4' => esc_html__( '4 Column', 'rtelements' ),
                    '6' => esc_html__( '6 Column', 'rtelements' ),                     
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__( 'Tablets > 767px', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rtelements' ), 
                    '2' => esc_html__( '2 Column', 'rtelements' ),
                    '3' => esc_html__( '3 Column', 'rtelements' ),
                    '4' => esc_html__( '4 Column', 'rtelements' ),
                    '6' => esc_html__( '6 Column', 'rtelements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'col_xs',
            [
                'label'   => esc_html__( 'Tablets < 768px', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 1,         
                'options' => [
                    '1' => esc_html__( '1 Column', 'rtelements' ), 
                    '2' => esc_html__( '2 Column', 'rtelements' ),
                    '3' => esc_html__( '3 Column', 'rtelements' ),
                    '4' => esc_html__( '4 Column', 'rtelements' ),
                    '6' => esc_html__( '6 Column', 'rtelements' ),                 
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slides_ToScroll',
            [
                'label'   => esc_html__( 'Slide To Scroll', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 2,         
                'options' => [
                    '1' => esc_html__( '1 Item', 'rtelements' ),
                    '2' => esc_html__( '2 Item', 'rtelements' ),
                    '3' => esc_html__( '3 Item', 'rtelements' ),
                    '4' => esc_html__( '4 Item', 'rtelements' ),                   
                ],
                'separator' => 'before',
                            
            ]
            
        );      

        $this->add_control(
            'slider_dots',
            [
                'label'   => esc_html__( 'Navigation Dots', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',                            
            ]            
        );

        $this->add_control(
            'slider_nav',
            [
                'label'   => esc_html__( 'Navigation Nav', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
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
            'slider_autoplay',
            [
                'label'   => esc_html__( 'Autoplay', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 'false',           
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
                ],
                'separator' => 'before',
                            
            ]
            
        );

        $this->add_control(
            'slider_autoplay_speed',
            [
                'label'   => esc_html__( 'Autoplay Slide Speed', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '1000' => esc_html__( '1 Seconds', 'rtelements' ),
                    '2000' => esc_html__( '2 Seconds', 'rtelements' ), 
                    '3000' => esc_html__( '3 Seconds', 'rtelements' ), 
                    '4000' => esc_html__( '4 Seconds', 'rtelements' ), 
                    '5000' => esc_html__( '5 Seconds', 'rtelements' ), 
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
                'label'   => esc_html__( 'Autoplay Interval', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,  
                'default' => 3000,          
                'options' => [
                    '5000' => esc_html__( '5 Seconds', 'rtelements' ), 
                    '4000' => esc_html__( '4 Seconds', 'rtelements' ), 
                    '3000' => esc_html__( '3 Seconds', 'rtelements' ), 
                    '2000' => esc_html__( '2 Seconds', 'rtelements' ), 
                    '1000' => esc_html__( '1 Seconds', 'rtelements' ),     
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
                'label'   => esc_html__( 'Stop On Interaction', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
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
                'label'   => esc_html__( 'Stop on Hover', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',               
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),              
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
                'label'   => esc_html__( 'Loop', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_control(
            'slider_centerMode',
            [
                'label'   => esc_html__( 'Center Mode', 'rtelements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'false',
                'options' => [
                    'true' => esc_html__( 'Enable', 'rtelements' ),
                    'false' => esc_html__( 'Disable', 'rtelements' ),
                ],
                'separator' => 'before',
                            
            ]
            
        );
        $this->add_responsive_control(
            'item_gap_custom',
            [
                'label' => esc_html__( 'Item Middle Gap', 'rtelements' ),
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
        $this->add_responsive_control(
			'item_gap_custom_bottom',
			[
				'label' => esc_html__( 'Item Bottom Gap', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 15,
				],
				'selectors' => [                
                    '{{WRAPPER}} .rt-blog-slider .single-blog-area-style-one' => 'margin-bottom:{{SIZE}}{{UNIT}};',                    
                ]
			]
		); 
        
 $this->end_controls_section();

$this->start_controls_section(
    'section_slider_style',
    [
        'label' => esc_html__( 'Content', 'rtelements' ),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
  );

         $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                  
                    '{{WRAPPER}} .rt-blog-slider .blog-title a' => 'color: {{VALUE}};',                   
                ],                
            ]
        );



        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__( 'Title Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-blog-slider .blog-title a:hover' => 'color: {{VALUE}};',                    
                ],                
            ]            
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'rtelements' ),
                'selector' => '{{WRAPPER}} .rt-blog-slider .blog-title a',                    
            ]
        );

        $this->add_responsive_control(
            'blog_title_padding',
            [
                'label' => esc_html__( 'Title Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rt-blog-slider .blog-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        
        $this->add_responsive_control(
            'blog_title_margin',
            [
                'label' => esc_html__( 'Title Margin', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rt-blog-slider .blog-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
$this->end_controls_section();

$this->start_controls_section(
    'section_slider_meta_style',
    [
        'label' => esc_html__( 'Meta Style', 'rtelements' ),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
    );
        $this->add_responsive_control(
            'blog_slider_meta_padding',
            [
                'label' => esc_html__( 'Meta Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rt-blog-slider .blog-item .bottom-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        ); 
        $this->add_control(
			'author_content_section',
			[
				'label' => esc_html__( 'Author Options', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

        $this->add_control(
            'autor_color',
            [
                'label' => esc_html__( 'Author Text Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-blog-slider .blog-item .bottom-area span.admin' => 'color: {{VALUE}};',                    
                ],
                'condition' => ['blog_avatar_show_hide' => 'yes'],              
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'author_typography',
				'selector' => '{{WRAPPER}} .rt-blog-slider .blog-item .bottom-area span.admin',
                'condition' => ['blog_avatar_show_hide' => 'yes'],  
			]
		); 
        $this->add_control(
			'date_content_section',
			[
				'label' => esc_html__( 'Date Options', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
        $this->add_control(
            'date_color',
            [
                'label' => esc_html__( 'Date Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-blog-slider .blog-item .bottom-area span.date' => 'color: {{VALUE}};',                    
                ],
                'condition' => ['blog_meta_show_hide' => 'yes'],              
            ]
        );
        $this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'date_typography',
				'selector' => '{{WRAPPER}} .rt-blog-slider .blog-item .bottom-area span.date',
                'condition' => ['blog_meta_show_hide' => 'yes'],  
			]
		); 

$this->end_controls_section();

$this->start_controls_section(
    'section_slider_button_style',
    [
        'label' => esc_html__( 'Button', 'rtelements' ),
        'tab' => Controls_Manager::TAB_STYLE,
        'condition' => [
			'blog_slider_style' => '2',
		],
    ]
    );
        $this->add_control(
            'button_text_color',
            [
                'label' => esc_html__( 'Button Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [                  
                    '{{WRAPPER}} .rt-blog-slider .blog-item .btn-readmore-inner' => 'color: {{VALUE}};',                   
                ],                
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label' => esc_html__( 'Btton Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-blog-slider .blog-item .btn-readmore-inner:hover' => 'color: {{VALUE}};',                  
                ],                
            ]
        );
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'btn_typography',
                'label' => esc_html__( 'Typography', 'rtelements' ),
                'selector' => '{{WRAPPER}} .rt-blog-slider .blog-item .btn-readmore-inner',                
            ]
        );
        $this->add_control(
            'button_border_color',
            [
                'label' => esc_html__( 'Btton Border Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-blog-slider .blog-item .btn-readmore-inner::after' => 'background: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'button_border_hover_color',
            [
                'label' => esc_html__( 'Btton Border Hover Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-blog-slider .blog-item .btn-readmore-inner::before' => 'background: {{VALUE}};',  
                ],                
            ]
        );
        $this->add_control(
			'button_border_height',
			[
				'label' => esc_html__( 'Border Height', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .rt-blog-slider .blog-item .btn-readmore-inner::before' => 'height: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .rt-blog-slider .blog-item .btn-readmore-inner::after' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);

$this->end_controls_section();

$this->start_controls_section(
    'section_slider_arrow_style',
    [
        'label' => esc_html__( 'Navigation', 'rtelements' ),
        'tab' => Controls_Manager::TAB_STYLE,
    ]
    );
        $this->add_control(
            'bullet_options',
            [
                'label' => esc_html__( 'Bullet Style', 'rtelements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'navigation_bullet_color',
            [
                'label' => esc_html__( 'Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-pagination .swiper-pagination-bullet' => 'background: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'navigation_bullet_active_color',
            [
                'label' => esc_html__( 'Active Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .blog-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active' => 'background: {{VALUE}};',
                ],                
            ]
        );
        $this->add_control(
            'navigation_bullet_size',
            [
                'label' => esc_html__( 'Size', 'rtelements' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px','custom' ],
                'selectors' => [
                    '{{WRAPPER}} .blog-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_options',
            [
                'label' => esc_html__( 'Arrow Style', 'rtelements' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->start_controls_tabs(
            'style_arrow_tabs'
        );
            $this->start_controls_tab(
                'style_arrow_normal_tab',
                [
                    'label' => esc_html__( 'Normal', 'rtelements' ),
                ]
             );
                $this->add_control(
                    'navigation_arrow_bg',
                    [
                        'label' => esc_html__( 'Background Color', 'rtelements' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-prev' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-next' => 'background: {{VALUE}};',
        
                        ],                
                    ]
                );
                $this->add_control(
                    'navigation_arrow_color',
                    [
                        'label' => esc_html__( 'Icon Color', 'rtelements' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-prev' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-next' => 'color: {{VALUE}};',
                        ],                
                    ]
                );
                $this->add_control(
                    'navigation_arrow_size',
                    [
                        'label' => esc_html__( 'Icon Size', 'rtelements' ),
                        'type' => \Elementor\Controls_Manager::SLIDER,
                        'size_units' => [ 'px','custom' ],
                        'selectors' => [
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-prev' => 'font-size: {{SIZE}}{{UNIT}};',
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-next' => 'font-size: {{SIZE}}{{UNIT}};',
                        ],
                    ]
                );
            $this->end_controls_tab();

            $this->start_controls_tab(
                'style_arrow_hover_tab',
                [
                    'label' => esc_html__( 'Hover', 'rtelements' ),
                ]
             );
                $this->add_control(
                    'navigation_arrow_hover_bg',
                    [
                        'label' => esc_html__( 'Background Color', 'rtelements' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-prev:hover' => 'background: {{VALUE}};',
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-next:hover' => 'background: {{VALUE}};',
        
                        ],                
                    ]
                );
                $this->add_control(
                    'navigation_arrow_hover_color',
                    [
                        'label' => esc_html__( 'Icon Color', 'rtelements' ),
                        'type' => Controls_Manager::COLOR,
                        'selectors' => [
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-prev:hover' => 'color: {{VALUE}};',
                            '{{WRAPPER}} .blog-swiper-navigation .swiper-next:hover' => 'color: {{VALUE}};',
                        ],                
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
    protected function render() {

        $settings        = $this->get_settings_for_display();
        $length          = !empty($settings['title_word_count']) ? $settings['title_word_count'] : 22;            
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
        $item_gap = $settings['item_gap_custom'] ?? '';
        $item_gap = !empty($item_gap) ? $item_gap : '30';
        $unique = rand(2012,35120);

         if( $slider_autoplay =='true' ){
            $slider_autoplay = 'autoplay: { ' ;
            $slider_autoplay .= 'delay: '.$interval;
            if(  $pauseOnHover =='true'  ){
                $slider_autoplay .= ', pauseOnMouseEnter: true';
            }else{
                $slider_autoplay .= ', pauseOnMouseEnter: false';
            }
            if(  $pauseOnInter =='true'  ){
                $slider_autoplay .= ', disableOnInteraction: true';
            }else{
                $slider_autoplay .= ', disableOnInteraction: false';
            }
            $slider_autoplay .= ' }';
        }else{
            $slider_autoplay = 'autoplay: false' ;
        }
    
        ?>   
        <div class="rsaddon-unique-slider rt-addon-slider rt-blog-slider rt-blog rt-blog-style<?php echo esc_attr($settings['blog_slider_style']); ?> slider-style-<?php echo esc_attr($settings['blog_slider_style']); ?> ">
            <div id="rsaddon-slick-slider-<?php echo esc_attr($unique); ?>" class="rt_widget_sliders swiper rtaddon-slider-<?php echo esc_attr($unique); ?>">
                <div class="swiper-wrapper">
                    <?php  
                        if('1' == $settings['blog_slider_style']){ 
                            include plugin_dir_path(__FILE__)."/style1.php";
                        }
                        if('2' == $settings['blog_slider_style']){ 
                            include plugin_dir_path(__FILE__)."/style2.php";
                        }
                        if('3' == $settings['blog_slider_style']){ 
                            include plugin_dir_path(__FILE__)."/style3.php";
                        }
                    ?>
                </div>
            </div>
        </div>

        <?php if ($sliderDots == 'true') : ?> 
            <div class="blog-pagination"></div>                   
        <?php endif; ?>

        <?php if ($sliderNav == 'true') : ?>
            <div class="blog-swiper-navigation">
                <div class="swiper-prev">
                    <i class="<?php echo $settings['slider_prev_icon']['value']; ?>"></i>
                </div>
                <div class="swiper-next">
                    <i class="<?php echo $settings['slider_next_icon']['value']; ?>"></i>
                </div>
            </div>
        <?php endif; ?>  
    <script type="text/javascript"> 
            jQuery(document).ready(function(){
                    
                var swiper = new Swiper(".rtaddon-slider-<?php echo esc_attr($unique); ?>", {				
                    slidesPerView: <?php echo $slidesToShow;?>,
                    speed: <?php echo esc_attr($autoplaySpeed); ?>,
                  
                    loop: <?php echo esc_attr($infinite ); ?>,
                   <?php echo esc_attr($slider_autoplay); ?>,
                   spaceBetween:  <?php echo esc_attr($item_gap); ?>,
                    centeredSlides: <?php echo esc_attr($centerMode); ?>,
                    <?php if ($sliderDots == 'true') : ?>
                        pagination: {
                            el: ".blog-pagination",
                            clickable: true
                        },

                    <?php endif; ?>
                    <?php if ($sliderNav == 'true') : ?>
                        navigation: {
                            nextEl: ".swiper-next",
                            prevEl: ".swiper-prev",
                        },
                    <?php endif; ?>
                    breakpoints: {     
                        0: {
                            slidesPerView: <?php echo esc_attr($col_xs); ?>,
                           
                        },                   
                        <?php
                        echo (!empty($col_xs)) ?  '575: { slidesPerView: '. $col_xs .' },' : '';
                        echo (!empty($col_sm)) ?  '767: { slidesPerView: '. $col_sm .' },' : '';
                        echo (!empty($col_md)) ?  '991: { slidesPerView: '. $col_md .' },' : '';
                        echo (!empty($col_lg)) ?  '1199: { slidesPerView: '. $col_lg .' },' : '';
                        ?>
                        1399: {
                            slidesPerView: <?php echo esc_attr($col_xl); ?>,
                            spaceBetween:  <?php echo esc_attr($item_gap); ?>
                        }
                    }
                });
           
        });
        </script>
    <?php 
    }
    public function getCategories(){
        $cat_list = [];
            if ( post_type_exists( 'post' ) ) { 
            $terms = get_terms( array(
                'taxonomy'    => 'category',
                'hide_empty'  => true            
            ) );
            
            foreach($terms as $post) {
                $cat_list[$post->slug]  = [$post->name];
            }
        }  
        return $cat_list;
    }
}?>