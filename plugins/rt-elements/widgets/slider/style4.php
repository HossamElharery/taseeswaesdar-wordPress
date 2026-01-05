<div class="swiper-slide slider-<?php echo esc_attr($sstyle); ?> rts-testimonials-area-six">  
    <div class="single-service-style-two dynamic">
        <?php if (!empty($settings['quote-icon'])) : ?>
            <div class="icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['quote-icon'], ['aria-hidden' => 'true']); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($description)) : ?>
            <p class="disc">
                <?php echo wp_kses($description, wp_kses_allowed_html('post')); ?>
            </p>
        <?php endif; ?>
        <div class="author-area">
            <?php if (!empty($item['image']['url'])) : ?>
                <div class="author-image">
                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr('image'); ?>">
                </div>
            <?php endif; ?>
            <div class="author-content">
                <?php if (!empty($item['name'])) : ?>
                    <h3 class="author-title animated fadeIn"><?php echo esc_html($item['name']); ?></h3>
                <?php endif; ?>
                <?php if (!empty($item['sub-name'])) : ?>
                    <p class="desc"><?php echo esc_html($item['sub-name']); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
