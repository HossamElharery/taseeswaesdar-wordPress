<?php
/**
 * Custom Logo for Child Theme
 * Logo: Tasees & Esdar Business setup
 */
$logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
$site_name = get_bloginfo('name');
$site_url = esc_url(home_url('/'));
?>

<div class="logo-area">
    <div class="site-title">
        <a href="<?php echo $site_url; ?>" rel="home" class="custom-logo-link">
            <img src="<?php echo esc_url($logo_url); ?>" 
                 alt="<?php echo esc_attr($site_name ? $site_name : 'Tasees & Esdar Business setup'); ?>" 
                 class="custom-logo default-logo"
                 style="max-height: 60px; width: auto;">
        </a>
    </div>
</div>

