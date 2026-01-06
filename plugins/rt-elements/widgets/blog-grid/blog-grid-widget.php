<?php

use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Border;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Utils;

defined( 'ABSPATH' ) || die();

class ReacTheme_Elementor_Blog_Grid_Widget extends \Elementor\Widget_Base {

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
		return 'react-blog';
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
		return esc_html__( 'RT Blog Grid', 'rtelements' );
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
		return 'glyph-icon flaticon-blogging';
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

		$post_categories = get_terms( 'category' );

        $post_options = [];
        foreach ( $post_categories as $category ) {
            $post_options[ $category->slug ] = $category->name;
        }


		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content Settings', 'rtelements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'blog_grid_style',
			[
				'label'   => esc_html__( 'Select Style', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style1',
				'options' => [					
                    'style1' => esc_html__( 'Style 1', 'rtelements'),
				],
			]
		);
      

		$this->add_control(
			'category',
			[
				'label'   => esc_html__( 'Category', 'rtelements' ),				
				'type'        => Controls_Manager::SELECT2,
                'options'     => $post_options,
                'default'     => [],
				'multiple' => true,	
				'separator' => 'before',		
			]

		);
	
		$this->add_control(
			'blog_columns',
			[
				'label'   => esc_html__( 'Desktops > 1199px', 'rtelements' ),
				'type'    => Controls_Manager::SELECT,
                'default' => 3,			
				'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),				
				],
				'separator' => 'before',							
			]
		);
        $this->add_control(
            'col_md',
            [
                'label'   => esc_html__('Laptop > 991px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 3,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',

            ]

        );

        $this->add_control(
            'col_sm',
            [
                'label'   => esc_html__('Tablets > 767px', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 1,
                'options' => [
                    '1' => esc_html__('1 Column', 'rtelements'),
                    '2' => esc_html__('2 Column', 'rtelements'),
                    '3' => esc_html__('3 Column', 'rtelements'),
                    '4' => esc_html__('4 Column', 'rtelements'),
                    '5' => esc_html__('5 Column', 'rtelements'),
                    '6' => esc_html__('6 Column', 'rtelements'),
                ],
                'separator' => 'before',
            ]
        );


		$this->add_control(
			'per_page',
			[
				'label' => esc_html__( 'Blog Show Per Page', 'rtelements' ),
				'type' => Controls_Manager::TEXT,
				'default' => esc_html__( '6', 'rtelements' ),
				'separator' => 'before',
                'placeholder' => esc_html__( '5', 'rtelements' ),
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

        $this->add_control(
            'post_offset',
            [
                'label' => esc_html__( 'Offset', 'rtelements' ),
                'type' => Controls_Manager::TEXT,                
                'separator' => 'before',
                'placeholder' => esc_html__( '5', 'rtelements' ),
            ]
        );       

        $this->add_control(
            'blog_word_show',
            [
                'label' => esc_html__( 'Show Content Limit', 'rtelements' ),
                'type' => Controls_Manager::TEXT,
                'placeholder' => esc_html__( '20', 'rtelements' ),
                'separator' => 'before',
                'condition' => [
                    'blog_content_show_hide' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'author_by_text',
            [
                'label' => esc_html__( 'By Text', 'rtelements' ),
                'type' => Controls_Manager::TEXT,         
                'separator' => 'before',
                'default' => 'by',
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
            'blog_pagination_show_hide',
            [
                'label' => esc_html__( 'Pagination Show / Hide', 'rtelements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'no',
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
        $col_lg          = 12 / $settings['blog_columns'] ;
        $col_md          = 12 / $settings['col_md'];
        $col_sm          = 12 / $settings['col_sm'];
        $length          = !empty($settings['title_word_count']) ? $settings['title_word_count'] : 22; 
        $col = 'col-lg-'.$col_lg.' col-md-'.$col_md.' col-sm-'.$col_sm.' col-12';    
        ?>

		<div class="rt-addon-grid">          
            <div class="row">
			 	<?php
                    if($settings['blog_grid_style'] == 'style1') {
                        include plugin_dir_path(__FILE__)."/style1.php";
                    } 
                ?>                            
            </div>   
                                 
            <?php 

                $blog_item_data = array(
                'per_page'  => $settings['per_page']
            );
            wp_localize_script( 'vloglab-main', 'blog_load_data', $blog_item_data );

			$paginate = paginate_links( array(
			    'total' => $best_wp->max_num_pages
			));

			if(!empty($paginate ) && ($settings['blog_pagination_show_hide'] == 'yes')){ ?>
				<div class="reactheme-pagination-area"><div class="nav-links"><?php echo wp_kses_post($paginate); ?></div></div>
			<?php } ?>              
		</div>
	   <?php

	}
}
\Elementor\Plugin::instance()->widgets_manager->register( new \ReacTheme_Elementor_Blog_Grid_Widget() );
?>