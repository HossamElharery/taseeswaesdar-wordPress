<?php

/**
 * Logo widget class
 *
 */

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\register_controls;

defined('ABSPATH') || die();
class Reactheme_Elementor_Testimonial_Grid_Widget  extends \Elementor\Widget_Base
{

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
        return 'rt-testimonial-grid';
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
        return esc_html__('RT Testimonial Grid', 'rtelements');
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
        return ['slider'];
    }
    protected function register_controls()
    {

        $this->start_controls_section(
            '_services_slider_s',
            [
                'label' => esc_html__('Testimonial Style', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'rt_slider_style',
            [
                'label'   => esc_html__('Select Style', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'rtelements'),
                    'style2' => esc_html__('Style 2', 'rtelements'),
                    'style3' => esc_html__('Style 3', 'rtelements'),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__('Item', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Image', 'rtelements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );
        
        $repeater->add_control(
            'sub-name',
            [
                'label' => esc_html__('Sub Title', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Designation', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__('designation', 'rtelements'),
                'separator'   => 'before',
            ]
        );
        $repeater->add_control(
            'name',
            [
                'label' => esc_html__('Title', 'rtelements'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Testimonial Name', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__('Name', 'rtelements'),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'rtelements'),
                'type' => Controls_Manager::URL,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'rtelements'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__('Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.', 'rtelements'),
                'label_block' => true,
                'placeholder' => esc_html__('Description', 'rtelements'),
                'separator'   => 'before',
            ]
        );

        $repeater->add_control(
            'logo_client',
            [
                'label' => esc_html__('User Company Logo', 'rtelements'),
                'type' => Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'logo_list',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
                'default' => [
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                    ['image' => ['url' => Utils::get_placeholder_image_src()]],
                ]
            ]
        );
        $this->add_control(
			'quote-icon',
			[
				'label' => esc_html__( 'Quote Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-quote-right',
					'library' => 'fa-solid',
				],				
			]
		);
        $this->add_control(
			'quote_size',
			[
				'label' => esc_html__( 'Width', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors' => [
                    '{{WRAPPER}} .dynamic .icon i' => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .dynamic .icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
					'{{WRAPPER}} .dynamic .quote-image svg' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();      


        $this->start_controls_section(
            'slider_wraper_styles',
            [
                'label' => esc_html__('Wrapper', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'slider_wraper_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .dynamic,{{WRAPPER}} .dynamic::after,.dynamic::before',
			]
		);

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'slider_wraper_border',
				'selector' => '{{WRAPPER}} .dynamic',
			]
		);

        $this->add_responsive_control(
            'slider_wraper_radius',
            [
                'label' => esc_html__('Border Radius', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dynamic' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_wraper_padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dynamic' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'slider_wraper_margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dynamic' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section();        


        $this->start_controls_section(
            'slider_title_styles',
            [
                'label' => esc_html__('Name', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dynamic .title' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .dynamic .name' => 'color: {{VALUE}} !important',
                ],
            ]
        );
        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Color Hover', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dynamic .title:hover' => 'color: {{VALUE}} !important',
                    '{{WRAPPER}} .dynamic .name:hover' => 'color: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .dynamic .title,{{WRAPPER}} .dynamic .name',
            ]
        );

        $this->add_responsive_control(
            'title__padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dynamic .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .dynamic .name' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'title__margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dynamic .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .dynamic .name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section();     

        $this->start_controls_section(
            'designation_styles',
            [
                'label' => esc_html__('Designation', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => esc_html__('Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dynamic .designation' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .dynamic .author .disc' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'subtitle_cofflor',
            [
                'label' => esc_html__('Hover Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dynamic .designation:hover' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .dynamic .author .disc:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .dynamic .designation,{{WRAPPER}} .dynamic .author .disc',
            ]
        );

        $this->add_responsive_control(
            'subtitle__padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dynamic .designation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .dynamic .author .disc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'subtitle__margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dynamic .designation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                    '{{WRAPPER}} .dynamic .author .disc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section(); 

        $this->start_controls_section(
            'des__styles',
            [
                'label' => esc_html__('Description', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'des__color',
            [
                'label' => esc_html__('Color', 'rtelements'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .dynamic .disc' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'des__typography',
                'selector' => '{{WRAPPER}} .dynamic .disc',
            ]
        );

        $this->add_responsive_control(
            'des__padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dynamic .disc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_responsive_control(
            'des__margin',
            [
                'label' => esc_html__('Margin', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .dynamic .disc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );       
        $this->end_controls_section();

        $this->start_controls_section(
            'separator__styles',
            [
                'label' => esc_html__('Separator', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => ['rt_slider_style' => 'style1' ]
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'separator_border',
				'selector' => '{{WRAPPER}} .single-testimonials-area .author-area',
			]
		);
        $this->add_responsive_control(
            'separator_padding',
            [
                'label' => esc_html__('Padding', 'rtelements'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors' => [
                    '{{WRAPPER}} .single-testimonials-area .author-area' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );
        $this->end_controls_section(); 

        $this->start_controls_section(
            'img__styles',
            [
                'label' => esc_html__('Image', 'rtelements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
			'img_styles',
			[
				'label' => esc_html__( 'Width', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .dynamic .author-img img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section(); 

        
    }
    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $sstyle = $settings['rt_slider_style'];
        $blank = "";
        ?>

        <div class="slider-inner-wrapper testimonial-grid-<?php echo esc_attr($sstyle); ?>">                
            <?php
                foreach ($settings['logo_list'] as $index => $item) :
                    $imgId = $item['image']['id'];

                    if ($imgId) {
                        $image = wp_get_attachment_image_src($imgId, 'full')[0];
                        $IMGstyle = 'style="background-image: url( ' . $image . ' );"';
                    } else {
                        $IMGstyle = '';
                        $image = '';
                    }
                    $imgId2 = $item['logo_client']['id'];
                    if ($imgId2) {
                        $image2 = wp_get_attachment_image_src($imgId2, 'full')[0];
                    } else {
                        $image2 = '';
                    }
                    $title        = !empty($item['name']) ? $item['name'] : '';
                    $sub_title    = !empty($item['sub-name']) ? $item['sub-name'] : '';
                    $description  = !empty($item['description']) ? $item['description'] : '';
                    $btn_text     = !empty($item['btn_text']) ? $item['btn_text'] : '';
                    $target       = !empty($item['link']['is_external']) ? 'target=_blank' : '';
                    $link         = !empty($item['link']['url']) ? $item['link']['url'] : '';
                    

                    if ($sstyle) {
                        require plugin_dir_path(__FILE__) . "/$sstyle.php";
                    } else {
                        require plugin_dir_path(__FILE__) . "/style1.php";
                    }
                endforeach; 
            ?>    
        </div>
    <?php
    }
}
