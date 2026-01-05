<div class="<?php echo esc_html($col);?>">
        <div class="single-blog-area-style-one eight-area rt_blog_item_style">
            <a href="<?php the_permalink() ?>" class="thumbnail">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                <?php endif; ?>
            </a>
            <div class="inner-content-wrapper">
                <div class="bottom-area">
                    <span class="admin"><?php the_author(); ?></span>
                    <?php if ($settings['blog_date_show_hide'] == 'yes') : ?>
                        <span class="date">• <?php echo get_the_date(); ?></span>
                    <?php endif; ?>
                </div>
                <a href="<?php the_permalink() ?>">
                    <h6 class="title">
                        <?php
                            $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : 22;
                            echo esc_html(wp_trim_words(get_the_title(), $length, ''));
                        ?>
                    </h6>
                </a>
                <?php if($settings['blog_readmore_show_hide'] =='yes'):?>
                    <a href="<?php the_permalink() ?>" class="btn-readmore-inner"><?php echo $settings['blog_btn_text'];?></a>
                <?php endif;?>
            </div>
        </div>
    </div>