<?php
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Widget_Base;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;

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
class RTS_Search_Button extends Widget_Base
{
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
        return 'hfe-search-buttond';
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
        return __('RT Search', 'rtelements');
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
    public function get_icon()
    {
        return 'hfe-icon-search';
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
        return ['rtelements_category'];
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
    protected function register_controls()
    {
        $this->register_general_content_controls();
        $this->register_search_style_controls();
    }
    /**
     * Register Search General Controls.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function register_general_content_controls()
    {
        $this->start_controls_section(
            'section_general_fields',
            [
                'label' => __('Search Settings', 'rtelements'),
            ]
        );

        $this->add_control(
            'dot_icon_color',
            [
                'label'     => __( 'Search Icon Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '{{WRAPPER}} .rts-search-button-wrapper .rt-search' => 'color: {{VALUE}}',
                ],
                
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background_icon_bg',
                'types' => [ 'classic', 'gradient', 'video' ],
                'selector' => '{{WRAPPER}} .rts-search-button-wrapper .rt-search',
            ]
        );

        $this->add_control(
            'dot_icon_color_box',
            [
                'label'     => __( 'Search Border Color', 'rtelements'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                   
                    '{{WRAPPER}} .rts-search-button-wrapper .rt-search' => 'border-color: {{VALUE}}',
                ],
                
            ]
        );

        $this->end_controls_section();
    }
    /**
     * Render Search button output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.5.0
     * @access protected
     */
    protected function render()
    {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute(
            'input',
            [
                'placeholder' => $settings['placeholder'],
                'class'       => 'hfe-search-form__input',
                'type'        => 'search',
                'name'        => 's',
                'title'       => __('Search', 'rtelements'),
                'value'       => get_search_query(),

            ]
        );

        $this->add_render_attribute(
            'container',
            [
                'class' => ['hfe-search-form__container'],
                'role'  => 'tablist',
            ]
        );

        ?>

        <form class="rts-search-button-wrapper" role="search" action="<?php echo home_url(); ?>" method="get">
            <div class="sticky_search">
                <i class="fal fa-search"></i>
            </div>
        </form>
<?php
    }
}
