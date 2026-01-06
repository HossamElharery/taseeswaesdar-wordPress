<?php
/**
 * Image widget class
 *
 */
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class Reactheme_Featured_Image_Showcase_Widget extends \Elementor\Widget_Base {
    /**    
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name() {
        return 'react-featured-image';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title() {
        return esc_html__( 'RT Featured Image', 'rsaddon' );
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-image';
    }


    public function get_categories() {
        return [ 'pielements_category' ];
    }

    public function get_keywords() {
        return [ 'logo', 'clients', 'brand', 'parnter', 'image' ];
    }
    protected function register_controls() {   

        $this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'rtelements' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'image_type',
			[
				'label'   => esc_html__( 'Type', 'rsaddon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'featured',				
				'options' => [
					'featured' => esc_html__('Post Featured', 'rsaddon'),
					'custom' => esc_html__('Custom', 'rsaddon')					
				],											
			]
		);

		$this->add_control(
            'custom_image',
            [
                'label' => esc_html__('Image', 'rtelements'),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
				'condition' => [
					'image_type' => 'custom'
				]
            ]
        );    

        $this->add_group_control(
			\Elementor\Group_Control_Image_Size::get_type(),
			[
				'name' => 'thumbnail', 
				'exclude' => [ 'custom' ],
				'include' => [],
				'default' => 'full',
			]
		);
		$this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();   
		$type = $settings['image_type'];

        ?>
        <div class="feature-image-wrapper">
            <?php 
			if($type != 'custom'){
				the_post_thumbnail($settings['thumbnail_size']); 
			}else{
				echo \Elementor\Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'custom_image' );
			}
			?>
        </div>
        <?php
    }
}
