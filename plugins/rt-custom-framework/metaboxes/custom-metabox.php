<?php
/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'rt_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/cmb2/init.php';
} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
	require_once dirname( __FILE__ ) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $cmb CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function rt_show_if_front_page( $cmb ) {
	// Don't show this metabox if it's not the front page template.
	if ( get_option( 'page_on_front' ) !== $cmb->object_id ) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field $field Field object.
 *
 * @return bool              True if metabox should show
 */
function rt_hide_if_no_cats( $field ) {
	// Don't show this field if not in the cats category.
	if ( ! has_tag( 'cats', $field->object_id ) ) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rt_render_row_cb( $field_args, $field ) {
	$classes     = $field->row_classes();
	$id          = $field->args( 'id' );
	$label       = $field->args( 'name' );
	$name        = $field->args( '_name' );
	$value       = $field->escaped_value();
	$description = $field->args( 'description' );
	?>
	<div class="custom-field-row <?php echo esc_attr( $classes ); ?>">
		<p><label for="<?php echo esc_attr( $id ); ?>"><?php echo esc_html( $label ); ?></label></p>
		<p><input id="<?php echo esc_attr( $id ); ?>" type="text" name="<?php echo esc_attr( $name ); ?>" value="<?php echo $value; ?>"/></p>
		<p class="description"><?php echo esc_html( $description ); ?></p>
	</div>
	<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function rt_display_text_small_column( $field_args, $field ) {
	?>
	<div class="custom-column-display <?php echo esc_attr( $field->row_classes() ); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html( $field->args( 'description' ) ); ?></p>
	</div>
	<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array      $field_args Array of field parameters.
 * @param  CMB2_Field $field      Field object.
 */
function rt_before_row_if_2( $field_args, $field ) {
	if ( 2 == $field->object_id ) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action( 'cmb2_admin_init', 'rt_register_gallery_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rt_register_gallery_metabox() {
	$prefix = 'rt_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-gallery',
		'title'         => esc_html__( 'Gallery Images', 'rs-framework' ),
		'object_types'  => array( 'gallery' ), // Post type
		// 'show_on_cb' => 'rt_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'rt_add_some_classes', // Add classes through a callback.
	) );

	$cmb_project->add_field( array(
	'name' => 'Upload Gallery Images',
	'desc' => '',
	'id'   => 'Screenshot',
	'type' => 'file_list',
	// 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
	// 'query_args' => array( 'type' => 'image' ), // Only images attachment
	// Optional, override default text strings
	'text' => array(
		'add_upload_files_text' => 'Upload Files', // default: "Add or Upload Files"
		'remove_image_text' => 'Replacement', // default: "Remove Image"
		'file_text' => 'Replacement', // default: "File:"
		'file_download_text' => 'Replacement', // default: "Download"
		'remove_text' => 'Replacement', // default: "Remove"
	),
) );
	
}



add_action( 'cmb2_admin_init', 'header_style_register_field_metabox' );
/**
 * Hook in and add a metabox to demonstrate repeatable grouped fields
 */
function header_style_register_field_metabox() {
	$prefix = 'yourprefix_group_header_';

	/**
	 * Repeatable Field Groups
	 */
	$cmb_meta_page = new_cmb2_box( array(
		'id'           => $prefix . 'metabox',
		'title'        => esc_html__( 'Header Layout', 'rs-function' ),
		'object_types' => array( 'elementor-hf' ),
		'priority'     => 'low',  //  'high', 'core', 'default' or 'low'
	) );

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Fixed Header Layout', 'rs-framework' ),
		'desc'    => esc_html__( 'If you active it your header layout will be fixed/absolutue positon', 'rs-framework' ),		
		'id'      => 'header-position',
		'type'    => 'checkbox',
	) );

	
}



// Timeline Year
add_action( 'cmb2_admin_init', 'rt_register_timeline_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rt_register_timeline_metabox() {
	$prefix = 'rt_demo_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$cmb_meta_page = new_cmb2_box( array(
		'id'            => $prefix . 'timeline',
		'title'         => esc_html__( 'Timeline Settings', 'rs-framework' ),
		'object_types'  => array( 'timelines' ), // Post type
		// 'show_on_cb' => 'rt_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'rt_add_some_classes', // Add classes through a callback.
	) );	

	$cmb_meta_page->add_field( array(
		'name'    => esc_html__( 'Enter Period of Time', 'rs-framework' ),
		'desc'    => esc_html__( 'Enter Period of Time i.e year of experience or year', 'rs-framework' ),		
		'id'      => 'year',
		'type'    => 'text_medium',
	) );
}


