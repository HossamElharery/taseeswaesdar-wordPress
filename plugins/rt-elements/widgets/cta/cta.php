<?php
use Elementor\Group_Control_Css_Filter;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Background;

defined( 'ABSPATH' ) || die();

class RTS_CTA_Widget extends \Elementor\Widget_Base {

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
	public function get_name() {
		return 'rt-cta';
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
	public function get_title() {
		return esc_html__( 'RT CTA', 'rtaddon' );
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
	public function get_icon() {
		return 'glyph-icon flaticon-error';
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
	public function get_categories() {
        return [ 'pielements_category' ];
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
	public function get_keywords() {
		return [ 'button' ];
	}

	/**
	 * Register counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_cta',
			[
				'label' => esc_html__( 'CTA Settings', 'rtaddon' ),
			]
		);				

		$this->add_control(
		    'image',
		    [
		        'label' => esc_html__('Image', 'rtelements'),
		        'type' => Controls_Manager::MEDIA,
		    ]
		);

        $this->add_control(
			'sub_cta_title',
			[
				'label' => esc_html__( 'CTA Sub Title', 'rtaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Sub Title', 'rtaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
            'sub_title_color',
            [
                'label' => esc_html__( 'Sub Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-cta .rt-cta-wrap h6' => 'color: {{VALUE}};',                    
                ],                
            ]            
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'sub_title_typography',
                'label' => esc_html__( 'Sub Title Typography', 'rtelements' ),
                'selector' => '{{WRAPPER}} .rt-cta .rt-cta-wrap h6',                    
            ]
        );

		$this->add_control(
			'cta_title',
			[
				'label' => esc_html__( 'CTA Title', 'rtaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => esc_html__( 'Title', 'rtaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Title Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .rt-cta .rt-cta-wrap h3' => 'color: {{VALUE}};',                    
                ],                
            ]            
        );

		$this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => esc_html__( 'Title Typography', 'rtelements' ),
                'selector' => '{{WRAPPER}} .rt-cta .rt-cta-wrap h3',                    
            ]
        );


		$this->add_control(
            'button',
            [
                'label' => esc_html__( 'Button', 'rtaddon' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

		
		$this->add_control(
			'btn_text',
			[
				'label' => esc_html__( 'Button Text', 'rtaddon' ),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'default' => esc_html__('Send Message', 'rtaddon'),
				'placeholder' => esc_html__( 'Button Text', 'rtaddon' ),
				'separator' => 'before',
			]
		);

		$this->add_control(
			'btn_link',
			[
				'label' => esc_html__( ' Button Link', 'rtaddon' ),
				'type' => Controls_Manager::URL,
				'label_block' => true,						
			]
		);


		$this->add_responsive_control(
            'wrap_padding',
            [
                'label' => esc_html__( 'Padding', 'rtelements' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .rt-cta .rt-cta-wrap' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
	protected function render() {	
		$settings = $this->get_settings_for_display();
        ?>

		<div class="rt-cta jarallax">
	    	<?php 
			if ( ! empty( $settings['image']['url'] ) ) { ?>    		        
			    <img class="jarallax-img" src="<?php echo esc_url( $settings['image']['url'] ); ?>" alt="image">    		        
			<?php }
			?>					
        	<div class="rt-cta-wrap"> 
	        	<h6><?php echo esc_attr ($settings['sub_cta_title']);?></h6>
	        	<?php if(!empty($settings['cta_title'])):?>		
	           	<h3><?php echo wp_kses_post($settings['cta_title']);?></h3>
	            <?php endif;?>

	           <?php $target = $settings['btn_link']['is_external'] ? 'target=_blank' : ''; ?>
	           <a class="react_button" href="<?php echo esc_url($settings['btn_link']['url']);?>" <?php echo esc_attr($target);?>>
					<?php echo esc_html($settings['btn_text']);?> <i aria-hidden="true" class="rt rt-arrow-up-right"></i>
				</a>
	        </div> 
		</div>   

		<script type="text/javascript"> 
		    jQuery(document).ready(function($){
		        function initJarallax() {
		            if (typeof jarallax !== 'undefined' && $('.jarallax-img').length) { 
		                jarallax(document.querySelectorAll('.jarallax'));
		                jarallax(document.querySelectorAll('.jarallax-img'), {
		                    keepImg: true,
		                });
		            }
		        }

		        // Run on frontend load
		        initJarallax();

		        // Run in Elementor editor mode
		        if (typeof elementorFrontend !== 'undefined' && elementorFrontend.isEditMode()) {
		            elementorFrontend.hooks.addAction('frontend/element_ready/rt-cta.default', function($scope){
		                initJarallax();
		            });
		        }
		    });
		</script>
	<?php 
	}
}