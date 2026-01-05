<?php
use Elementor\Group_Control_Css_Filter;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Utils;

defined('ABSPATH') || die();

class Reactheme_Elementor_Heading_Widget extends \Elementor\Widget_Base
{

	/*
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'react-heading';
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
		return esc_html__('RT Heading', 'rtelements');
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
		return 'glyph-icon flaticon-letter';
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
				'label' => esc_html__('Heading Info', 'rtelements'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'enable_animation',
			[
				'label' => esc_html__('Enable Animation', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'rtelements'),
				'label_off' => esc_html__('No', 'rtelements'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'animation_style',
			[
				'label'   => esc_html__('Select Animation Style', 'rtelements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Split Up', 'rtelements'),
					'style2' => esc_html__('Split Left', 'rtelements'),
				],
				'separator' => 'before',
				'condition' => [
					'enable_animation' => 'yes',
				],		
			]
		);
		$this->add_control(
			'animation_type',
			[
				'label'   => esc_html__('Animation Type', 'rtelements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'word',
				'options' => [
					'word' => esc_html__('Word', 'rtelements'),
					'letter' => esc_html__('Letter', 'rtelements'),
				],
				'condition' => [
					'enable_animation' => 'yes',
				],		
			]
		);

		$this->add_control(
			'style',
			[
				'label'   => esc_html__('Select Heading Style', 'rtelements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'default',
				'options' => [
					'default' => esc_html__('Default', 'rtelements'),				
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Heading Text', 'rtelements'),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__('Heading Style', 'rtelements'),
				'separator' => 'before',
				'label_block' => true
			]
		);
		$this->add_control(
			'title_span_display_block',
			[
				'label' => esc_html__( 'Span Display Block', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'block' => esc_html__( 'Yes', 'rtelements' ),
				'inline-block' => esc_html__( 'No', 'rtelements' ),
				'return_value' => 'block',
				'default' => 'block',
				'selectors' => [
					'{{WRAPPER}} .react-heading .title-inner .title span' => 'display: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'title_secondary',
			[
				'label' => esc_html__('Span or Secondary Heading', 'rtelements'),
				'type' => Controls_Manager::TEXT,
				'separator' => 'before',
				'label_block' => true
			]
		);
		$this->add_control(
			'enable_stroke',
			[
				'label' => esc_html__('Enable Title Stroke', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'rtelements'),
				'label_off' => esc_html__('No', 'rtelements'),
				'return_value' => 'yes',
				'default' => 'no',

			]
		);

		$this->add_control(
			'title_tag',
			[
				'label'   => esc_html__('Select Heading Tag', 'rtelements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'h2',
				'options' => [
					'h1' => esc_html__('H1', 'rtelements'),
					'h2' => esc_html__('H2', 'rtelements'),
					'h3' => esc_html__('H3', 'rtelements'),
					'h4' => esc_html__('H4', 'rtelements'),
					'h5' => esc_html__('H5', 'rtelements'),
					'h6' => esc_html__('H6', 'rtelements'),

				],
			]
		);

		$this->add_control(
			'subtitle',
			[
				'label'     => esc_html__('Sub Heading Text', 'rtelements'),
				'type'      => Controls_Manager::TEXT,
				'default'   => esc_html__('Sub Heading', 'rtelements'),
				'separator' => 'before',
				'label_block' => true
			]
		);

		$this->add_control(
			'enable_bg_style',
			[
				'label' => esc_html__('Enable Bg Style', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'rtelements'),
				'label_off' => esc_html__('No', 'rtelements'),
				'return_value' => 'yes',
				'default' => 'no',

			]
		);


		$this->add_control(
			'enable_border_ts_style',
			[
				'label' => esc_html__('Enable Double Borders Style', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'rtelements'),
				'label_off' => esc_html__('No', 'rtelements'),
				'return_value' => 'yes',
				'default' => 'no',

			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'btn_bg_style',
				'label' => esc_html__('Backgorund Color', 'elementor'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .react-heading .title-inner.bg_sub_text_yes .sub-text',
			]
		);


		$this->add_control(
			'watermark',
			[
				'label' => esc_html__('Watermark Text', 'rtelements'),
				'type' => Controls_Manager::TEXT,
				'placeholder' => esc_html__('Watermark', 'rtelements'),
				'separator' => 'before',
				'label_block' => true
			]
		);

		// Icon Size
		$this->add_responsive_control(
			'watermark_font_size',
			[
				'label' => esc_html__('Font Size', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .react-heading span.watermark' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'fill_color',
			[
				'label' => esc_html__('Fill Color', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading span.watermark' => '-webkit-text-fill-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'stroke_color',
			[
				'label' => esc_html__('Stroke Color', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading span.watermark' => '-webkit-text-stroke:1px {{VALUE}}',
				],
			]
		);

		// Icon Size
		$this->add_responsive_control(
			'Facilitiese_icon_custom_dimensionsss',
			[
				'label' => esc_html__('Stroke Width', 'plugin-name'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .react-heading span.watermark' => '-webkit-text-stroke-width: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->add_responsive_control(
			'mark_postition_zindex',
			[
				'label' => esc_html__('Watermark Z-Index', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -1,
						'max' => 99,
						'step' => 1,
					],

				],
				'default' => [
					'unit' => 'px',

				],

				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .react-heading  span.watermark' => 'z-index: {{SIZE}};',
				],
			]
		);

		$this->add_responsive_control(
			'mark_postition_left_right',
			[
				'label' => esc_html__('Watermark Left/right Position', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -400,
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

				],

				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .react-heading  span.watermark' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mark_postition_top_bottom',
			[
				'label' => esc_html__('Watermark Top/Bottom Position', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => -400,
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

				],

				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .react-heading  span.watermark' => 'top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'mark_width',
			[
				'label' => esc_html__('Watermark Text Custom Width', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 1,
						'max' => 1500,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => 'px',

				],

				'separator' => 'before',
				'selectors' => [
					'{{WRAPPER}} .react-heading span.watermark' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'content',
			[
				'label'   => esc_html__('Description', 'rtelements'),
				'type'    => Controls_Manager::WYSIWYG,
				'rows'    => 10,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__('Alignment', 'rtelements'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'rtelements'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'rtelements'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'rtelements'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'rtelements'),
						'icon' => 'eicon-text-align-justify',
					]
				],
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .react-heading' => 'text-align: {{VALUE}}',
					'{{WRAPPER}} .image-heading' => 'justify-content: {{VALUE}}',
				]
			]
		);





		$this->end_controls_section();

		$this->start_controls_section(
			'content_section_button',
			[
				'label' => esc_html__('Button Info', 'rtelements'),
				'tab' => Controls_Manager::TAB_CONTENT,

			]
		);
		$this->add_control(
			'button',
			[
				'label' => esc_html__('Button', 'rsaddon'),
				'type' => Controls_Manager::HEADING,
			]
		);


		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__('Button Text', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('', 'rsaddon'),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__(' Button Link', 'rsaddon'),
				'type' => Controls_Manager::URL,
				'label_block' => true,
			]
		);

		$this->add_control(
			'show_icon',
			[
				'label' => esc_html__('Show Icon', 'rsaddon'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'rsaddon'),
				'label_off' => esc_html__('Hide', 'rsaddon'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);


		$this->add_control(
			'icon',
			[
				'label' => esc_html__('Icon', 'rsaddon'),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-arrow-right',
					'library' => 'solid',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);
		$this->add_control(
			'icon_enable_animation',
			[
				'label' => esc_html__('Enable Rotate', 'rtelements'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Yes', 'rtelements'),
				'label_off' => esc_html__('No', 'rtelements'),
				'return_value' => 'yes',
				'default' => 'label_off',				
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);
		$this->end_controls_section();



		$this->start_controls_section(
			'section_heading_style',
			[
				'label' => esc_html__('Heading Style', 'rtelements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'title_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Title', 'rtelements'),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__('Title Typography', 'rtelements'),
				'selector' => '{{WRAPPER}} .react-heading .title-inner .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Title Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .title-inner .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label' => esc_html__('Title Margin', 'rtelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .react-heading .title-inner .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'title_padding',
			[
				'label' => esc_html__('Title Padding', 'rtelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .react-heading .title-inner .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'highlight_title_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Secondary Heading', 'rtelements'),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'highlight_title_typography',
				'label' => esc_html__('Title Typography', 'rtelements'),
				'selector' => '{{WRAPPER}} .react-heading .title-inner .title span, {{WRAPPER}} .react-heading .title-inner .title .high_light_text',
			]
		);

		$this->add_control(
			'highlight_title_color',
			[
				'label' => esc_html__('Title Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .title-inner .title span' => 'color: {{VALUE}};',
					'{{WRAPPER}} .react-heading .title-inner .title .high_light_text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'sub_title_watermark',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Watermark', 'rtelements'),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'watermark_typography',
				'label' => esc_html__('Watermark Typography', 'rtelements'),
				'selector' => '{{WRAPPER}} .react-heading span.watermark',
			]
		);

		$this->add_control(
			'watermark_color',
			[
				'label' => esc_html__('Watermark Text Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading span.watermark' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'watermark_border_color',
			[
				'label' => esc_html__('Watermark Text Border Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading span.watermark' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'sub_title_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Sub Title', 'rtelements'),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'subtitle_typography',
				'label' => esc_html__('Subtitle Typography', 'rtelements'),
				'selector' => '{{WRAPPER}} .react-heading .title-inner .sub-text',
			]
		);

		$this->add_control(
			'subtitle_color',
			[
				'label' => esc_html__('Subtitle Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .title-inner .sub-text' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'subtitle_highlight_color',
			[
				'label' => esc_html__('Subtitle Highlight Background', 'rtelements'),
				// 'desc' => esc_html__( 'Add span tag to apply background style', 'rtelements' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .title-inner .sub-text span' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'subtitle_margin',
			[
				'label' => esc_html__('Subtitle Margin', 'rtelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .react-heading .title-inner .sub-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'des_style',
			[
				'type' => Controls_Manager::HEADING,
				'label' => esc_html__('Description', 'rtelements'),
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_typography',
				'label' => esc_html__('Description Typography', 'rtelements'),
				'selector' => '{{WRAPPER}} .react-heading .description p,.description',
			]
		);

		$this->add_control(
			'desc_color',
			[
				'label' => esc_html__('Description Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .description' => 'color: {{VALUE}};',
					'{{WRAPPER}} .react-heading .description p' => 'color: {{VALUE}};',
					'{{WRAPPER}} .react-heading .description p a' => 'color: {{VALUE}};',
					'{{WRAPPER}} .description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'desc_color_strong',
			[
				'label' => esc_html__('Description Strong Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .description strong' => 'color: {{VALUE}};',
					'{{WRAPPER}} .react-heading .description p strong' => 'color: {{VALUE}};',

				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'desc_sec_typography',
				'label' => esc_html__('Description Strong Typography', 'rtelements'),
				'selector' => '{{WRAPPER}} .react-heading .description strong',
			]
		);

		$this->add_responsive_control(
			'desc_margin',
			[
				'label' => esc_html__('Description Margin', 'rtelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .react-heading .description p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					'{{WRAPPER}}  .description' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'border_color',
				'label' => esc_html__('Border Color', 'elementor'),
				'types' => ['classic', 'gradient'],
				'exclude' => ['image'],
				'selector' => '{{WRAPPER}} .react-heading.style2:after',
				'fields_options' => [
					'background' => [
						'default' => 'classic',
					],
				],

			]
		);


		$this->add_responsive_control(
			'btn_styles',
			[
				'label' => esc_html__('Button Styles', 'rtelements'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'btn_color',
			[
				'label' => esc_html__('Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_hover_color',
			[
				'label' => esc_html__('Hover Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_text_typography',
				'selector' => '{{WRAPPER}} .react-heading .rt-button a',
			]
		);

		$this->add_responsive_control(
			'btn_padding',
			[
				'label' => esc_html__('Padding', 'rtelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_margin',
			[
				'label' => esc_html__('Margin', 'rtelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_border_normal_color',
			[
				'label' => esc_html__('Border Normal Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .under-line-btn::after' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'btn_border_hover_color',
			[
				'label' => esc_html__('Border Hover Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .under-line-btn:hover::before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_styles',
			[
				'label' => esc_html__('Button Icon Styles', 'rtelements'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);	

		$this->add_responsive_control(
			'btn_icon_color',
			[
				'label' => esc_html__('Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_hover_color',
			[
				'label' => esc_html__('Hover Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a:hover i' => 'color: {{VALUE}};',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);


		$this->add_responsive_control(
			'btn_icon_bg_color',
			[
				'label' => esc_html__('Backgorund Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a i' => 'background: {{VALUE}};',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_hover_bg_color',
			[
				'label' => esc_html__('Hover Backgorund Color', 'rtelements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a:hover i' => 'background: {{VALUE}};',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'btn_iocn_typography',
				'selector' => '{{WRAPPER}} .react-heading .rt-button a i',
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);
		$this->add_responsive_control(
			'btn_icon_padding',
			[
				'label' => esc_html__('Padding', 'rtelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a i' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_icon' => 'yes',
				],
			]
		);

		$this->add_responsive_control(
			'btn_icon_margin',
			[
				'label' => esc_html__('Margin', 'rtelements'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', 'em', '%'],
				'selectors' => [
					'{{WRAPPER}} .react-heading .rt-button a i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'show_icon' => 'yes',
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

		$settings = $this->get_settings_for_display();

		if($settings['animation_type'] == 'word' ){
			$animate_type = 'split_collab_words';
		}else {
			$animate_type = 'split_collab';
		}

		if($settings['animation_style'] == 'style1' ){
			$split_animation = 'skew-up';
		} elseif($settings['animation_style'] == 'style2' ) {
			$split_animation = $animate_type;
		} else {
			$split_animation = "";
		}


		$watermark_text = ($settings['watermark']) ? '<span class="watermark">'.($settings['watermark']).'</span>' : '';
		$animation_show = ($settings['enable_animation'] == 'yes') ? "$split_animation" : '';
		$main_title_secondary = !empty($settings['title_secondary']) ? '<span class="high_light_text">' . wp_kses_post($settings['title_secondary']) . '</span>' : '';
		
		$main_title = ($settings['title']) ? '<div class="' . $animation_show . '"><' . $settings['title_tag'] . ' class="title word-line">' . wp_kses_post($settings['title']) . $main_title_secondary .'</' . $settings['title_tag'] . '></div>' : '';

		$sub_text  = ($settings['subtitle'])  ? '<span class="sub-text word-line">' . ($settings['subtitle']) . '</span>' : '';
	

		// Fill $html var with data
		?>
		<div class="animation-<?php echo esc_attr($settings['animation_style']); ?> react-heading <?php echo esc_attr($settings['style']); ?>">
			<div class="title-inner <?php echo $settings['enable_stroke']; ?> bg_sub_text_<?php echo esc_attr($settings['enable_bg_style']); ?> double_sub_text_<?php echo esc_attr($settings['enable_border_ts_style']); ?>">
				<?php
					echo wp_kses_post($sub_text);
					echo wp_kses_post($main_title);								
				?>
			</div>
			<?php echo $watermark_text; ?>
			<?php if ($settings['content']) {
				$this->add_inline_editing_attributes('content', 'advanced');
				$this->add_render_attribute('content', 'class', 'description'); ?>
				<div <?php echo esc_attr($this->print_render_attribute_string('content')); ?>>
					<?php echo wp_kses_post($settings['content']); ?>
				</div>
			<?php } 
			?>
			<?php
			$rotate = !empty($settings['icon_enable_animation'] == 'yes') ? 'rotate_arrow' : '';			
			if (!empty($settings['btn_text'])) : ?>
				<div class="rt-button">
					<?php $target = $settings['btn_link']['is_external'] ? 'target=_blank' : ''; ?>
					<a class="under-line-btn readon react_button <?php echo esc_attr($rotate); ?>" href="<?php echo esc_url($settings['btn_link']['url']); ?>" <?php echo esc_attr($target); ?>>
						<span <?php echo esc_attr($this->print_render_attribute_string('btn_text')); ?>><?php echo esc_html($settings['btn_text']); ?></span>
						<?php \Elementor\Icons_Manager::render_icon($settings['icon'], ['aria-hidden' => 'true']); ?>
					</a>
				</div>
			<?php endif; ?>
		</div>			
	<?php
	}
} ?>