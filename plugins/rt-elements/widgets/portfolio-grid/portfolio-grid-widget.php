<?php
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Reactheme_Portfolio_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'rt-portfolio-grid';
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
		return __( 'RT Portfolio Grid', 'rtelements' );
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
		return 'glyph-icon flaticon-grid';
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

	
	/**
	 * Register rsgallery widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {


		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content Settings', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);


		$this->add_control(
			'portfolio_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rtelements' ),
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
				'label'   => esc_html__( 'Category', 'rtelements' ),
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
                'label' => esc_html__( 'Title Word Count', 'rtelements' ),
                'type' => Controls_Manager::NUMBER,   
                'placeholder' => esc_html__( '5', 'rtelements' ),
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


		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Project Show Per Page', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'default' => -1,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'show_filter',
			[
				'label'   => esc_html__('Show Filter', 'rsaddon'),
				'type'    => Controls_Manager::SELECT,
				'default' => 'filter_hide',
				'separator' => 'before',
				'options' => [
					'filter_show' => 'Show',
					'filter_hide' => 'Hide',
				],
			]
		);

		$this->add_control(
			'filter_title',
			[
				'label' => esc_html__('Filter Default Title', 'rsaddon'),
				'type' => Controls_Manager::TEXT,
				'default' => 'All',
				'condition' => [
					'show_filter' => 'filter_show',
				],

				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
		    'filter_alignment',
		    [
		        'label'     => __( 'Alignment', 'rtelements' ),
		        'type'      => Controls_Manager::SELECT,
		        'default'   => 'center',
		        'options'   => [
		            'flex-start' => __( 'Start', 'rtelements' ),
		            'center'     => __( 'Center', 'rtelements' ),
		            'flex-end'   => __( 'End', 'rtelements' ),
		        ],
		        'selectors' => [
		            '{{WRAPPER}} .nav.portfolio-filter' => 'display: flex; justify-content: {{VALUE}};',
		        ],
		    ]
		);
		

		$this->add_control(
			'portfolio_columns',
			[
				'label'   => esc_html__( 'Columns', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,				
				'options' => [
					'6' => esc_html__( '2 Column', 'rtelements' ),
					'4' => esc_html__( '3 Column', 'rtelements' ),
					'3' => esc_html__( '4 Column', 'rtelements' ),
					'2' => esc_html__( '6 Column', 'rtelements' ),
					'12' => esc_html__( '1 Column', 'rtelements' ),					
				],
				'separator' => 'before',							
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'label' => esc_html__( 'Title Typography', 'rtelements' ),
				'selector' => '{{WRAPPER}} .rt-portfolio-style1 .portfolio-item .portfolio-img .port-content-part .p-title',            
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
            'nav_color',
            [
                'label' => esc_html__( 'Nav Color', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter button' => 'color: {{VALUE}};',   
                ],                
            ]
        );
        $this->add_control(
            'nav_color_hover',
            [
                'label' => esc_html__( 'Nav Color (Hover)', 'rtelements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter button:hover' => 'color: {{VALUE}};',   
                ],                
            ]
        );

        $this->add_responsive_control(
		    'filter_padding',
		    [
		        'label'      => esc_html__( 'Padding', 'rtelements' ),
		        'type'       => \Elementor\Controls_Manager::DIMENSIONS,
		        'size_units' => [ 'px', '%', 'em', 'rem' ],
		        'selectors'  => [
		            '{{WRAPPER}} .portfolio-filter button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
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
	protected function render() {

	$tabs = $this->get_settings_for_display('tabs');  
    $settings = $this->get_settings_for_display();  
    $id_int = substr( $this->get_id_int(), 0, 3 ); 
    $select_cat = $settings['portfolio_category'];
    ?>
    
    <div class="rt-portfolio-style1">
	    <div class="container">
	        <div class="nav portfolio-filter" id="v-pills-tab">
	            <?php
	            $unique = rand(2012, 3554120);
	            $active_class = 'active';
	            ?>
	            <button class="nav-link <?php echo esc_attr($active_class); ?>" data-bs-toggle="pill" data-bs-target="#v-all-<?php echo esc_attr($unique); ?>" type="button" role="tab" aria-controls="v-all-<?php echo esc_attr($unique); ?>" aria-selected="true">
	                <?php echo esc_html($settings['filter_title']); ?>
	            </button>

	            <?php
	            $taxonomy = "rt-portfolio-category";
	            $selected_categories = $settings['portfolio_category'];
	            if (!empty($select_cat)) {
	            foreach ($selected_categories as $catid) {
	                $term = get_term_by('slug', $catid, $taxonomy);
	                $term_name  = $term->name;
	                $term_slug  = $term->slug;
	                ?>
	                <button class="nav-link" data-bs-toggle="pill" data-bs-target="#v-<?php echo esc_attr($term_slug . $unique); ?>" type="button" role="tab" aria-controls="v-<?php echo esc_attr($term_slug . $unique); ?>" aria-selected="false">
	                    <?php echo esc_html($term_name); ?>
	                </button>
	            <?php } }?>
	        </div>
	    </div>

	    <div class="tab-content" id="v-pills-tabContent">
	        <!-- Display content for all categories -->
	        <div class="tab-pane fade show <?php echo esc_attr($active_class); ?>" id="v-all-<?php echo esc_attr($unique); ?>" role="tabpanel">
	            <div class="row portfolio-grid">
	                <?php
	                $args = array(
	                    'post_type'      => 'rt-portfolios',
	                    'posts_per_page' => $settings['per_page'],
	                );
	                $all_wp = new WP_Query($args);

	                while ($all_wp->have_posts()) : $all_wp->the_post();
	                    $termsArray = get_the_terms(get_the_ID(), "rt-portfolio-category");
	                    $termsString = "";

	                    if (!empty($termsArray)) {
	                        foreach ($termsArray as $term) {
	                            $termsString .= 'filter_' . $term->slug . ' ';
	                        }
	                    }
	                    ?>
	                    <div class="col-lg-<?php echo esc_html($settings['portfolio_columns']); ?> col-md-6 col-xs-1 grid-item <?php echo esc_attr($termsString); ?>">
	                        <div class="portfolio-item">
	                            <?php if (has_post_thumbnail()) : ?>
	                                <div class="portfolio-img">
	                                    <a href="<?php the_permalink(); ?>">
	                                        <?php the_post_thumbnail($settings['thumbnail_size']); ?>
	                                    </a>
	                                    <div class="port-content-part">
	                                        <div class="vertical-middle-cell">
	                                            <?php if (get_the_title()) : ?>
	                                                <h4 class="p-title">
	                                                    <a href="<?php the_permalink(); ?>">
	                                                        <?php
	                                                        $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : 14;
	                                                        echo esc_html(wp_trim_words(get_the_title(), $length, ''));
	                                                        ?>
	                                                    </a>
	                                                </h4>
	                                            <?php endif; ?>
	                                        </div>
	                                        <div class="btn-part">
	                                            <a class="read-btn" href="<?php the_permalink(); ?>">
	                                                <i class="rt rt-arrow-up-right"></i>
	                                            </a>
	                                        </div>
	                                    </div>
	                                </div>
	                            <?php endif; ?>
	                        </div>
	                    </div>
	                <?php endwhile; ?>
	                <?php wp_reset_postdata(); ?>
	            </div>
	        </div>

	        <?php
			// Ensure $selected_categories is an array
			if ( ! is_array( $selected_categories ) ) {
			    // If it's not an array but a single value (e.g., int or string), wrap it in an array
			    $selected_categories = (array) $selected_categories;
			}

			foreach ( $selected_categories as $catid ) {
			    // Get the term by slug
			    $term = get_term_by( 'slug', $catid, $taxonomy );

			    // Make sure $term is valid before proceeding
			    if ( $term ) {
			        $term_slug = esc_attr( $term->slug );
			        $active_class = ''; // You can add conditions to set active class

			        // WP Query arguments for the portfolio category
			        $args = array(
			            'post_type'      => 'rt-portfolios',
			            'posts_per_page' => $settings['per_page'],
			            'tax_query'      => array(
			                array(
			                    'taxonomy' => 'rt-portfolio-category',
			                    'field'    => 'slug',
			                    'terms'    => $term_slug,
			                ),
			            ),
			        );

			        $category_wp = new WP_Query( $args );
			        ?>

			        <div class="tab-pane fade <?php echo esc_attr( $active_class ); ?>" id="v-<?php echo esc_attr( $term_slug . $unique ); ?>" role="tabpanel">
			            <div class="row portfolio-grid">
			                <?php
			                while ( $category_wp->have_posts() ) : $category_wp->the_post();
			                    ?>
			                    <div class="col-lg-<?php echo esc_html( $settings['portfolio_columns'] ); ?> col-md-6 col-xs-1 grid-item filter_<?php echo esc_attr( $term_slug ); ?>">
			                        <div class="portfolio-item">
			                            <?php if ( has_post_thumbnail() ) : ?>
			                                <div class="portfolio-img">
			                                    <a href="<?php the_permalink(); ?>">
			                                        <?php the_post_thumbnail( $settings['thumbnail_size'] ); ?>
			                                    </a>
			                                    <div class="port-content-part">
			                                        <div class="vertical-middle-cell">
			                                            <?php if ( get_the_title() ) : ?>
			                                                <h4 class="p-title">
			                                                    <a href="<?php the_permalink(); ?>">
			                                                        <?php
			                                                        $length = ! empty( $settings['title_word_count'] ) ? $settings['title_word_count'] : 14;
			                                                        echo esc_html( wp_trim_words( get_the_title(), $length, '' ) );
			                                                        ?>
			                                                    </a>
			                                                </h4>
			                                            <?php endif; ?>
			                                        </div>
			                                        <div class="btn-part">
			                                            <a class="read-btn" href="<?php the_permalink(); ?>">
			                                                <i class="rt rt-arrow-up-right"></i>
			                                            </a>
			                                        </div>
			                                    </div>
			                                </div>
			                            <?php endif; ?>
			                        </div>
			                    </div>
			                <?php endwhile; ?>
			                <?php wp_reset_postdata(); ?>
			            </div>
			        </div>
			        <?php
			    } // end if $term
			} // end foreach
			?>

	    </div>
	</div>
	<?php	

	}
public function getCategories(){
    $cat_list = [];
     	if ( post_type_exists( 'rt-portfolios' ) ) { 
      	$terms = get_terms( array(
         	'taxonomy'    => 'rt-portfolio-category',
         	'hide_empty'  => true            
     	) );
        
        foreach($terms as $post) {
        	$cat_list[$post->slug]  = [$post->name];
        }
	}  
    return $cat_list;
}
}?>