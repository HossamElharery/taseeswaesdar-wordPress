<?php
$cat   = $settings['blog_category'];
if (empty($cat)) {
    $best_wp = new wp_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => $settings['per_page'],
    ));
} else {
    $best_wp = new wp_Query(array(
        'post_type'      => 'post',
        'posts_per_page' => $settings['per_page'],
        'tax_query'      => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug', //can be set to ID
                'terms'    => $cat //if field is ID you can reference by cat/term number
            ),
        )
    ));
}
while ($best_wp->have_posts()) : $best_wp->the_post();
$cats_show = get_the_term_list($best_wp->ID, 'category', ' ', '<span class="separator">,</span> ');
?>
<div class="swiper-slide blog-item">
    <div class="single-blog-area-style-three">
        
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>" class="rt-thumbnail">
                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
            </a>
        <?php endif; ?>       

        <div class="btm-content-part">   
            <div class="bottom-area">              
                <?php if ($settings['blog_avatar_show_hide'] == 'yes') : ?>
                    <span class="admin"> <i class="rt-book"></i> <?php echo $cats_show; ?></span>
                <?php endif; ?>            
            </div>

            <h3 class="blog-title">
                <a href="<?php the_permalink(); ?>">
                    <?php
                        echo esc_html(wp_trim_words(get_the_title(), $length, ''));
                    ?>
                </a>
            </h3> 
            
            <?php if($settings['blog_meta_show_hide'] == 'yes'): ?>
                <div class="rt-author-part">
                    <div class="rt-author-img">
                        <?php 
                            $author_id = get_the_author_meta('ID'); 
                            echo get_avatar( $author_id, 40 );
                        ?>
                    </div>
                    <div class="rt-author">
                        <span><?php the_author(); ?></span>
                        <?php echo get_the_date(); ?>
                    </div>
                </div>
            <?php endif; ?>        
        </div>
    </div>
</div>
<?php
endwhile;
wp_reset_query();
?>