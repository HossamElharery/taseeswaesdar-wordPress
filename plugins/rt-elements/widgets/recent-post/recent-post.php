<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

if (!defined('ABSPATH')) {
    exit;   // Exit if accessed directly.
}

/**
 * HFE Search Button.
 *
 * HFE widget for Search Button.
 *
 * @since 1.5.0
 */
class RTS_recent_post_list_ extends Widget_Base{
    /**
     * Retrieve the widget name.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name()
    {
        return 'rt-recent-post';
    }

    /**
     * Retrieve the widget title.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title()
    {
        return __('RT Recent Post List', 'rtelements');
    }

    /**
     * Retrieve the widget icon.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'glyph-icon flaticon-blogging';
    }

    /**
     * Retrieve the list of categories the widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * Note that currently Elementor supports only one category.
     * When multiple categories passed, Elementor uses the first one.
     *
     * @since 1.5.0
     *
     * @access public
     *
     * @return array Widget categories.
     */
    public function get_categories()
    {
        return ['pielements_category'];
    }

    /**
     * Retrieve the list of scripts the navigation menu depended on.
     *
     * Used to set scripts dependencies required to run the widget.
     *
     * @since 1.5.0
     * @access public
     *
     * @return array Widget scripts dependencies.
     */


    /**
     * Register Search Button controls.
     *
     * @since 1.5.7
     * @access protected
     */
    /**
     * Register Search General Controls.
     *
     * @since 1.5.0
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
    }
    /**
     * Render Search button output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function render(){
        $settings = $this->get_settings_for_display();
        ?>       

        <div class="blog-gird-item">
            <?php
                $cat = $settings['category'];     
                if(empty($cat)){
                    $best_wp = new wp_Query(array(
                        'post_type'      => 'post',
                        'posts_per_page' => $settings['per_page'],        
                    ));   
                }   
                else{
                    $best_wp = new wp_Query(array(
                        'post_type'      => 'post',
                        'posts_per_page' => $settings['per_page'],
                        'tax_query'      => array(
                            array(
                                'taxonomy' => 'category',
                                'field'    => 'slug', 
                                'terms'    => $cat 
                            ),
                        )
                    ));   
                }
                
                while($best_wp->have_posts()): $best_wp->the_post(); 
    
                $full_date      = get_the_date();


                if(!empty($settings['blog_word_show'])){
                    $limit = $settings['blog_word_show'];
                }
                else{
                    $limit = 20;
                } ?>                            
                
                <div class="grid-item <?php echo esc_html($col);?> <?php echo esc_attr($termsString);?>">
                    <div class="single-blog-list">
                        <div class="rt-image-wrapper"> 
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink() ?>" class="thumbnail">
                                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="rt-content-wrapper">           
                            <div class="rt-content-wrapper-inner">           
                                <h6 class="title">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php
                                        $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : 22;
                                        echo esc_html(wp_trim_words(get_the_title(), $length, ''));
                                        ?>
                                    </a>
                                </h6>           
                                <span class="date-icon"><i class="rt-clock-regular"></i> <?php echo get_the_date(); ?></span>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                endwhile;
                wp_reset_query();  
            ?>                          
    </div>                
        
<?php
    }
}
