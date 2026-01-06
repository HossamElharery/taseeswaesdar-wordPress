<?php
$cat   = $settings['category'];
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
<div class="col-lg-<?php echo $col; ?> blog-item">
    <div class="single-blog-area-style-two">
        
        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php the_permalink() ?>" class="rt-thumbnail">
                <?php the_post_thumbnail($settings['thumbnail_size']); ?>
                
            </a>
        <?php endif; ?>       
        <span class="rt-cate"> <i class="rt-book"></i> <?php echo $cats_show; ?></span>
        <div class="btm-content-part">   
            <div class="bottom-area"> 
                <span class="admin"> <i class="rt-user-2"></i> <?php echo $settings['author_by_text']; ?> <?php the_author(); ?> </span>              
                <span class="date"> <i class="rt-clock-regular"></i> <?php echo get_the_date(); ?> </span>               
            </div>

            <h3 class="blog-title">
                <a href="<?php the_permalink(); ?>">
                    <?php
                        echo esc_html(wp_trim_words(get_the_title(), $length, ''));
                    ?>
                </a>
            </h3>      
            <?php
            echo wp_trim_words( get_the_content(), 12, '...' );
            ?> 
            <?php if(!empty($settings['blog_readmore_text'])):?>
                <a href="<?php the_permalink() ?>" class="btn-readmore-inner"><?php echo $settings['blog_readmore_text'];?> <i class="rt-arrow-right-regular"></i> </a>
            <?php endif;?>         
        </div>
    </div>
</div>
<?php
endwhile;
wp_reset_query();
?>