<?php
use Elementor\Group_Control_Text_Shadow;
use Elementor\Repeater;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;

defined('ABSPATH') || die();

class Reactheme_Image_Parallax_Widget extends \Elementor\Widget_Base
{
    /**    
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */

    public function get_name()
    {
        return 'rt-parallax-image';
    }

    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */

    public function get_title()
    {
        return esc_html__('RT Image Parallax', 'rtelements');
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon()
    {
        return 'glyph-icon flaticon-image';
    }


    public function get_categories()
    {
        return ['pielements_category'];
    }

    public function get_keywords()
    {
        return ['logo', 'clients', 'brand', 'parnter', 'image'];
    }



    protected function register_controls()
    {
        $this->start_controls_section(
            '_section_logo',
            [
                'label' => esc_html__('Image Settings', 'rtelements'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'paralax_style',
            [
                'label'   => esc_html__('Paralax Style', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style1',
                'options' => [
                    'style1' => esc_html__('Style 1', 'rtelements'),
                    'style2' => esc_html__('Style 2', 'rtelements'),
                ],

            ]
        );

        $this->add_control(
            'first_image',
            [
                'label' => esc_html__('Choose Image', 'rtelements'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => esc_html__('Alignment', 'rtelements'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__('Left', 'rtelements'),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'rtelements'),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'rtelements'),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justify', 'rtelements'),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'default' => 'left',
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .react-image, {{WRAPPER}} .rt-image' => 'text-align: {{VALUE}}'
                ],
                'separator' => 'before',
                'condition' => ['paralax_style' => 'style1']
            ]
        );

        $this->add_control(
            'images_translate',
            [
                'label'   => esc_html__('Translate Position', 'rtelements'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'horizontal',
                'options' => [

                    'horizontal' => esc_html__('Horizontal', 'rtelements'),
                    'veritcal' => esc_html__('Veritcal', 'rtelements'),
                    'normal' => esc_html__('Normal', 'rtelements'),
                ],
                'condition' => ['paralax_style' => 'style1']
            ]
        );



        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();

        ?>

        <?php 

        if($settings['paralax_style'] == 'style1') { ?>
            <?php if ($settings['images_translate'] == 'horizontal') : ?>
                <div class="rt-image">
                    <?php if (!empty($settings['first_image']['url'])) : ?>
                        <img class="react-parallax-image" src="<?php echo esc_url($settings['first_image']['url']); ?>" alt="image" />
                    <?php endif; ?>
                </div>
    
            <?php endif; ?>
            <?php if ($settings['images_translate'] == 'normal') : ?>
                <div class="rt-image rts-about-left-image-area">
                    <div class="small-image-area images react-parallax-image">
                        <?php if (!empty($settings['second_image']['url'])) :   ?>
                            <img src="<?php echo esc_html($settings['second_image']['url']) ?>" alt="<?php echo esc_html('image')?>">
                        <?php endif ?>
                    </div>
                </div>
    
            <?php endif; ?>
            <?php if ($settings['images_translate'] == 'veritcal') : ?>
                <div class="rt-image">
                    <?php if (!empty($settings['first_image']['url'])) : ?>
                        <img class="react-parallax-image2" src="<?php echo esc_url($settings['first_image']['url']); ?>" alt="image" />
                    <?php endif; ?>
                </div>
            <?php endif; 
        }
        elseif($settings['paralax_style'] == 'style2') { ?>
            <div class="large-image-video-area">
                <div class="thumbnail">
                    <figure class="pli-image">
                        <img class="anim-image-parallax tt-lazy" src="<?php echo esc_url($settings['first_image']['url']); ?>" data-src="<?php echo esc_url($settings['first_image']['url']); ?>" alt="image">
                    </figure>
                </div>
            </div>
            
            <?php 
        } 
        else {
            if ($settings['images_translate'] == 'horizontal') : ?>
                <div class="rt-image">
                    <?php if (!empty($settings['first_image']['url'])) : ?>
                        <img class="react-parallax-image" src="<?php echo esc_url($settings['first_image']['url']); ?>" alt="image" />
                    <?php endif; ?>
                </div>
    
            <?php endif; ?>
            <?php if ($settings['images_translate'] == 'normal') : ?>
                <div class="rt-image rts-about-left-image-area">
                    <div class="small-image-area images react-parallax-image">
                        <?php if (!empty($settings['second_image']['url'])) :   ?>
                            <img src="<?php echo esc_html($settings['second_image']['url']) ?>" alt="<?php echo esc_html('image')?>">
                        <?php endif ?>
                    </div>
                </div>
    
            <?php endif; ?>
            <?php if ($settings['images_translate'] == 'veritcal') : ?>
                <div class="rt-image">
                    <?php if (!empty($settings['first_image']['url'])) : ?>
                        <img class="react-parallax-image2" src="<?php echo esc_url($settings['first_image']['url']); ?>" alt="image" />
                    <?php endif; ?>
                </div>
            <?php endif; 
        }
        ?>


        <script>
            jQuery(document).ready(function ($) {
                // Function to handle parallax and zoom for a given set of elements
                function handleParallaxZoom(elements, yPercent, startTrigger) {
                    if (elements.length) {
                        elements.each(function () {

                            var $animImageParallax = $(this);
                            var $aipWrap = $animImageParallax.wrap('<div class="anim-image-parallax-wrap"><div class="anim-image-parallax-inner"></div></div>').parent();
                            var $aipInner = $aipWrap.find(".anim-image-parallax-inner");

                            // Parallax
                            gsap.to($animImageParallax, {
                                yPercent: yPercent,
                                ease: "none",
                                scrollTrigger: {
                                    trigger: $aipWrap,
                                    start: startTrigger,
                                    end: "bottom top",
                                    scrub: true,
                                    markers: false,
                                },
                            });

                            // Zoom in
                            let tl_aipZoomIn = gsap.timeline({
                                scrollTrigger: {
                                    trigger: $aipWrap,
                                    start: "top 90%",
                                    markers: false,
                                },
                            });
                            tl_aipZoomIn.from($aipInner, {
                                duration: 1.5,
                                autoAlpha: 0,
                                scale: 1.4,
                                ease: Power2.easeOut,
                                clearProps: "all",
                            });
                        });
                    }
                }
                // Call the function for the first set of elements
                handleParallaxZoom($(".anim-image-parallax"), 80, "top bottom");
                // Call the function for the second set of elements
                handleParallaxZoom($(".anim-image-parallax-2"), 20, "top bottom");

                //Style 2 anim-image-parallax Code 
                let parallaxElements = document.getElementsByClassName('anim-image-parallax');
                if (parallaxElements.length) {
                    Array.from(parallaxElements).forEach((element) => {
                        // Wrap the element with the necessary divs.
                        let wrapperDiv = document.createElement('div');
                        wrapperDiv.className = 'anim-image-parallax-wrap';
                        let innerDiv = document.createElement('div');
                        innerDiv.className = 'anim-image-parallax-inner';

                        element.parentNode.insertBefore(wrapperDiv, element);
                        wrapperDiv.appendChild(innerDiv);
                        innerDiv.appendChild(element);

                        // Add overflow hidden to the wrapper div.
                        wrapperDiv.style.overflow = 'hidden';

                        // Get the references to the elements.
                        let animImageParallax = gsap.utils.wrap(element);
                        let aipWrap = wrapperDiv;
                        let aipInner = innerDiv;

                        // Parallax
                        gsap.to(animImageParallax, {
                            yPercent: 80,
                            ease: 'none',
                            scrollTrigger: {
                            trigger: aipWrap,
                            start: 'top bottom',
                            end: 'bottom top',
                            scrub: true,
                            markers: false,
                            },
                        });

                        // Zoom in
                        let tl_aipZoomIn = gsap.timeline({
                            scrollTrigger: {
                            trigger: aipWrap,
                            start: 'top 90%',
                            markers: false,
                            },
                        });

                        tl_aipZoomIn.from(aipInner, {
                            duration: 1.5,
                            autoAlpha: 0,
                            scale: 1.4,
                            ease: 'power2.out',
                            clearProps: 'all',
                        });
                    });
                }
            });
        </script>



        <?php 
    }
}
