<div class="swiper-slide slider-<?php echo esc_attr($sstyle); ?> rts-service-area-five">    
    <div class="single-service-style-two">
        <?php if (!empty($item['image']['url'])): ?>
            <div class="icon">
                <img src="<?php echo esc_url($item['image']['url']); ?>" alt="<?php echo esc_attr('image') ?>">
            </div>
        <?php endif; ?>
        <?php if (!empty($item['name'])) :   ?>
            <a href="<?php echo esc_url($item['link']['url']); ?>">
                <h6 class="title"><?php echo esc_html($item['name']) ?></h6>
            </a>
        <?php endif; ?>
        <?php if (!empty($description)) :   ?>
            <p class="disc">
                <?php echo wp_kses($description, wp_kses_allowed_html('post'))  ?>
            </p>
        <?php endif ?>
        <?php if (!empty($item['btn'])) :   ?>
            <a href="<?php echo esc_url($item['btn-url']['url']); ?>" class="btn-border-bottom"><?php echo wp_kses_post($item['btn']); ?>
            <?php if(!empty($item['icon']['value'])) : ?> <i class="<?php echo esc_attr($item['icon']['value']); ?>"></i><?php endif; ?></a>
        <?php endif; ?>
    </div>
</div>


