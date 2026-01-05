<?php 
    $cat = $settings['portfolio_category'];
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

	if(empty($cat)){
    	$best_wp = new wp_Query(array(
				'post_type'      => 'rt-portfolios',
				'posts_per_page' => $settings['per_page'],								
		));	  
    }   
    else{
    	$best_wp = new wp_Query(array(
				'post_type'      => 'rt-portfolios',
				'posts_per_page' => $settings['per_page'],				
				'tax_query'      => array(
			        array(
						'taxonomy' => 'rt-portfolio-category',
						'field'    => 'slug', //can be set to ID
						'terms'    => $cat //if field is ID you can reference by cat/term number
			        ),
			    )
		));	  
    }

    $x=1;
	while($best_wp->have_posts()): $best_wp->the_post();	
		
		$content       = get_the_content();

		$cats_show = get_the_term_list( $best_wp->ID, 'rt-portfolio-category', ' ', '<span class="separator">,</span> ');
		$termsArray  = get_the_terms( $best_wp->ID, "rt-portfolio-category" );  //Get the terms for this particular item
		$termsString = ""; //initialize the string that will contain the terms
		$termsSlug   = "";

		foreach ( $termsArray as $term ) { 
			$termsString .= 'filter_'.$term->slug.' '; 
			$termsSlug .= $term->name;
		}		
								
	?>

		<div class="col-lg-<?php echo esc_html($settings['portfolio_columns']);?> col-md-6 col-xs-1 grid-item <?php echo $termsString;?>">
			<div class="portfolio-item">
			
			<?php if(has_post_thumbnail()): ?>
                <div class="portfolio-img">
                	<a href="<?php the_permalink();?>"><?php  the_post_thumbnail($settings['thumbnail_size']);?></a>
                	<div class="port-content-part">   
                	    <div class="vertical-middle-cell">                    	
                	    	<?php if(get_the_title()):?>
                	    		<h4 class="p-title">
                	    			<a href="<?php the_permalink(); ?>">
                	    			    <?php
                	    			    $length = !empty($settings['title_word_count']) ? $settings['title_word_count'] : 14;
                	    			    echo esc_html(wp_trim_words(get_the_title(), $length, ''));
                	    			    ?>
                	    			</a>
                	    		</h4>
                	    	<?php endif;?>	
                	    	<span class="p-category"><?php echo $cats_show; ?></span>	        	
                	    </div>
                	    <div class="btn-part"> 
                	    	<a class="read-btn" href="<?php the_permalink();?>"> <i class="rt rt-arrow-up-right"></i> </a>
                	    </div>           
                	</div>
                </div>
            <?php endif; ?>          
        </div>
    </div>		
	<?php
	$x++;	
	endwhile;
	wp_reset_query();  
 ?>  
