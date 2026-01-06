<div class="rts-service-area-five">
    <div class="single-service-style-two style-six rt_servise_grid">
        <?php if(!empty($settings['icon'])) : ?>
            <div class="icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($settings['service-title'])) : ?>
            <h6 class="title"><?php echo wp_kses_post($settings['service-title']); ?></h6>
        <?php endif; ?>
        <?php if(!empty($settings['service-des'])) : ?>
            <p class="disc"><?php echo wp_kses_post($settings['service-des']); ?></p>
        <?php endif; ?>
        <?php if(!empty($settings['service-btn'])): ?>
            <a href="<?php echo esc_url($settings['service-url']['url']); ?>" class="rts-btn btn-border-bottom arrow-rotate">
                <?php echo($settings['service-btn']); ?> 
                <?php \Elementor\Icons_Manager::render_icon( $settings['services_btn_icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </a>
        <?php endif; ?>
    </div>
</div>

