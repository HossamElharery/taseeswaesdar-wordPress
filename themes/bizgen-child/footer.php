</div><!-- .main-container -->

<?php
$bizgen_option = get_option('bizgen_option');
$footer_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
$site_name = get_bloginfo('name');
?>
<footer>
  <div class="footer-bottom">
    <div>
        <div class="copyright_border">
            <?php if (file_exists(get_stylesheet_directory() . '/assets/images/logo.png')): ?>
            <div class="footer-logo text-center" style="margin-bottom: 20px;">
                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                    <img src="<?php echo esc_url($footer_logo_url); ?>" 
                         alt="<?php echo esc_attr($site_name ? $site_name : 'Tasees & Esdar Business setup'); ?>"
                         class="footer-logo-img"
                         style="max-height: 50px; width: auto;">
                </a>
            </div>
            <?php endif; ?>
            
            <div class="copyright text-center">            
                <p><?php echo esc_html('&copy;')?> <?php echo date("Y");?>. <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a> 
                </p>                
            </div>              
        </div>
    </div>
</div>
</footer>
</div><!-- #page -->
<?php 
if(!empty($bizgen_option['show_top_bottom'])){
?>
 <!-- start top-to-bottom  -->
<div id="top-to-bottom">
    <i class="rt-angles-up"></i>
</div>   
<?php } ?>
 <?php wp_footer(); ?>
  </body>
</html>

