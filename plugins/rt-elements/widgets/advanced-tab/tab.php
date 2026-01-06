<?php
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;

defined( 'ABSPATH' ) || die();

class ReacThemes_Advance_Tab_Widget extends \Elementor\Widget_Base {
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
        return 'rs-tab-advanced';
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
        return esc_html__( 'RT Advance Tab', 'rsaddon' );
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
        return 'glyph-icon flaticon-tabs-1';
    }


    public function get_categories() {
        return [ 'rsaddon_category' ];
    }

    public function get_keywords() {
        return [ 'tab', 'vertical', 'icon', 'horizental' ];
    }

	protected function register_controls() {
        $category_dropdown[0] = 'Select Template';
        $best_wp = new wp_Query(array(
        'post_type'      => 'rselements_pro',
        'posts_per_page' => -1
                                         
        ));  

         while($best_wp->have_posts()): $best_wp->the_post(); 

            $title = get_the_title();
            $id = get_the_ID();
            $category_dropdown[$id] = $title;

         endwhile; 
         wp_reset_query();  
      

        $this->start_controls_section(
            'section_tabs',
            [
                'label' => esc_html__( 'Tabs', 'rsaddon' ),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__( 'Title & Description', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__( 'Tab Title', 'rsaddon' ),
                'placeholder' => esc_html__( 'Tab Title', 'rsaddon' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_subtitle',
            [
                'label'       => esc_html__( 'Sub Title', 'rsaddon' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'sub title', 'rsaddon' ),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'content_location',
            [
                'label'       => esc_html__( 'Select Content Location', 'rsaddon' ),
                'label_block' => true,
                'type'        => Controls_Manager::SELECT,
                'default'     => 'editor',               
                'options' => [
                    'editor'    => 'Editor',
                    'templates' => 'Templates',                                
                ],                                          
            ]
        );

        $repeater->add_control(
            'template',
            [
                'label'       => esc_html__( 'Template', 'rsaddon' ),
                'type'        => Controls_Manager::SELECT, 
                'label_block' => true,
                'default'     => 0,         
                'options' => [      
                        
                ]+ $category_dropdown,                
                'separator' => 'before', 
                'condition' => [
                    'content_location' => 'templates',
                ],      
            ]
        );
 

        $repeater->add_control(
            'tab_content',
            [
                'label'       => esc_html__( 'Content', 'rsaddon' ),
                'default'     => esc_html__( 'Tab Content', 'rsaddon' ),
                'placeholder' => esc_html__( 'Tab Content', 'rsaddon' ),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
                 'condition' => [
                    'content_location' => 'editor',
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'  => esc_html__( 'Tabs Items', 'rsaddon' ),
                'type'   => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [

                        'tab_title'   => esc_html__( 'Tab #1', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],
                    [
                        'tab_title'   => esc_html__( 'Tab #2', 'rsaddon' ),
                        'tab_content' => esc_html__( 'Ohh your data click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],

                    [
                        'tab_title'   => esc_html__( 'Tab #3', 'rsaddon' ),
                        'tab_content' => esc_html__( 'You can Click edit/delete button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.With thousands of Flash Components, Files and Templates, Star & Shield is the largest library of stock Flash online. Starting at just $2 and by a huge community.', 'rsaddon' ),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => esc_html__( 'View', 'rsaddon' ),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->add_control(
            'tabs_item_width',
            [
                'label' => esc_html__( 'Tab Menu Item Full', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'full_tab_item',
                'options' => [
                    'full_tab_item' => esc_html__( 'Yes', 'rsaddon' ),
                    'no_item_menu' => esc_html__( 'No', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'type',
            [
                'label' => esc_html__( 'Type', 'rsaddon' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [
                    'horizontal' => esc_html__( 'Horizontal', 'rsaddon' ),
                    'vertical' => esc_html__( 'Vertical', 'rsaddon' ),
                ],                
                'separator' => 'before',
            ]
        );
        $this->end_controls_section();
    }

    /**
     * Render tabs widget output on the frontend.
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


        ?>
        <div class="abouttabarea">        
            <ul class="nav about__button__wrap" id="v-pills-tab" role="tablist" aria-orientation="<?php echo $settings['type'];?>">
                <?php
                $unique = rand(2012,3554120);
                $x = 0;
                $y = 1;
                foreach ( $tabs as $index => $item ) :
                    $x++;
                    $span = $y++;

                    if($x == 1){
                        $active_tab = 'active';
                    }else{
                        $active_tab = '';
                    }

                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key( 'tab_title', 'tabs', $index );

                    $this->add_render_attribute( $tab_title_setting_key, [
                        'id' => 'elementor-tab-title-' . $id_int . $tab_count,
                        'class' => [ 'elementor-tab-title', 'elementor-tab-desktop-title' ],
                        'data-tab' => $tab_count,
                        'role' => 'tab',
                        'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                    ] );

                    $icon = !empty($item['tab_icon']) ? '<i class="'.$item['tab_icon'].'"></i>': '';
                    
                    $titleimg    = !empty($item['selected_image']['url']) ? '<img src="'. $item['selected_image']['url']. '" />' : '';

                    $subtitle = !empty($item['tab_subtitle']) ? $item['tab_subtitle'] : NULL;                   
                
                    ?>           

                    <li class="nav-item">
                        <button class="nav-link single__tab__link <?php echo $active_tab;?>" id="v-pills<?php echo esc_html($x);?><?php echo esc_html($unique);?>" data-bs-toggle="pill" data-bs-target="#v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" type="button" role="tab" aria-controls="v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" aria-selected="false">                            
                            <div class="button_content">
                                <?php echo esc_html($item['tab_title']); ?>
                                <?php if(!empty($subtitle)) : ?><p class="subtitle"><?php echo esc_html($subtitle); ?></p><?php endif; ?>
                            </div>
                        </button>
                    </li>   
                <?php endforeach; ?>                               
            </ul>

            <div class="tab-content" id="v-pills-tabContent">            
                <?php
                    $x = 0;
                    foreach ( $tabs as $index => $item ) :
                        $tab_count = $index + 1;
                        $x++;
                        if($x == 1){
                            $active_tab = 'active show';
                        }else{
                            $active_tab = '';
                        }
                        $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

                        $tab_title_mobile_setting_key = $this->get_repeater_setting_key( 'tab_title_mobile', 'tabs', $tab_count );

                        $this->add_render_attribute( $tab_content_setting_key, [
                            'id' => 'elementor-tab-content-' . $id_int . $tab_count,
                            'class' => [ 'elementor-tab-content', 'elementor-clearfix' ],
                            'data-tab' => $tab_count,
                            'role' => 'tabpanel',
                        ] );

                        $this->add_render_attribute( $tab_title_mobile_setting_key, [
                            'class' => [ 'elementor-tab-title', 'elementor-tab-mobile-title' ],
                            'data-tab' => $tab_count,
                            'role' => 'tab',
                        ] );

                        $this->add_inline_editing_attributes( $tab_content_setting_key, 'advanced' );                       
                        ?>                
                    
                        <div class="tab-pane fade <?php echo esc_attr($active_tab);?>" id="v-<?php echo esc_html($x);?><?php echo esc_html($unique);?>" role="tabpanel">
                        <!-- start tab content -->
                        <div class="rts-tab-content-one">
                            <?php echo $this->parse_text_editor( $item['tab_content'] ); ?>                        
                        </div>
                        <!-- start tab content End -->                   
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}