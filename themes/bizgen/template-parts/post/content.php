<?php
    $bizgen_option = get_option('bizgen_option');
?>
<div class="single-content-full">
    <div class="user-info">        
        <div class="single-info author">
            <span>
                <i class="rt-user-2"></i>
                <?php 
                
                if( !empty($first_name) && !empty($last_name)){
                    echo esc_html($first_name).' '. esc_html($last_name);
                }else{
                    echo get_the_author();
                } ?>
            </span>
        </div>
        
        <div class="single-info date">
            <span><i class="rt-clock-regular"></i> <?php echo get_the_date();?></span>
        </div> 

        <div class="single-info">
            <i class="rt-book"></i>
            <span>                           
                <?php
                    //tag add
                    $seperator = ', '; // blank instead of comma
                    $after = '';
                    $before = '';                    
                    ?>                        
                    <?php
                    the_category(',  ');                    
                ?> 
            </span>
        </div>
</div>
<h2 class="post-title"><?php the_title(); ?></h2>
<div class="bs-desc">
    <?php
        the_content();
        wp_link_pages( array(
          'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'bizgen' ),
          'after'       => '</div>',
          'link_before' => '<span class="page-number">',
          'link_after'  => '</span>',
        ) );
    ?>
</div>
 <?php 
    if(has_tag()){ ?>
    <div class="bs-info single-page-info tags">
        <?php
            //tag add
            $seperator = ''; // blank instead of comma
            $after = '';
            echo esc_html__( 'Tags: ', 'bizgen' );
            the_tags( '', $seperator, $after );
        ?>             
    </div> 
   <?php } ?>
</div>