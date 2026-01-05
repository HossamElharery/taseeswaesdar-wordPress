
<div class="single-service-primary-3 rt_servise_grid2">
    <div class="single-service-inner">
        <?php if(!empty($settings['icon'])) : ?>
            <div class="icon">
                <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
            </div>
    	<?php endif; ?>
        <?php if(!empty($settings['service-title'])) : ?>
            <a href="<?php echo esc_url($settings['service-url']['url']);?>">
                <h4 class="title"><?php echo wp_kses_post($settings['service-title']); ?></h4>
            </a>
        <?php endif; ?>
        <?php if(!empty($settings['service-des'])) : ?>
            <p class="disc"><?php echo wp_kses_post($settings['service-des']); ?></p>
        <?php endif; ?> 
    </div>
    <?php if(!empty($settings['service-btn'])): ?>
        <a href="<?php echo esc_url($settings['service-url']['url']); ?>" class="btn-full"><?php echo wp_kses_post($settings['service-btn']); ?></a>
    <?php endif; ?>
</div>