<div class="single-pricing-area-start">
    <div class="pricing-top-area">
    	<?php if(!empty($settings['icon'])) : ?>
	        <div class="icon">
	            <?php \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] ); ?>
	            <?php if(!empty($settings['number'])) : ?>
		    		<span class="number"><?php echo esc_html($settings['number']); ?></span>
		    	<?php endif; ?>
	        </div>
	    <?php endif; ?>

	    <?php
	    	if( !empty($img_link) ){
	    		?>
	    		<div class="service-image"><img src="<?php echo esc_url($img_link); ?>" alt="shop-now"></div>
	    	<?php
	    	}
	    ?>        
    </div>
    <!-- pricing -top artea end -->
    <div class="pricing-body">
    	<?php if(!empty($settings['service-title'])) : ?>
    		<h6 class="title"><?php echo wp_kses_post($settings['service-title']); ?></h6>
    	<?php endif; ?>
    	<?php if(!empty($settings['service-des'])) : ?>
        	<p class="disc"><?php echo wp_kses_post($settings['service-des']); ?></p>
        <?php endif; ?> 

        <?php if(!empty($settings['service-btn'])): ?>
        	<a href="<?php echo esc_url($settings['service-url']['url']); ?>" class="rts-btn btn-primary"><?php echo wp_kses_post($settings['service-btn']); ?> <i aria-hidden="true" class="rt rt-arrow-up-right"></i></a>
        <?php endif; ?>
    </div>
</div>