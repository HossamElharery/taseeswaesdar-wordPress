
<div class="swiper-slide">
    <div class="single-testimonisl-three dynamic">
        <?php if ($settings['quote-icon']): ?>
            <div class="icon">
                <?php \Elementor\Icons_Manager::render_icon($settings['quote-icon'], ['aria-hidden' => 'true']); ?>
            </div>
        <?php endif; ?>
        <?php if (!empty($description)) :   ?>
            <p class="disc">
                <?php echo wp_kses($description, wp_kses_allowed_html('post'))  ?>
            </p>
        <?php endif; ?>
        <div class="author">
            <?php if (!empty($item['name'])) :   ?>
                <h6 class="name"><?php echo esc_html($item['name']) ?></h6>
            <?php endif ?>
            <?php if (!empty($item['sub-name'])) :   ?>
                <p class="disc">
                    <?php echo esc_html($item['sub-name']) ?>
                </p>
            <?php endif ?>    
            <?php if (!empty($item['image']['url'])) :   ?>
                <div class="author-img">
                    <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr('image') ?>">
                </div>
            <?php endif ?> 
        </div>
    </div>
</div>