<?php
/*
dynamic css file. please don't edit it. it's updated automatically when settings change
*/
add_action('wp_head', 'bizgen_custom_colors', 160);
function bizgen_custom_colors() {
	global $bizgen_option;

	// Background color with a default fallback
	$body_bg = !empty($bizgen_option['body_bg_color']) ? $bizgen_option['body_bg_color'] : '#ffffff';
	
	// Colors with fallback values
	$body_text_color = !empty($bizgen_option['body_text_color']) ? $bizgen_option['body_text_color'] : '#868689'; 
	$color_primary = !empty($bizgen_option['color-primary']) ? $bizgen_option['color-primary'] : '#3358D3';
	$color_secondary = !empty($bizgen_option['color-secondary']) ? $bizgen_option['color-secondary'] : '#1D1D1E';
	
	// Typography
	$body_typography_font = !empty($bizgen_option['opt-typography-body']['font-family']) ? $bizgen_option['opt-typography-body']['font-family'] : 'Arial, sans-serif';
	$body_typography_font_size = !empty($bizgen_option['opt-typography-body']['font-size']) ? $bizgen_option['opt-typography-body']['font-size'] : '16px';

	?>
	<style>
		body {
			background: <?php echo sanitize_hex_color($body_bg); ?>;
			color: <?php echo sanitize_hex_color($body_text_color); ?>;
			font-family: <?php echo esc_attr($body_typography_font); ?> ;
			font-size: <?php echo esc_attr($body_typography_font_size); ?> ;
		}
		:root {
			--color-primary: <?php echo sanitize_hex_color($color_primary); ?>;
			--color-secondary: <?php echo sanitize_hex_color($color_secondary); ?> ;
		}

		<?php if (!empty($bizgen_option['container_size'])) : ?>
		@media only screen and (min-width: 1300px) {
			.container {
				max-width: <?php echo esc_attr($bizgen_option['container_size']); ?>;
			}
		}
		<?php endif; ?>

		<?php if (!empty($bizgen_option['preloader_bg_color'])) : ?>
		.loader-wrapper .loader-section{
			background: <?php echo sanitize_hex_color($bizgen_option['preloader_bg_color']); ?>;
		}
		<?php endif; ?>
	</style>
	<?php
}