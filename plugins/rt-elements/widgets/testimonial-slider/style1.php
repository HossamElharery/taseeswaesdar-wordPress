<div class="swiper-slide">
    <div class="single-testimonials-area-one">  
        <div class="single-testimonials-area-one-inner">  
            <?php if (!empty($item['image']['url'])) :   ?>
                <img class="rt-tes-author" src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr('image') ?>">
            <?php endif ?>

            <div class="information">
                    <?php if (!empty($item['name'])) :   ?>
                        <h6 class="title"><?php echo esc_html($item['name']) ?></h6>
                    <?php endif ?>
                <?php if (!empty($item['sub-name'])) :   ?>
                    <span class="designation"><?php echo esc_html($item['sub-name']) ?></span>
                <?php endif ?>
            </div>

            <?php if (!empty($description)) :   ?>
                <p class="disc">
                    <?php echo wp_kses($description, wp_kses_allowed_html('post'))  ?>
                </p>
            <?php endif ?> 

            <?php            
                $args = array(
                    'rating' => $item['rt_slider_rating'],
                    'type' => 'rating',
                    'number' => 1234,
                );
            wp_star_rating( $args ); ?>

        </div>
    </div>
</div>
