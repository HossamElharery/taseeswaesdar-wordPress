<div class="swiper-slide">    
    <div class="single-service-style-one">
        
        <?php if(isset($item['icons']) && !empty($item['icons'])) : ?>
            <div class="icon">
                <?php 
                if (isset($item['icons'])) {
                    \Elementor\Icons_Manager::render_icon( $item['icons'], [ 'aria-hidden' => 'true' ] ); 
                }
                ?>                
            </div>
        <?php endif; ?>
            

        <?php if (!empty($title)) :   ?>
            <a href="<?php echo esc_url($item['btn-url']['url']); ?>">
                <h6 class="title"><?php echo esc_html($item['name']); ?></h6>
            </a>
        <?php endif; ?>

        <?php if (!empty($description)) :   ?>
            <p class="disc">
                <?php echo wp_kses($description, wp_kses_allowed_html('post'))  ?>
            </p>
        <?php endif ?>
        
        <?php if (!empty($item['btn'])) :   ?>
            <a href="<?php echo esc_url($item['btn-url']['url']); ?>" class="btn-border-bottom">
                <?php echo wp_kses_post($item['btn']); ?> <i aria-hidden="true" class="rt rt-arrow-up-right"></i>
            </a>
        <?php endif; ?>
    </div>
</div>


