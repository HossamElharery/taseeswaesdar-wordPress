<?php
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function bizgen_body_classes( $classes ) {
  // Adds a class of hfeed to non-singular pages.
  if ( ! is_singular() ) {
    $classes[] = 'hfeed';
  }

  return $classes;
}
add_filter( 'body_class', 'bizgen_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function bizgen_pingback_header() {
  if ( is_singular() && pings_open() ) {
    echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
  }
}

add_action( 'wp_head', 'bizgen_pingback_header' );
/**  kses_allowed_html */
function bizgen_prefix_kses_allowed_html($tags, $context) {
  switch($context) {
    case 'bizgen': 
      $tags = array( 
        'a' => array('href' => array()),
        'b' => array()
      );
      return $tags;
    default: 
      return $tags;
  }
}
add_filter( 'wp_kses_allowed_html', 'bizgen_prefix_kses_allowed_html', 10, 2);

/*
Register Fonts theme google font
*/
function bizgen_studio_fonts_url() {
    $font_url = '';    
    /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
    if ( 'off' !== _x( 'on', 'Google font: on or off', 'bizgen' ) ) {
        $font_url = add_query_arg( 'family', urlencode( 'Inter Tight:300,400,500,600,700,800&display=swap' ), "//fonts.googleapis.com/css" );
    }
    return $font_url;
}


function bizgen_studio_scripts() {
    wp_enqueue_style( 'studio-fonts', bizgen_studio_fonts_url(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'bizgen_studio_scripts' );

//Favicon Icon
function bizgen_site_icon() {
 if ( ! ( function_exists( 'has_site_icon' ) && has_site_icon() ) ) {     
    global $bizgen_option;
     
    if(!empty($bizgen_option['rs_favicon']['url']))
    {?>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(($bizgen_option['rs_favicon']['url'])); ?>"> 
  <?php 
    }
  }
}
add_filter('wp_head', 'bizgen_site_icon');

//excerpt for specific section
function bizgen_wpex_get_excerpt( $args = array() ) {
  // Defaults
  $defaults = array(
    'post'            => '',
    'length'          => 48,
    'readmore'        => false,
    'readmore_text'   => esc_html__( 'read more', 'bizgen' ),
    'readmore_after'  => '',
    'custom_excerpts' => true,
    'disable_more'    => false,
  );
  // Apply filters
  $defaults = apply_filters( 'bizgen_wpex_get_excerpt_defaults', $defaults );
  // Parse args
  $args = wp_parse_args( $args, $defaults );
  // Apply filters to args
  $args = apply_filters( 'bizgen_wpex_get_excerpt_args', $defaults );
  // Extract
  extract( $args );
  // Get global post data
  if ( ! $post ) {
    global $post;
  }

  $post_id = $post->ID;
  if ( $custom_excerpts && has_excerpt( $post_id ) ) {
    $output = $post->post_excerpt;
  } 
  else { 
    $readmore_link = '<a href="' . get_permalink( $post_id ) . '" class="readmore">' . $readmore_text . $readmore_after . '</a>';    
    if ( ! $disable_more && strpos( $post->post_content, '<!--more-->' ) ) {
      $output = apply_filters( 'the_content', get_the_content( $readmore_text . $readmore_after ) );
    }    
    else {     
      $output = wp_trim_words( strip_shortcodes( $post->post_content ), $length );      
      if ( $readmore ) {
        $output .= apply_filters( 'bizgen_wpex_readmore_link', $readmore_link );
      }
    }
  }
  // Apply filters and echo
  return apply_filters( 'bizgen_wpex_get_excerpt', $output );
}

//Demo content file include here

function bizgen_import_files() {
  return array(
    array(
      'import_file_name'           => 'Home One',
      'categories'                 => array( 'Home One' ),
      'import_file_url'            => 'https://reacthemesdemo.vercel.app/bizgen//bizgen-content-1.xml',
             
      'import_redux'               => array(
        array(
          'file_url'    => 'https://reacthemesdemo.vercel.app/bizgen/bizgen-options.json',
          'option_name' => 'bizgen_option',
        ),
      ),

      'import_preview_image_url'   => 'https://themewant.com/products/wordpress/landing/bizgen/assets/images/demos/01.webp',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'bizgen' ),
      'preview_url'                => 'https://themewant.com/products/wordpress/bizgen',     
      
    ),
    array(
      'import_file_name'           => 'Home Two',
      'categories'                 => array( 'Home Two' ),
      'import_file_url'            => 'https://reacthemesdemo.vercel.app/bizgen//bizgen-content-2.xml',
             
      'import_redux'               => array(
        array(
          'file_url'    => 'https://reacthemesdemo.vercel.app/bizgen/bizgen-options.json',
          'option_name' => 'bizgen_option',
        ),
      ),

      'import_preview_image_url'   => 'https://themewant.com/products/wordpress/landing/bizgen/assets/images/demos/02.webp',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'bizgen' ),
      'preview_url'                => 'https://themewant.com/products/wordpress/bizgen/home-2',     
      
    ),
    array(
      'import_file_name'           => 'Home Three',
      'categories'                 => array( 'Home Three' ),
      'import_file_url'            => 'https://reacthemesdemo.vercel.app/bizgen//bizgen-content-3.xml',
             
      'import_redux'               => array(
        array(
          'file_url'    => 'https://reacthemesdemo.vercel.app/bizgen/bizgen-options.json',
          'option_name' => 'bizgen_option',
        ),
      ),

      'import_preview_image_url'   => 'https://themewant.com/products/wordpress/landing/bizgen/assets/images/demos/03.webp',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'bizgen' ),
      'preview_url'                => 'https://themewant.com/products/wordpress/bizgen/home-3',     
      
    ),

    array(
      'import_file_name'           => 'Onepage One',
      'categories'                 => array( 'Onepage One' ),
      'import_file_url'            => 'https://reacthemesdemo.vercel.app/bizgen//onepage-content-1.xml',
             
      'import_redux'               => array(
        array(
          'file_url'    => 'https://reacthemesdemo.vercel.app/bizgen/bizgen-options.json',
          'option_name' => 'bizgen_option',
        ),
      ),

      'import_preview_image_url'   => 'https://themewant.com/products/wordpress/landing/bizgen/assets/images/demos/01.webp',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'bizgen' ),
      'preview_url'                => 'https://themewant.com/products/wordpress/bizgen/onepage-1',     
      
    ),
    array(
      'import_file_name'           => 'Onepage Two',
      'categories'                 => array( 'Onepage Two' ),
      'import_file_url'            => 'https://reacthemesdemo.vercel.app/bizgen/onepage-content-2.xml',
             
      'import_redux'               => array(
        array(
          'file_url'    => 'https://reacthemesdemo.vercel.app/bizgen/bizgen-options.json',
          'option_name' => 'bizgen_option',
        ),
      ),

      'import_preview_image_url'   => 'https://themewant.com/products/wordpress/landing/bizgen/assets/images/demos/02.webp',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'bizgen' ),
      'preview_url'                => 'https://themewant.com/products/wordpress/bizgen/onepage2',     
      
    ),

    array(
      'import_file_name'           => 'Onepage Three',
      'categories'                 => array( 'Onepage Three' ),
      'import_file_url'            => 'https://reacthemesdemo.vercel.app/bizgen//onepage-content-3.xml',
             
      'import_redux'               => array(
        array(
          'file_url'    => 'https://reacthemesdemo.vercel.app/bizgen/bizgen-options.json',
          'option_name' => 'bizgen_option',
        ),
      ),

      'import_preview_image_url'   => 'https://themewant.com/products/wordpress/landing/bizgen/assets/images/demos/03.webp',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'bizgen' ),
      'preview_url'                => 'https://themewant.com/products/wordpress/bizgen/onepage3',     
      
    ),

    array(
      'import_file_name'           => 'RTL Demo',
      'categories'                 => array( 'RTL' ),
      'import_file_url'            => 'https://reacthemesdemo.vercel.app/bizgen/rtl/bizgen.xml',
             
      'import_redux'               => array(
        array(
          'file_url'    => 'https://reacthemesdemo.vercel.app/bizgen/rtl/bizgen-options.json',
          'option_name' => 'bizgen_option',
        ),
      ),

      'import_preview_image_url'   => 'https://themewant.com/products/wordpress/landing/bizgen/assets/images/demos/rtl.webp',
     'import_notice'              => esc_html__( 'Caution: For importing demo data please click on "Import Demo Data" button. During demo data installation please do not refresh the page.', 'bizgen' ),
      'preview_url'                => 'https://themewant.com/products/wordpress/bizgen/rtl',     
      
    ),
  
  );
}

