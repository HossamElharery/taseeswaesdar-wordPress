<div class="swiper-slide slider-<?php echo esc_attr($sstyle); ?>">
    <div class="single-testimonials-area dynamic">  
        <?php if ($settings['quote-icon']): ?>
            <div class="quote-image">
                <?php \Elementor\Icons_Manager::render_icon($settings['quote-icon'], ['aria-hidden' => 'true']); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($item['logo_client']['url'])) : ?>
            <div class="logo">
                <img class="light" src="<?php echo esc_url($item['logo_client']['url']) ?>" alt="<?php echo esc_attr('image') ?>">
            </div>
        <?php endif; ?>
        <?php if (!empty($description)) :   ?>
            <p class="disc">
                <?php echo wp_kses($description, wp_kses_allowed_html('post'))  ?>
            </p>
        <?php endif ?>
        <div class="author-area">
            <a href="<?php echo esc_url($item['link']['url']); ?>" class="avatar">
                <?php if (!empty($item['image']['url'])) :   ?>
                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr('image') ?>">
                <?php endif ?>
            </a>
            <div class="information">
                    <?php if (!empty($item['name'])) :   ?>
                        <h6 class="title"><?php echo esc_html($item['name']) ?></h6>
                    <?php endif ?>
                <?php if (!empty($item['sub-name'])) :   ?>
                    <span class="designation"><?php echo esc_html($item['sub-name']) ?></span>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>

