 
</div><!-- .main-container -->
<?php
/**
 * @since 1.0.0
 */
global $bizgen_option;
if( is_404() ){
    return;
} else {
    do_action( 'hfe_footer' );
} ?>
</div><!-- #page -->

<?php 
$bizgen_option = get_option('bizgen_option');
if(!empty($bizgen_option['show_top_bottom'])){ ?>
    <!-- start top-to-bottom  -->
    <div id="top-to-bottom">
        <i class="rt-angles-up"></i>    
    </div>   
<?php } ?>
 <?php wp_footer(); ?>
</body>
</html> 