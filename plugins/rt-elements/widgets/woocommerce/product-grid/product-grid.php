<?php

/**
 * Elementor Product List.
 *
 * Elementor widget that inserts an embbedable content into the page, from any given URL.
 *
 * @since 1.0.0
 */

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Utils;

defined('ABSPATH') || die();

class Rsaddon_Elementor_Pro_Product_Grid_Widget extends \Elementor\Widget_Base
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
        return 'rts-product-lists';
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
        return __('RTS Porduct Grid', 'rsaddon');
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
        return 'glyph-icon flaticon-shopping-cart';
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
        return ['rsaddon_category'];
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
        return ['product', 'list', 'category'];
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
        // Content Controls
        $this->start_controls_section(
            'rs_section_product_grid_settings',
            [
                'label' => esc_html__('Product Settings', 'rsaddon'),
            ]
        );






        $this->add_control(
            'rs_product_grid_product_filter',
            [
                'label' => esc_html__('Filter By', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'recent-products',
                'options' => [
                    'recent-products'       => esc_html__('Recent Products', 'rsaddon'),
                    'featured-products'     => esc_html__('Featured Products', 'rsaddon'),
                    'best-selling-products' => esc_html__('Best Selling Products', 'rsaddon'),
                    'sale-products'         => esc_html__('Sale Products', 'rsaddon'),
                    'top-products'          => esc_html__('Top Rated Products', 'rsaddon'),
                ],
            ]
        );
        $this->add_control(
            'rs_product_grid_column',
            [
                'label' => esc_html__('Columns', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => '3',
                'options' => [
                    '12' => esc_html__('1 Column', 'rsaddon'),
                    '6' => esc_html__('2 Column', 'rsaddon'),
                    '4' => esc_html__('3 Column', 'rsaddon'),
                    '3' => esc_html__('4 Column', 'rsaddon'),
                    '2' => esc_html__('6 Column', 'rsaddon'),
                ],
            ]
        );
        $this->add_control(
            'rs_product_grid_products_count',
            [
                'label'   => __('Products Count', 'rsaddon'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 4,
                'min'     => 1,
                'max'     => 1000,
                'step'    => 1,
            ]
        );

        $this->add_control(
            'rs_product_grid_categories',
            [
                'label'       => esc_html__('Product Categories', 'rsaddon'),
                'type'        => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple'    => true,
                'options'     => rselemetns_woocommerce_product_categories(),
            ]
        );

        $this->add_control(
            'rs_product_grid_style_preset',
            [
                'label' => esc_html__('Style Preset', 'rsaddon'),
                'type' => Controls_Manager::SELECT,
                'default' => 'rs-product-simple',
                'options' => [
                    'rs-product-default' => esc_html__('Default', 'rsaddon'),
                    'rs-product-overlay' => esc_html__('Overlay Style', 'rsaddon'),
                ],
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'rs_product_grid_styles',
            [
                'label' => esc_html__('Products Styles', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rs_product_grid_background_color',
            [
                'label' => esc_html__('Content Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .rts-shop-section .product-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spinfdsafdsfner_padding',
            [
                'label'      => __('Content Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .rts-shop-section .product-item .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'rs_peoduct_grid_border',
                'fields_options' => [
                    'border' => [
                        'default' => 'solid',
                    ],
                    'width' => [
                        'default' => [
                            'top' => '1',
                            'right' => '1',
                            'bottom' => '1',
                            'left' => '1',
                            'isLinked' => false,
                        ],
                    ],
                    'color' => [
                        'default' => '#eee',
                    ],
                ],
                'selector' => '{{WRAPPER}} .rts-shop-section .product-item',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'rs_section_product_grid_typography',
            [
                'label' => esc_html__('Color &amp; Typography', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_title_heading',
            [
                'label' => __('Product Title', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_title_color',
            [
                'label' => esc_html__('Product Title Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
             
                'selectors' => [
                    '{{WRAPPER}} .product-item .product-name' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-shopping-product .inner-content .title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_product_title_color_hover',
            [
                'label' => esc_html__('Product Title Color Hover', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
              
                'selectors' => [
                    '{{WRAPPER}} .product-item .product-name:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-shopping-product .inner-content .title:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_product_title_typography',
                'selector' => '{{WRAPPER}} .product-item .product-name,.single-shopping-product .inner-content .title',
            ]
        );

        $this->add_control(
            'rs_product_grid_product_price_heading',
            [
                'label' => __('Reguler Price', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_product_price_color',
            [
                'label' => esc_html__('Product Price Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
              
                'selectors' => [
                    '{{WRAPPER}} .product-item .product-price del' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-item .product-price del bdi' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-shopping-product del span.woocommerce-Price-amount.amount bdi' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .single-shopping-product del span.woocommerce-Price-amount.amount bdi span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_product_price_typography',
                'selector' => '{{WRAPPER}} .rselements-product-list .product-price,product-item .product-price del,product-item .product-price del bdi',
            ]
        );

        $this->add_control(
            'rs_product_grid_prodfduct_price_heading',
            [
                'label' => __('Sale Price', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_prodfduct_price_color',
            [
                'label' => esc_html__('Product Price Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
             
                'selectors' => [
                    '{{WRAPPER}} .product-item .product-price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-item .product-price ins bdi' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .product-item .product-price ins' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .single-shopping-product ins span.woocommerce-Price-amount.amount bdi' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_product_prdice_typography',
                'selector' => '{{WRAPPER}} .product-item .product-price',
            ]
        );


        $this->add_control(
            'rs_product_grid_sale_badge_heading',
            [
                'label' => __('Sale Badge', 'rsaddon'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'rs_product_grid_sale_badge_color',
            [
                'label' => esc_html__('Sale Badge Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
              
                'selectors' => [
                    '{{WRAPPER}} .product-item .sale-tag' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .rselements-product-list span ins' => 'color: {{VALUE}};',

                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_sale_badge_background',
            [
                'label' => esc_html__('Sale Badge Background', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
             
                'selectors' => [
                    '{{WRAPPER}} .product-item .sale-tag' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .rselements-product-list span ins' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_sale_badge_typography',
                'selector' => '{{WRAPPER}} .product-item .sale-tag',
            ]
        );


        $this->add_control(
            'mordde_options',
            [
                'label' => esc_html__('Content Position', 'plugin-name'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );


        $this->add_responsive_control(
            'spinner_conddtent_align',
            [
                'label'         => esc_html__('Alignment', 'plugin-name'),
                'type'             => \Elementor\Controls_Manager::CHOOSE,
                'options'         => [
                    'left'         => [
                        'title' => esc_html__('Left', 'plugin-name'),
                        'icon'     => 'eicon-text-align-left',
                    ],
                    'center'     => [
                        'title' => esc_html__('Center', 'plugin-name'),
                        'icon'     => 'eicon-text-align-center',
                    ],
                    'right'     => [
                        'title' => esc_html__('Right', 'plugin-name'),
                        'icon'     => 'eicon-text-align-right',
                    ],
                    'justify'     => [
                        'title' => esc_html__('Justified', 'plugin-name'),
                        'icon'     => 'eicon-text-align-justify',
                    ],
                ],
                'default'         => 'left',
                'selectors'     => [
                    '{{WRAPPER}} .product-item .contents ' => 'text-align: {{VALUE}};',



                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'rs_section_product_grid_add_to_cart_styles',
            [
                'label' => esc_html__('Add to Cart Button Styles', 'rsaddon'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('rs_product_grid_add_to_cart_style_tabs');

        $this->start_controls_tab('normal', ['label' => esc_html__('Normal', 'rsaddon')]);

        $this->add_control(
            'rs_product_grid_add_to_cart_color',
            [
                'label' => esc_html__('Button Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
              
                'selectors' => [
                    '{{WRAPPER}} .product-action-area a.button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-img.overlay .product-btn a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .button-cart-area a span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_background',
            [
                'label' => esc_html__('Button Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .product-action-area a.button' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-img.overlay .product-btn a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'spinndfdffer_padding',
            [
                'label'      => __('Padding', 'plugin-name'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .product-action-area a.button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'rs_product_grid_add_to_cart_border',
                'selector' => '{{WRAPPER}} .product-action-area a.button',
                '{{WRAPPER}} .product-img.overlay .product-btn a',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'rs_product_grid_add_to_cart_typography',
                'selector' => '{{WRAPPER}} .product-action-area a.button',
                '{{WRAPPER}} .product-img.overlay .product-btn a',

            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('rs_product_grid_add_to_cart_hover_styles', ['label' => esc_html__('Hover', 'rsaddon')]);

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_color',
            [
                'label' => esc_html__('Button Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}}  .product-action-area a.button:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .button-cart-area a span:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_background',
            [
                'label' => esc_html__('Button Background Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
             
                'selectors' => [
                    '{{WRAPPER}} .product-action-area a.button:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'rs_product_grid_add_to_cart_hover_border_color',
            [
                'label' => esc_html__('Border Color', 'rsaddon'),
                'type' => Controls_Manager::COLOR,
             
                'selectors' => [
                    '{{WRAPPER}} .product-action-area a.button:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .product-item:hover .overlay .product-btn a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'rs_peoduct_grid_border_radius',
            [
                'label' => esc_html__('Border Radius', 'rsaddon'),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .product-action-area a.button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['rs_product_grid_products_count'] ?: 4,
            'order' => 'DESC',
        ];

        if (!empty($settings['rs_product_grid_categories'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $settings['rs_product_grid_categories'],
                    'operator' => 'IN',
                ],
            ];
        }

        if ($settings['rs_product_grid_product_filter'] == 'featured-products') {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_visibility',
                    'field' => 'name',
                    'terms' => 'featured'
                ]
            ];
        } else if ($settings['rs_product_grid_product_filter'] == 'best-selling-products') {
            $args['meta_key'] = 'total_sales';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
        } else if ($settings['rs_product_grid_product_filter'] == 'sale-products') {
            $args['meta_query'] = [
                'relation' => 'OR',
                [
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ], [
                    'key' => '_min_variation_sale_price',
                    'value' => 0,
                    'compare' => '>',
                    'type' => 'numeric',
                ],
            ];
        } else if ($settings['rs_product_grid_product_filter'] == 'top-products') {
            $args['meta_key'] = '_wc_average_rating';
            $args['orderby'] = 'meta_value_num';
            $args['order'] = 'DESC';
        }

        $settings = [
            'rs_product_grid_style_preset' => $settings['rs_product_grid_style_preset'],
            'rs_product_grid_column' => $settings['rs_product_grid_column']
        ];


        $the_query = new WP_Query($args);

        ?>





            <div class="rts-shop-section shopping-area-start">
                <div class="row">
                  

                    <?php
                                while ($the_query->have_posts()) : $the_query->the_post();
                                    global $product;
                                    $product = wc_get_product(get_the_ID()); //set the global product object 
                                    ?>

                        <div class="col-lg-<?php echo esc_html($settings['rs_product_grid_column']); ?> col-md-4 col-sm-6 col-12 mb--30">
                            <div class="single-shopping-product">
                                <a href="<?php the_permalink() ?>" class="thumbnail">
                                    <?php if (has_post_thumbnail(get_the_ID())) {
                                                        echo get_the_post_thumbnail(get_the_ID(), 'shop_single');
                                                    } else {
                                                        echo '<img src="' . woocommerce_placeholder_img_src() . '" alt="Placeholder" />';
                                                    } ?>
                                </a>
                                <div class="inner-content">
                                    <a href="<?php the_permalink() ?>">
                                        <h6 class="title"><?php the_title() ?></h6>
                                    </a>
                                    <div class="button-cart-area">
                                        <div class="inner">
                                            <div class="pricing-area">
                                                <?php echo $product->get_price_html(); ?>
                                            </div>
                                            <a href="<?php echo site_url(); ?>/?add-to-cart=<?php echo get_the_ID(); ?>" class="cart-btn button product_type_simple add_to_cart_button ajax_add_to_cart" data-quantity="1" data-product_id="<?php echo get_the_ID(); ?>">
                                                <i class="fal fa-shopping-cart"></i>
                                                <span><?php echo esc_html__('Buy Now', 'rtelemets') ?></span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="invisible-btn">
                                    <ul>
                                        <?php if (class_exists('YITH_WCWL_Shortcode')) : ?>
                                            <li>
                                                <?php
                                                                    $args = array(
                                                                        'browse_wishlist_text' => '',
                                                                        'already_in_wishslist_text' => '',
                                                                        'product_added_text' => '',
                                                                        'icon' => 'fa-heart-o',
                                                                        'label' => '',
                                                                        'link_classes' => 'add_to_wishlist single_add_to_wishlist alt wishlist-icon',
                                                                    );
                                                                    ?>
                                                <?php echo YITH_WCWL_Shortcode::add_to_wishlist($args); ?>

                                            </li>
                                        <?php endif; ?>

                                        <li>
                                            <?php
                                                            if (class_exists('YITH_WCQV_Frontend')) {
                                                                echo '<a href="" class="yith-wcqv-button" data-product_id="' . esc_attr($product->get_id()) . '"><i class="rt-search"></i></a>';
                                                            }
                                                            ?>
                                        </li>
                                        <li>
                                            <?php
                                                            if (class_exists('YITH_Woocompare')) {
                                                                echo do_shortcode('[yith_compare_button]');
                                                            }
                                                            ?>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <!-- single shoppign nproduct end -->
                        </div>

                    <?php endwhile;
                                wp_reset_query();
                                ?>


                </div>
            </div>
<?php

    }
}
