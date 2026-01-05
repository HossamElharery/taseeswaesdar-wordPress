<?php
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

defined('ABSPATH') || die();

class Reactheme_Elementor_Services_Grid_Widget extends \Elementor\Widget_Base
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
		return 'rt-service-grid';
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
		return esc_html__('RT Services', 'rtelements');
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
		return 'glyph-icon flaticon-support';
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
		return ['pielements_category'];
	}


	/**
	 * Register services widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{


		$this->start_controls_section(
			'service_contents',
			[
				'label' => esc_html__('Content Settings', 'rtelements')
			]
		);

		$this->add_control(
			'service_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 1,				
				'options' => [
					1 => 'Style 1',
					2 => 'Style 2',
				],											
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => esc_html__( 'Icon', 'rtelements' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'far fa-clock',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-solid' => [
						'circle',
						'dot-circle',
						'square-full',
					],
					'fa-regular' => [
						'circle',
						'dot-circle',
						'square-full',
					],
				],
			]
		);	

		$this->add_control(
            'number',
            [
                'label' => esc_html__( 'Number', 'rtelements' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( '01', 'rtelements' ),
            ]
        );

		$this->add_control(
            '_image',
            [
                'label' => esc_html__('Image', 'rtelements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

		$this->add_control(
            'service-title',
            [
                'label' => esc_html__( 'Title', 'rtelements' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Strategic Solutions', 'rtelements' ),
            ]
        );

		$this->add_control(
            'service-des',
            [
                'label' => esc_html__( 'Description', 'rtelements' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXTAREA,
                'default' => esc_html__( 'Business consultancy enables companies to stay competitive in a rapidly evolving digital landscape, ultimately leading to increased efficiency...', 'rtelements' ),
            ]
        );        


        $this->add_control(
            'service-btn',
            [
                'label' => esc_html__( 'Button Text', 'rtelements' ),
                'label_block'=> true,
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__( 'Read More', 'rtelements' ),
            ]
        );

        $this->add_control(
            'service-url',
            [
                'label' => esc_html__( 'Button URL', 'rtelements' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'Insert your link'
            ]
        );			
		$this->end_controls_section();
	}

	/**
	 * Render counter widget output in the editor.
	 *
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	/**
	 * Render counter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$placeholder = Utils::get_placeholder_image_src();
		$imgId = $settings['_image']['id'];
		if( !empty($imgId) ){
			$img_link = wp_get_attachment_image_src($imgId, 'large')[0];
		}else{
			$img_link = $placeholder;
		}
		
		if ($settings['service_grid_style'] == 1) {
			include plugin_dir_path(__FILE__)."/style1.php";			
		} elseif ($settings['service_grid_style'] == 2) {
			include plugin_dir_path(__FILE__)."/style2.php";			
		} else {
			include plugin_dir_path(__FILE__)."/style1.php";		
		}
	}
}