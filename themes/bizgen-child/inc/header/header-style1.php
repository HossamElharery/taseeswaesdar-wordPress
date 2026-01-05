<?php

/*
Header Style 1 - Child Theme Override
*/
global $bizgen_option;
$sticky             = !empty($bizgen_option['off_sticky']) ? $bizgen_option['off_sticky'] : ''; 
$sticky_menu        = ($sticky == 1) ? ' menu-sticky' : '';
$drob_aligns        = (!empty($bizgen_option['drob_align_s'])) ? 'menu-drob-align' : '';
$mobile_hide_search = (!empty($bizgen_option['mobile_off_search'])) ? 'mobile-hide-search' : '';
$mobile_hide_cart   = (!empty($bizgen_option['mobile_off_cart'])) ? 'mobile-hide-cart-no' : 'mobile-hide-cart';
$mobile_hide_button = (!empty($bizgen_option['mobile_off_button'])) ? 'mobile-hide-button' : '';
$mobile_logo_height = !empty($bizgen_option['mobile_logo_height']) ? 'style = "max-height: '.$bizgen_option['mobile_logo_height'].'"' : '';

// Custom logo URL from Child Theme
$custom_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
$site_name = get_bloginfo('name');


//off convas here
get_template_part('inc/header/off-canvas');
//include sticky search here
get_template_part('inc/header/search');

?>
  
<div class="menu-area menu_type_">    
    <div class="menu_one">
            <div class="row-table"> 
            <div class="col-cell header-logo">
                <?php 
                 // Force use custom logo from Child Theme
                 $child_logo_path = get_stylesheet_directory() . '/assets/images/logo.png';
                 $child_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
                 
                 if (file_exists($child_logo_path)) { ?>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="custom-logo-link">
                      <img src="<?php echo esc_url($child_logo_url); ?>" 
                           alt="<?php echo esc_attr($site_name ? $site_name : 'Tasees & Esdar Business setup'); ?>"
                           class="custom-logo default-logo"
                           style="max-height: 60px; width: auto; height: auto;">
                  </a>
                <?php } elseif (!empty( $bizgen_option['wplogo_mobile_rt']['url'] ) ) { ?>
                  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img <?php echo wp_kses($mobile_logo_height, 'bizgen');?> src="<?php echo esc_url( $bizgen_option['wplogo_mobile_rt']['url']); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>"></a>
                <?php } else {
                 // Use child theme logo if exists, otherwise parent
                 $child_logo_file = locate_template('inc/header/logo.php');
                 if ($child_logo_file) {
                     include($child_logo_file);
                 } else {
                     get_template_part('inc/header/logo');
                 }
                } ?>
            </div>  
                    
            <div class="col-cell menu-responsive primary-menu">  
                <?php                  
                    if(is_page_template('page-single.php')){
                        require get_parent_theme_file_path('inc/header/menu-single.php'); 
                    }else{
                        require get_parent_theme_file_path('inc/header/menu.php'); 
                    }               
                ?>
            </div>            

            <div class="col-cell header-quote">                
                <div class="sidebarmenu-area text-right primary-menu mobilehum">                                    
                <ul class="offcanvas-icon layout-2">
					<li class="nav-link-container center"> 
						<a href="#" class="nav-menu-link menu-button">							
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 4H21V6H3V4ZM3 11H21V13H3V11ZM3 18H21V20H3V18Z"></path></svg>															
						</a> 
					</li>
				</ul>          

            </div> 
        </div>
    </div>    
</div>

