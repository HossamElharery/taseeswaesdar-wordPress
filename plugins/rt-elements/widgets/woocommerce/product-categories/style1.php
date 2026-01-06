



<div class="swiper-slide">
    <!-- single category -->
    <div class="single-category">
        <a href="<?php echo esc_url($pcat_link); ?>" class="thumbnail">
            <img src="<?php echo esc_url($pcat_image); ?>" alt="<?php echo esc_attr('image') ?>">
        </a>
        <div class="single-category">
            <a href="<?php echo esc_url($pcat_link); ?>">
                <h5 class="title"><?php echo esc_html($name); ?></h5>
            </a>
            <a href="<?php echo esc_url($pcat_link); ?>" class="arrow-btn-solari"><?php echo esc_html__('Shop Now', 'rtelements') ?> <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
    <!-- single category end -->
</div>