<div class="swiper-slide">
    <div class="single-mission-area">   
        <div class="information">
            <?php if (!empty($item['name'])) :   ?>
                <h6 class="title"><?php echo esc_html($item['name']) ?></h6>
            <?php endif ?>
        </div>
        <?php if (!empty($description)) :   ?>
            <p class="disc">
                <?php echo wp_kses($description, wp_kses_allowed_html('post'))  ?>
            </p>
        <?php endif ?>      
    </div>
</div>
