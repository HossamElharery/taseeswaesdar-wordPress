<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="//gmpg.org/xfn/11">
<?php $bizgen_option = get_option('bizgen_option'); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  
   <div class="close-button body-close"></div>   
    <!--Preloader start here-->
    <?php get_template_part( 'inc/header/preloader' ); ?>
    <!--Preloader area end here-->
    <?php 
		if( ! function_exists( 'wp_body_open' ) ) {
		    function wp_body_open() {
		    	do_action( 'wp_body_open' );
		    }
		}
	?>  
    
 
    <div id="page" class="site">
        <?php
            // Use child theme header if exists, otherwise parent
            $child_header = locate_template('inc/header/header.php');
            if ($child_header) {
                include($child_header);
            } else {
                get_template_part('inc/header/header');
            }
        ?> 
        <!-- End Header Menu End -->
        
        <div class="main-contain offcontents">
            

