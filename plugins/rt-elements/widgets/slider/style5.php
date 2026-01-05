<div class="swiper-slide slider-<?php echo esc_attr($sstyle); ?> testimonials-filwidth">
    <div class="inner dynamic">
        <?php if ($settings['quote-icon']): ?>
            <div class="icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['quote-icon'], ['aria-hidden' => 'true']); ?>
            </div>
        <?php endif; ?>
        <div class="body">
            <?php if(!empty($description)):?>
                <p class="disc"><?php echo wp_kses_post($description); ?></p>
            <?php endif; ?>
            <div class="author">
                <?php if(!empty($item['image']['url'])) : ?>
                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr('image') ?>">
                <?php endif; ?>
                <?php if(!empty($title)):?>
                    <a href="#">
                        <h6 class="title-name"><?php echo wp_kses_post($title); ?></h6>
                    </a>
                <?php endif; ?>
                <?php if(!empty($sub_title)):?>
                    <span><?php echo wp_kses_post($sub_title); ?></span>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div> 