add_action( 'cmb2_admin_init', 'rt_service_project_metabox' );
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function rt_service_project_metabox() {
	$prefix = 'rt_'; 
	$cmb_project = new_cmb2_box( array(
		'id'            => $prefix . 'metabox-service',
		'title'         => esc_html__( 'Service Thumb Image', 'brickx' ),
		'object_types'  => array( 'services' ), // Post type
		
	) );

	$cmb_project->add_field( array(
		'name' => 'Upload Thumb Image',
		'desc' => '',
		'id'   => 'service-thumb',
		'type' => 'file',
	) );

	$cmb_project->add_field( array(
		'name' => 'Upload Hover Thumb Image',
		'desc' => '',
		'id'   => 'service-thumb-hover',
		'type' => 'file',
	) );
}
function fluxi_add_social_media_fields_to_user_profile($user) {
	?>
	<h3>Social Media Accounts</h3>
	<table class="form-table">
		<tr>
			<th><label for="twitter_url">Twitter URL</label></th>
			<td>
				<input type="text" name="twitter_url" id="twitter_url" value="<?php echo esc_attr(get_the_author_meta('twitter_url', $user->ID)); ?>"><br>
				<span class="description">Enter your Twitter URL.</span>
			</td>
		</tr>
		<tr>
			<th><label for="instagram_url">Instagram URL</label></th>
			<td>
				<input type="text" name="instagram_url" id="instagram_url" value="<?php echo esc_attr(get_the_author_meta('instagram_url', $user->ID)); ?>"><br>
				<span class="description">Enter your instagram URL.</span>
			</td>
		</tr>
		<tr>
			<th><label for="pinterest_url">Pinterest URL</label></th>
			<td>
				<input type="text" name="pinterest_url" id="pinterest_url" value="<?php echo esc_attr(get_the_author_meta('pinterest_url', $user->ID)); ?>"><br>
				<span class="description">Enter your pinterest URL.</span>
			</td>
		</tr>
		<!-- Add more lines for other social media fields as needed -->
	</table>

	
<?php
 }
add_action('show_user_profile', 'fluxi_add_social_media_fields_to_user_profile');
add_action('edit_user_profile', 'fluxi_add_social_media_fields_to_user_profile');

function fluxi_save_social_media_fields($user_id) {
	if (current_user_can('edit_user', $user_id)) {
		update_user_meta($user_id, 'twitter_url', sanitize_text_field($_POST['twitter_url']));
		update_user_meta($user_id, 'instagram_url', sanitize_text_field($_POST['instagram_url']));
		update_user_meta($user_id, 'pinterest_url', sanitize_text_field($_POST['pinterest_url']));
	}
}
add_action('personal_options_update', 'fluxi_save_social_media_fields');
add_action('edit_user_profile_update', 'fluxi_save_social_media_fields');

