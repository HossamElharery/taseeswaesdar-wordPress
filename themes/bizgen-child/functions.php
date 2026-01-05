<?php
/*** Child Theme Function  ***/
function bizgen_enqueue_child_theme_styles() {
    // Load parent theme stylesheet
    wp_enqueue_style('bizgen-parent-style', get_template_directory_uri() . '/style.css');
    // Load child theme stylesheet
    wp_enqueue_style('bizgen-child-style', get_stylesheet_directory_uri() . '/style.css', array('bizgen-parent-style'));
}
add_action('wp_enqueue_scripts', 'bizgen_enqueue_child_theme_styles');

/**
 * Override WordPress custom_logo theme mod
 * This will affect Elementor Site Logo widget
 */
function bizgen_child_override_custom_logo($value) {
    $logo_path = get_stylesheet_directory() . '/assets/images/logo.png';
    
    if (!file_exists($logo_path)) {
        return $value;
    }
    
    // Check if logo already uploaded
    $existing_logo_id = get_option('bizgen_child_logo_attachment_id');
    
    if ($existing_logo_id && wp_attachment_is_image($existing_logo_id)) {
        // Verify the attachment still exists
        $attachment_url = wp_get_attachment_image_url($existing_logo_id, 'full');
        if ($attachment_url) {
            return $existing_logo_id;
        }
    }
    
    // Upload logo to media library
    require_once(ABSPATH . 'wp-admin/includes/file.php');
    require_once(ABSPATH . 'wp-admin/includes/media.php');
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    
    $upload = wp_upload_bits('tasees-esdar-logo.png', null, file_get_contents($logo_path));
    
    if (!$upload['error']) {
        $attachment = array(
            'post_mime_type' => 'image/png',
            'post_title' => 'Tasees & Esdar Logo',
            'post_content' => '',
            'post_status' => 'inherit'
        );
        
        $attach_id = wp_insert_attachment($attachment, $upload['file']);
        $attach_data = wp_generate_attachment_metadata($attach_id, $upload['file']);
        wp_update_attachment_metadata($attach_id, $attach_data);
        
        // Save attachment ID for future use
        update_option('bizgen_child_logo_attachment_id', $attach_id);
        
        // Set as custom logo
        set_theme_mod('custom_logo', $attach_id);
        
        return $attach_id;
    }
    
    return $value;
}
add_filter('theme_mod_custom_logo', 'bizgen_child_override_custom_logo', 20);

/**
 * Set custom logo on theme activation/load
 */
function bizgen_child_set_custom_logo() {
    $logo_path = get_stylesheet_directory() . '/assets/images/logo.png';
    
    if (!file_exists($logo_path)) {
        return;
    }
    
    // Check if already set
    $current_logo = get_theme_mod('custom_logo');
    if ($current_logo) {
        $logo_url = wp_get_attachment_image_url($current_logo, 'full');
        // If current logo is from our child theme, keep it
        if ($logo_url && strpos($logo_url, 'tasees-esdar-logo') !== false) {
            return;
        }
    }
    
    // Trigger the filter to upload and set logo
    bizgen_child_override_custom_logo($current_logo);
}
add_action('after_setup_theme', 'bizgen_child_set_custom_logo', 20);

/**
 * Override logo in theme options
 * Force use of custom logo from Child Theme
 */
function bizgen_child_override_logo($option) {
    $custom_logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
    $logo_path = get_stylesheet_directory() . '/assets/images/logo.png';
    
    // If custom logo exists, override the option
    if (file_exists($logo_path)) {
        if (isset($option['wplogo_mobile_rt']['url'])) {
            $option['wplogo_mobile_rt']['url'] = $custom_logo_url;
        }
    }
    
    return $option;
}
add_filter('option_bizgen_option', 'bizgen_child_override_logo', 10, 1);

/**
 * Add JavaScript to replace logo in Elementor widgets
 * This ensures the logo is replaced even if Elementor uses cached version
 */
function bizgen_child_replace_elementor_logo() {
    $logo_url = get_stylesheet_directory_uri() . '/assets/images/logo.png';
    $logo_path = get_stylesheet_directory() . '/assets/images/logo.png';
    
    if (file_exists($logo_path)) {
        ?>
        <script type="text/javascript">
        (function() {
            var newLogoUrl = '<?php echo esc_js($logo_url); ?>';
            var newLogoAlt = 'Tasees & Esdar Business setup';
            
            function replaceElementorLogo() {
                // Find all logo images
                var logoImages = document.querySelectorAll('.hfe-site-logo-img, img.hfe-site-logo-img, .elementor-widget-site-logo img, .site-logo img');
                
                logoImages.forEach(function(logoImg) {
                    if (logoImg && logoImg.src !== newLogoUrl) {
                        // Check if it's the old logo
                        var oldLogoUrl = logoImg.src;
                        if (oldLogoUrl.indexOf('logo.png') !== -1 || oldLogoUrl.indexOf('uploads') !== -1) {
                            logoImg.src = newLogoUrl;
                            logoImg.alt = newLogoAlt;
                            logoImg.setAttribute('data-replaced', 'true');
                        }
                    }
                });
            }
            
            // Run immediately
            replaceElementorLogo();
            
            // Run on page load
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', replaceElementorLogo);
            } else {
                replaceElementorLogo();
            }
            
            // Run after Elementor loads
            if (typeof jQuery !== 'undefined') {
                jQuery(document).ready(function($) {
                    replaceElementorLogo();
                    // Run multiple times for dynamic content
                    setTimeout(replaceElementorLogo, 100);
                    setTimeout(replaceElementorLogo, 500);
                    setTimeout(replaceElementorLogo, 1000);
                    setTimeout(replaceElementorLogo, 2000);
                });
            }
            
            // Use MutationObserver to watch for dynamic changes
            if (typeof MutationObserver !== 'undefined') {
                var observer = new MutationObserver(function(mutations) {
                    replaceElementorLogo();
                });
                
                if (document.body) {
                    observer.observe(document.body, {
                        childList: true,
                        subtree: true,
                        attributes: true,
                        attributeFilter: ['src']
                    });
                }
            }
            
            // Also listen for Elementor events
            if (typeof elementorFrontend !== 'undefined') {
                elementorFrontend.hooks.addAction('frontend/element_ready/global', function() {
                    replaceElementorLogo();
                });
            }
        })();
        </script>
        <style>
        /* Force logo replacement with CSS as backup */
        .hfe-site-logo-img[src*="uploads/2024/07/logo.png"],
        .hfe-site-logo-img[src*="uploads"] {
            content: url('<?php echo esc_url($logo_url); ?>') !important;
        }
        </style>
        <?php
    }
}
add_action('wp_footer', 'bizgen_child_replace_elementor_logo', 999);
?>
