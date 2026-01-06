<div class="grid-item <?php echo esc_html($col);?>">
    <!-- single blog area start -->
    <div class="blog-style-four ">
        <a href="<?php the_permalink() ?>" class="thumbanil">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
            <?php endif; ?>
        </a>
        <div class="inner-content-blog">
            <div class="head">
            <?php if ($settings['blog_date_show_hide'] == 'yes') : ?>
                <div class="date">
                    <i class="far fa-clock"></i>
                    <div class="info">
                        <?php echo get_the_date(); ?>
                    </div>
                </div>
            <?php endif;?>
            <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>
                <div class="date time">
                    <i class="far fa-user"></i>
                    <div class="info">
                        <?php the_author(); ?>
                    </div>
                </div>
            <?php endif;?>
            </div>
            <a href="<?php the_permalink() ?>">
            <?php $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '22'; ?>
                <h4 class="title"><?php echo wp_trim_words(get_the_title(), $length, ''); ?></h4>
            </a>
        </div>
    </div>
    <!-- single blog area start -->
</div>