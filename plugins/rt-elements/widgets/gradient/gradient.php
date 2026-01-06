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

class Reactheme_Elementor_Gradient_Widget extends \Elementor\Widget_Base
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
		return 'react-gradient';
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
		return esc_html__('RT Gradient Box', 'rtelements');
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
			'gradient_sections',
			[
				'label' => esc_html__( 'Content', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'gradient_select',
			[
				'label'   => esc_html__('Select Style', 'rtelements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 1', 'rtelements'),
					'style2' => esc_html__('Style 2', 'rtelements'),

				],
			]
		);
		$this->end_controls_section();

		// ==========================Style====================================//

		$this->start_controls_section(
			'gradient_styles',
			[
				'label' => esc_html__( 'Style', 'rsaddon' ),
				'tab' => Controls_Manager::TAB_STYLE,
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
	protected function render() {
		$settings = $this->get_settings_for_display();
	?>

	<style>
		.box-one-top {
		    height: 622px;
		    width: 622px;
		    border-radius: 50px;
		    background: linear-gradient(0deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.8) 100%), #36D659;
		    filter: blur(200px);
		    z-index: -1;
		}
		.box-one-bottom {
		    height: 622px;
		    width: 622px;
		    border-radius: 50px;
		    background: linear-gradient(0deg, rgba(255, 255, 255, 0.8) 0%, rgba(255, 255, 255, 0.8) 100%), #614CE1;
		    filter: blur(200px);
		    z-index: -1;
		}
	</style>	

	<?php 
	if( $settings['gradient_select'] == 'style1' ) { ?>	
		<div class="box-one-top"></div>
	<?php 
	} elseif( $settings['gradient_select'] == 'style2' ) { ?>	
		<div class="box-one-bottom"></div>
	<?php 
	} else { ?>		
		<div class="box-one-top"></div>		
	<?php 
	} 



	}

}?>