<?php 
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Utils;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Plugin;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) {
	exit;   // Exit if accessed directly.
}

/**
 * HFE Site Logo widget
 *
 * HFE widget for Site Logo.
 *
 * @since 1.3.0
 */
class RTS_Offcanvas extends Widget_Base {

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'site-off-canvas';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Site OffCanvas', 'rtelements' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-menu-bar';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.3.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'header_footer_rts' ];
	}

	/**
	 * Register Site Logo controls.
	 *
	 * @since 1.5.7
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
            'section_general_fields',
            [
                'label' => __( 'Canvas Settings', 'rtelements'),
            ]
        );

		$this->add_control(
            'dot_icon_color',
            [
                'label'     => __( 'Off Canvas Icon Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '{{WRAPPER}} .offcanvas-icon .nav-menu-link.menu-button span' => 'background: {{VALUE}}',
                ],
                
            ]
        );

        $this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'background_icon_bg',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .offcanvas-icon .nav-menu-link.menu-button',
			]
		);

		$this->add_control(
            'dot_icon_color_box',
            [
                'label'     => __( 'Off Border Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '{{WRAPPER}} .offcanvas-icon .nav-menu-link.menu-button' => 'border-color: {{VALUE}}',
                ],
                
            ]
        );

        $this->add_responsive_control(
            '_box_width',
            [
                'label' => esc_html__('Width', 'rtelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-icon .nav-menu-link.menu-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            '_box_height',
            [
                'label' => esc_html__('Height', 'rtelements'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 400,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .offcanvas-icon .nav-menu-link.menu-button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );	
	}
	
	protected function render() {
		
		$settings = $this->get_settings_for_display(); ?>
		<div class="sidebarmenu-area text-right desktop">			
			<ul class="offcanvas-icon">
				<li class="nav-link-container"> 
					<a class="nav-menu-link menu-button">						
						<span class="rt-line1"></span>
						<span class="rt-line2"></span>						                                        
					</a> 
				</li>
			</ul>		
		</div>
	<?php
	}
}
