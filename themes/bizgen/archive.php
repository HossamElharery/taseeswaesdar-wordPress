<?php
get_header(); ?>
<div class="container">
    <div id="content">
        <div id="reactheme-blog" class="reactheme-blog blog-page">
        <?php
            //checking blog layout form option  
            $col         ='';
            $blog_layout =''; 
            $column      =''; 
            $blog_grid   ='';

            if(!empty($bizgen_option['blog-layout']) || !is_active_sidebar( 'sidebar-1' )){

                $blog_layout = !empty($bizgen_option['blog-layout']) ? $bizgen_option['blog-layout'] : '';
                $blog_grid   =  !empty($bizgen_option['blog-grid']) ? $bizgen_option['blog-grid'] : '';
                $blog_grid   = !empty($blog_grid) ? $blog_grid : '12';

                if($blog_layout == 'full' || !is_active_sidebar( 'sidebar-1' ))
                {
                    $layout ='full-layout';
                    $col    = '-full';
                    $column = 'sidebar-none';  
                } 
                elseif($blog_layout == '2left' || isset($_GET['layout']) && $_GET['layout'] == 'layout-ls' ){
                    $layout = 'full-layout-left';  
                    $col    = '8';
                }
                elseif($blog_layout == '2right' || isset($_GET['layout']) && $_GET['layout'] == 'layout-rs'){
                    $layout = 'full-layout-right'; 
                    $col    = '8';
                } 
                else{
                    $col = '8';
                    $blog_layout = ''; 
                }
            }
            else{
                $col         ='8';
                $blog_layout =''; 
                $layout      ='';
                $blog_grid   ='12';
            }   
            ?>
            
            <div class="row padding-<?php echo esc_attr( $layout) ?>">       
                <div class="contents-sticky col-md-12 col-lg-<?php echo esc_attr($col); ?> <?php echo esc_attr($layout); ?>">                   
                    <div class="row">            
                        <?php
                            if ( have_posts() ) :           
                                /* Start the Loop */
                                while ( have_posts() ) : the_post();

                                $post_id   = get_the_id();
                                $author_id = $post->post_author;
                                $no_thumb  = "";

                                if ( !has_post_thumbnail() ) {
                                $no_thumb = "no-thumbs";
                                }?>

                            <div class="col-sm-<?php echo esc_attr($blog_grid);?> col-xs-12">
                                <article <?php post_class();?>>
                                    <div class="blog-item <?php echo esc_attr($no_thumb); ?>">

                                        <?php if ( has_post_thumbnail() ) {?>
                                            <div class="blog-img">
                                            <a href="<?php the_permalink();?>">
                                                    <?php
                                                        the_post_thumbnail();
                                                    ?>
                                                </a>                                                   
                                                
                                            
                                            </div><!-- .blog-img -->
                                        <?php }       
                                        ?>
                                        <div class="full-blog-content">
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
                                            <div class="title-wrap">                                                                                                              
                                                <h3 class="blog-title">
                                                    <a href="<?php the_permalink();?>">
                                                        <?php the_title();?>
                                                    </a>
                                                </h3>                                        
                                        </div>
                                        <?php if(!empty($bizgen_option['blog-post-content'])){
                                                if($bizgen_option['blog-post-content'] =='show'){ ?> 
                                                    <div class="blog-desc">   
                                                        <?php echo bizgen_custom_excerpt(22);?>                                     
                                                    </div>  
                                            <?php }
                                            }
                                        else{?>
                                            <div class="blog-desc">   
                                                <?php echo bizgen_custom_excerpt(22);?>                                     
                                        </div>  
                                    <?php }
                                        ?>                                   
                                            <?php   
                                                if(!empty($bizgen_option['blog_readmore'])):?>
                                                    <div class="blog-button">
                                                        <a href="<?php the_permalink();?>">
                                                            <?php echo esc_html($bizgen_option['blog_readmore']); ?>
                                                        </a>
                                                    </div>
                                            <?php 
                                            else: ?>
                                                <div class="blog-button">
                                                    <a href="<?php the_permalink();?>">
                                                        <?php echo esc_html('Read More','bizgen'); ?>
                                                    </a>
                                                </div>
                                        <?php  endif; ?>
                                    </div>
                                </div>
                                </article>
                            </div>
                        
                        <?php  
                        endwhile;                        
                        ?>
                    </div>
                    <div class="pagination-area">
                        <?php
                            the_posts_pagination();
                        ?>
                    </div>
                    <?php
                    else :
                    get_template_part( 'template-parts/content', 'none' );
                    endif; ?> 
                </div>
                <?php if( $layout != 'full-layout' ):     
                    get_sidebar();    
                endif;
                ?>
            </div>      
        </div>
    </div><!-- .content -->
</div><!-- .container -->
<?php
get_footer();