add_filter( 'pt-ocdi/import_files', 'bizgen_import_files' );

function bizgen_after_import_setup($selected_import) {
  // Assign menus to their locations.
  $main_menu     = get_term_by( 'name', 'Primary Menu', 'nav_menu' );  
  set_theme_mod( 'nav_menu_locations', array(
      'menu-1' => $main_menu->term_id,          
    )
  );
  if ( 'Home One' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home');
  }

  if ( 'RTL Demo' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home');
  }


  if ( 'Home Two' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home 2');
  }

  if ( 'Home Three' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Home 3');
  }

  if ( 'Onepage One' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Onepage 1');
  }

  if ( 'Onepage Two' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Onepage2');
  }

  if ( 'Onepage Three' == $selected_import['import_file_name'] ) {
    $front_page_id = get_page_by_title('Onepage3');
  }

 
  
  $blog_page_id  = get_page_by_title( 'Blog' );
  update_option( 'show_on_front', 'page' );
  update_option( 'page_on_front', $front_page_id->ID );
  update_option( 'page_for_posts', $blog_page_id->ID );  

   //Import Revolution Slider
   if ( class_exists( 'RevSlider' ) ) {
    $slider_array = array(
      get_template_directory()."/inc/demo-data/home-1.zip",                            
      get_template_directory()."/inc/demo-data/home-2.zip", 
      get_template_directory()."/inc/demo-data/home3.zip",  

      get_template_directory()."/inc/demo-data/rtl-home-1.zip",                            
      get_template_directory()."/inc/demo-data/rtl-home-2.zip", 
      get_template_directory()."/inc/demo-data/-RTL-home3.zip",  
     
    );
    $slider = new RevSlider();
    foreach($slider_array as $filepath){
      $slider->importSliderFromPost(true,true,$filepath);  
    }
  }
}
add_action( 'pt-ocdi/after_import', 'bizgen_after_import_setup' );

//support svg image funciton
add_filter( 'use_widgets_block_editor', '__return_false' );

//disable elementor default style 
update_option('elementor_disable_color_schemes', 'yes');
update_option('elementor_disable_typography_schemes', 'yes');

//added elementor support for custom post type
function bizgen_enable_elementor_for_custom_post_type() {
  add_post_type_support( 'rt-portfolios', 'elementor' );
  add_post_type_support( 'teams', 'elementor' );
  add_post_type_support( 'rts-canvans', 'elementor' );
  add_post_type_support( 'rtelements_pro', 'elementor' );
}
add_action( 'init', 'bizgen_enable_elementor_for_custom_post_type' );