// Add user banner Image field to user profile
function custom_add_user_banner_field($user) {
    ?>
    <h3><?php _e('banner Image', 'rs-framework'); ?></h3>
    <table class="form-table">
        <tr>
            <th><label for="user_banner_image"><?php _e('Upload banner Image', 'rs-framework'); ?></label></th>
            <td>
                <input type="text" name="user_banner_image" id="user_banner_image" value="<?php echo esc_attr(get_the_author_meta('user_banner_image', $user->ID)); ?>" class="regular-text"/>
                <input type="button" class="button-secondary" id="upload_banner_image_button" value="<?php _e('Upload Image', 'rs-framework'); ?>" />
                <p class="description"><?php _e('Upload a banner image for your profile.', 'rs-framework'); ?></p>
            </td>
        </tr>
    </table>
   <!-- User Profile banner Image Script  -->
	<script type="text/javascript">
	(function($){
		"use strict";
		jQuery(document).ready(function($){
			var custom_uploader;
			$('#user_banner_image').prop('readonly',true);
			// banner Image Insert
			$('#upload_banner_image_button').click(function(e) {
				e.preventDefault();
				if (custom_uploader) {
					custom_uploader.open();
					return;
				}
				custom_uploader = wp.media.frames.file_frame = wp.media({
					title: 'Choose Image',
					button: {
						text: 'Choose Image'
					},
					multiple: false
				});
				custom_uploader.on('select', function() {
					var attachment = custom_uploader.state().get('selection').first().toJSON();
					$('#user_banner_image').val(attachment.url);
				});
				custom_uploader.open();
			});
			// banner Image Delete
			$('#delete_banner_image').on('click', function(e) {
				e.preventDefault();
				var confirmDelete = confirm('Are you sure you want to delete the banner image?');

				if (confirmDelete) {

					var data = {
						action: "delete_banner_image",
						user_id: <?php echo $user->ID; ?>,
						nonce: '<?php echo wp_create_nonce('delete_banner_image_nonce'); ?>'
					};
					$.post(ajaxurl, data, function(response) {
						if (response.success) {
							location.reload();
						} else {
							alert("Error deleting banner image.");
						}
					});
				}
			});
		});
	})(jQuery);
	</script>
    <?php
}
add_action('show_user_profile', 'custom_add_user_banner_field');
add_action('edit_user_profile', 'custom_add_user_banner_field');
// Save custom field data
function custom_save_user_banner_field($user_id) {
    if (current_user_can('edit_user', $user_id)) {
        update_user_meta($user_id, 'user_banner_image', sanitize_text_field($_POST['user_banner_image']));
    }
}
add_action('personal_options_update', 'custom_save_user_banner_field');
add_action('edit_user_profile_update', 'custom_save_user_banner_field');

// Display the user banner image in the admin area
function custom_display_user_banner_image() {
    $user_id = get_current_user_id();
    $banner_image = get_the_author_meta('user_banner_image', $user_id);
	if ($banner_image) {
        echo '<style>.user-profile-picture { max-width: 100px; height: auto; }</style>';
        echo '<table class="form-table"><tr><th>banner Image</th><td>';
        echo '<img src="' . esc_url($banner_image) . '" alt="Profile Picture" class="user-profile-picture" />';
        echo '<br><button id="delete_banner_image" class="button">Delete banner Image</button>';
        echo '</td></tr></table>';
    }
}
add_action('show_user_profile', 'custom_display_user_banner_image');
add_action('edit_user_profile', 'custom_display_user_banner_image');

// <!-- Delete -->
add_action('wp_ajax_delete_banner_image', 'delete_banner_image');
function delete_banner_image() {
    check_ajax_referer('delete_banner_image_nonce', 'nonce');

    if (current_user_can('edit_user', $_POST['user_id'])) {
        delete_user_meta($_POST['user_id'], 'user_banner_image');
        wp_send_json_success();
    } else {
        wp_send_json_error();
    }
}

function rt_options_page_message_callback( $cmb, $args ) {
	if ( ! empty( $args['should_notify'] ) ) {

		if ( $args['is_updated'] ) {

			// Modify the updated message.
			$args['message'] = sprintf( esc_html__( '%s &mdash; Updated!', 'rs-framework' ), $cmb->prop( 'title' ) );
		}

		add_settings_error( $args['setting'], $args['code'], $args['message'], $args['type'] );
	}
}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function rt_limit_rest_view_to_logged_in_users( $is_allowed, $cmb_controller ) {
	if ( ! is_user_logged_in() ) {
		$is_allowed = false;
	}

	return $is_allowed;
}