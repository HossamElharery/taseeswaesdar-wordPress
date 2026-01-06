<?php
/**
 * Header Footer Elementor Function
 */

/**
 * Checks if Header is enabled from HFE.
 *
 * @since  1.0.0
 * @return bool True if header is enabled. False if header is not enabled
 */
function hfe_header_enabled() {
	$header_id = Header_Footer_Elementor::get_settings( 'type_header', '' );
	$status    = false;

	if ( '' !== $header_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_header_enabled', $status );
}

/**
 * Checks if Footer is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if header is enabled. False if header is not enabled.
 */
function hfe_footer_enabled() {
	$footer_id = Header_Footer_Elementor::get_settings( 'type_footer', '' );
	$status    = false;

	if ( '' !== $footer_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_footer_enabled', $status );
}


if (!function_exists('get_hfe_header_id')) {
    function get_hfe_header_id() {
        $header_id = Header_Footer_Elementor::get_settings('type_header', '');

        // Check if Polylang is active and get the translated post ID
        if (function_exists('pll_get_post')) {
            $translated_id = pll_get_post($header_id);
            if (!empty($translated_id)) {
                $header_id = $translated_id;
            }
        }

        // Check if WPML is active and get the translated post ID
        if (function_exists('icl_object_id')) {
            $translated_id = icl_object_id($header_id, 'header_footer', true);
            if (!empty($translated_id)) {
                $header_id = $translated_id;
            }
        }

        return $header_id ? $header_id : false;
    }
}

if (!function_exists('get_hfe_footer_id')) {
    function get_hfe_footer_id() {
        $footer_id = Header_Footer_Elementor::get_settings('type_footer', '');

        // Check if Polylang is active and get the translated post ID
        if (function_exists('pll_get_post')) {
            $translated_id = pll_get_post($footer_id);
            if (!empty($translated_id)) {
                $footer_id = $translated_id;
            }
        }

        // Check if WPML is active and get the translated post ID
        if (function_exists('icl_object_id')) {
            $translated_id = icl_object_id($footer_id, 'header_footer', true);
            if (!empty($translated_id)) {
                $footer_id = $translated_id;
            }
        }

        return $footer_id ? $footer_id : false;
    }
}

/**
 * Display header markup.
 *
 * @since  1.0.2
 */
function hfe_render_header() {

	if ( false == apply_filters( 'enable_hfe_render_header', true ) ) {
		return;
	}

	Header_Footer_Elementor::get_header_content();
}

/**
 * Display footer markup.
 *
 * @since  1.0.2
 */
function hfe_render_footer() {

	if ( false == apply_filters( 'enable_hfe_render_footer', true ) ) {
		return;
	}

	?>
		<footer itemtype="https://schema.org/WPFooter" itemscope="itemscope" id="colophon" role="contentinfo">
			<?php Header_Footer_Elementor::get_footer_content(); ?>
		</footer>
	<?php

}


/**
 * Get HFE Before Footer ID
 *
 * @since  1.0.2
 * @return String|boolean before footer id if it is set else returns false.
 */
function hfe_get_before_footer_id() {

	$before_footer_id = Header_Footer_Elementor::get_settings( 'type_before_footer', '' );

	if ( '' === $before_footer_id ) {
		$before_footer_id = false;
	}

	return apply_filters( 'get_hfe_before_footer_id', $before_footer_id );
}

/**
 * Checks if Before Footer is enabled from HFE.
 *
 * @since  1.0.2
 * @return bool True if before footer is enabled. False if before footer is not enabled.
 */
function hfe_is_before_footer_enabled() {

	$before_footer_id = Header_Footer_Elementor::get_settings( 'type_before_footer', '' );
	$status           = false;

	if ( '' !== $before_footer_id ) {
		$status = true;
	}

	return apply_filters( 'hfe_before_footer_enabled', $status );
}

/**
 * Display before footer markup.
 *
 * @since  1.0.2
 */
function hfe_render_before_footer() {

	if ( false == apply_filters( 'enable_hfe_render_before_footer', true ) ) {
		return;
	}

	?>
		<div class="hfe-before-footer-wrap">
			<?php Header_Footer_Elementor::get_before_footer_content(); ?>
		</div>
	<?php

}
