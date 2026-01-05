<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;

defined('ABSPATH') || die();

class Reactheme_Elementor_Video_Widget extends \Elementor\Widget_Base
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
		return 'react-video';
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
		return __('RT Video', 'pielements');
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
		return 'glyph-icon flaticon-multimedia';
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
		return ['video'];
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
			'section_counter',
			[
				'label' => esc_html__('Content', 'pielements'),
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => esc_html__('Title Alignment', 'pielements'),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__('Left', 'pielements'),
						'icon' => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__('Center', 'pielements'),
						'icon' => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__('Right', 'pielements'),
						'icon' => 'eicon-text-align-right',
					],
					'justify' => [
						'title' => esc_html__('Justify', 'pielements'),
						'icon' => 'eicon-text-align-justify',
					],
				],
				'default'     => 'center',
				'toggle' => true,
				'selectors' => [
					'{{WRAPPER}} .react-video' => 'text-align: {{VALUE}}'
				],
				'separator' => 'before',
			]
		);

		$this->add_control(
			'react_video_style',
			[
				'label'   => esc_html__('Select Video Style', 'pielements'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [
					'style1' => esc_html__('Style 1', 'pielements'),
					'style3' => esc_html__('Style 2', 'pielements'),
				],
			]
		);


		$this->add_control(
			'video_link',
			[
				'label' => esc_html__('Enter Link Here', 'pielements'),
				'type' => Controls_Manager::TEXT,
				'default'     => '#',
				'placeholder' => esc_html__('Video link here', 'pielements'),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'description',
			[
				'label' => esc_html__('Video Description', 'pielements'),
				'type' => Controls_Manager::TEXTAREA,
				'label_block' => true,
				'default'     => 'Add your video description here',
				'placeholder' => esc_html__('Add your video description here..', 'pielements'),
				'separator' => 'before',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Content', 'pielements'),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color_',
			[
				'label' => esc_html__('Title Color', 'pielements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-btn a' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'title_color_hover',
			[
				'label' => esc_html__('Text Color (Hover)', 'pielements'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .video-btn a:hover' => 'color: {{VALUE}};',
				],


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
	protected function render()
	{

		$settings = $this->get_settings_for_display();
		$rand = rand(12, 3330);
		$this->add_inline_editing_attributes('description', 'basic');
		$this->add_render_attribute('description', 'class', 'video-desc');
		?>
		<div class="react-video video-item-<?php echo esc_attr($rand); ?> <?php echo esc_html($settings['react_video_style']); ?>" <?php if (!empty($settings['image']['url'])) : ?>style="background: url(<?php echo esc_url($settings['image']['url']); ?>);" <?php endif; ?>>

			<?php if ($settings['react_video_style'] == 'style1') { ?>
				<div class="overly-border">
					<a class="popup-videos" href="<?php echo esc_url($settings['video_link']); ?>">
						<?php echo wp_kses_post($settings['description']); ?> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM10.6219 8.41459L15.5008 11.6672C15.6846 11.7897 15.7343 12.0381 15.6117 12.2219C15.5824 12.2658 15.5447 12.3035 15.5008 12.3328L10.6219 15.5854C10.4381 15.708 10.1897 15.6583 10.0672 15.4745C10.0234 15.4088 10 15.3316 10 15.2526V8.74741C10 8.52649 10.1791 8.34741 10.4 8.34741C10.479 8.34741 10.5562 8.37078 10.6219 8.41459Z"></path></svg>
					</a>
				</div>

			<?php } ?>

			<?php if ($settings['react_video_style'] == 'style3') { ?>
				<div class="video-btn">
					<a class="popup-videos" href="<?php echo esc_url($settings['video_link']); ?>">
						<span class="video-des"><?php echo wp_kses_post($settings['description']); ?></span>
						<span class="video-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM10.6219 8.41459L15.5008 11.6672C15.6846 11.7897 15.7343 12.0381 15.6117 12.2219C15.5824 12.2658 15.5447 12.3035 15.5008 12.3328L10.6219 15.5854C10.4381 15.708 10.1897 15.6583 10.0672 15.4745C10.0234 15.4088 10 15.3316 10 15.2526V8.74741C10 8.52649 10.1791 8.34741 10.4 8.34741C10.479 8.34741 10.5562 8.37078 10.6219 8.41459Z"></path></svg></span>
					</a>
				</div>
			<?php } ?>

			<?php if ($settings['react_video_style'] == 'style2') : ?>

				<div class="overly-border">
					<a class="popup-videos" href="<?php echo esc_url($settings['video_link']); ?>">
						<i class="fa fa-play"></i>
					</a>
				</div>
			<?php endif; ?>

		</div>


		<script type="text/javascript">
			jQuery(document).ready(function() {
				jQuery('.popup-videos').magnificPopup({
					disableOn: 700,
					type: 'iframe',
					mainClass: 'mfp-fade',
					removalDelay: 160,
					preloader: false,
					fixedContentPos: false
				});
			});	
		</script>

<?php
	}
}
