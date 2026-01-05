<?php if ($best_wp->current_post == 0) : ?>
    <div class="<?php echo esc_html($col);?> single-blog-solaric-lg-mb">
        <!-- single blog area start -->
        <div class="single-blog-solaric-lg">
            <a href="<?php the_permalink() ?>" class="thumbnail">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('solari-blog-grid-large'); ?>
                <?php endif; ?>
            </a>
            <div class="inner-content-solari-blog">
                <div class="head">
                    <?php if ($settings['blog_date_show_hide'] == 'yes') : ?>
                        <div class="single">
                            <i class="far fa-clock"></i>
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>

                        <div class="single">
                            <i class="far fa-user"></i>
                            <span><?php the_author(); ?></span>
                        </div>

                    <?php endif; ?>
                    <?php
                        function calculate_reading_time($content)
                        {
                            // Average reading speed (words per minute)
                            $words_per_minute = 200;

                            // Count the number of words in the post content
                            $word_count = str_word_count(strip_tags($content));

                            // Calculate the estimated reading time in minutes
                            $reading_time = ceil($word_count / $words_per_minute);

                            return $reading_time;
                        }

                        function display_reading_time()
                        {
                            // Get the current post content
                            $content = get_post_field('post_content', get_the_ID());

                            // Calculate the reading time using the custom function
                            $reading_time = calculate_reading_time($content);

                            // Output the reading time
                            echo $reading_time . ' min';
                        }

                        ?>
                    <?php if ($settings['blog_read_show_hide'] == 'yes') : ?>
                        <div class="single">
                            <i class="fal fa-phone-office"></i>
                            <span><?php echo display_reading_time(); ?></span>
                        </div>
                    <?php endif; ?>


                </div>
                <div class="body">
                    <a href="<?php the_permalink() ?>">
                        <?php $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '22'; ?>
                        <h5 class="title"><?php echo wp_trim_words(get_the_title(), $length, ''); ?></h5>
                    </a>
                    <a href="<?php the_permalink() ?>" class="rts-btn btn-primary"><?php echo esc_html($settings['blog_btn_text']); ?></a>
                </div>
            </div>
        </div>
        <!-- single blog area end -->
    </div>





    <div class="<?php echo esc_html($col);?>">

    <?php elseif ($best_wp->current_post == 1) : ?>


        <div class="single-blog-solaric-sm">
            <a href="<?php the_permalink()?>" class="thumbnail">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('solari-blog-grid-small'); ?>
                <?php endif; ?>
            </a>
            <div class="inner-content-solari-blog">
                <div class="head">
                    <?php if ($settings['blog_date_show_hide'] == 'yes') : ?>
                        <div class="single">
                            <i class="far fa-clock"></i>
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>
                        <div class="single">
                            <i class="far fa-user"></i>
                            <span><?php the_author(); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="body">
                    <a href="<?php the_permalink() ?>">
                        <?php $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '22'; ?>
                        <h5 class="title"><?php echo wp_trim_words(get_the_title(), $length, ''); ?></h5>
                    </a>
                    <a href="<?php the_permalink() ?>" class="rts-btn btn-primary"><?php echo esc_html($settings['blog_btn_text']); ?></a>
                </div>
            </div>
        </div>

    <?php elseif ($best_wp->current_post == 2) : ?>

        <div class="single-blog-solaric-sm">
            <a href="<?php the_permalink() ?>" class="thumbnail">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('solari-blog-grid-small'); ?>
                <?php endif; ?>
            </a>
            <div class="inner-content-solari-blog">
                <div class="head">
                    <?php if ($settings['blog_date_show_hide'] == 'yes') : ?>
                        <div class="single">
                            <i class="far fa-clock"></i>
                            <span><?php echo get_the_date(); ?></span>
                        </div>
                    <?php endif; ?>
                    <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>
                        <div class="single">
                            <i class="far fa-user"></i>
                            <span><?php the_author(); ?></span>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="body">
                    <a href="<?php the_permalink() ?>">
                        <?php $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : '22'; ?>
                        <h5 class="title"><?php echo wp_trim_words(get_the_title(), $length, ''); ?></h5>
                    </a>
                    <a href="<?php the_permalink() ?>" class="rts-btn btn-primary"><?php echo esc_html($settings['blog_btn_text']); ?></a>
                </div>
            </div>
        </div>




    </div>

<?php endif; ?>