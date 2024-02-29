<?php


add_theme_support( 'custom-logo' );

function vip_custom_logo_setup() {
	$defaults = array(
		'height'               => 100,
		'width'                => 400,
		'flex-height'          => true,
		'flex-width'           => true,
		'header-text'          => array( 'site-title', 'site-description' ),
		'unlink-homepage-logo' => true, 
	);
	add_theme_support( 'custom-logo', $defaults );
}
add_action( 'after_setup_theme', 'vip_custom_logo_setup' );

function viptheme_setup() {
  //  wp_enqueue_style( 'tailwind', 'https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css', false, '1.1', 'all');
  //  wp_enqueue_style( 'tailwind', 'https://cdn.tailwindcss.com', false, '1.1', 'all');
  //  add_filter('style_loader_tag', 'vip_style_loader_tag_function');

  wp_enqueue_script( 'tailwind', 'https://cdn.tailwindcss.com', false, '1.1', []);

}

add_action( 'wp_enqueue_scripts', 'viptheme_setup', 9999 );

// function vip_style_loader_tag_function($tag){
//   //do stuff here to find and replace the rel attribute
//   echo($tag);    exit;
//   return preg_replace("/='stylesheet' id='less-css'/", "='stylesheet/less' id='less-css'", $tag);
// }



// enable SVG Support
function enable_svg_upload( $upload_mimes ) {
    $upload_mimes['svg'] = 'image/svg+xml';
    $upload_mimes['svgz'] = 'image/svg+xml';
    return $upload_mimes;
}
add_filter( 'upload_mimes', 'enable_svg_upload', 10, 1 );


function register_vip_menus() {
  register_nav_menus(
    array(
      'header-menu' => __( 'Header Menu' ),
      'footer-menu' => __( 'Footer Menu' )
     )
   );
 }
 add_action( 'init', 'register_vip_menus' );


 function get_custom_logo_url() {
  
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
    return $image[0];
}

// add extra image sizes
function register_vip_custom_image_sizes() {
  if ( ! current_theme_supports( 'post-thumbnails' ) ) {
    add_theme_support( 'post-thumbnails' );
  }
  add_image_size( '128-small-square', 128, 128, true );
  add_image_size( '168-small-square', 168, 168, true );
  // add_image_size( 'custom-landscape', 1000, 600 );
}
add_action( 'after_setup_theme', 'register_vip_custom_image_sizes' );



add_filter( 'default_wp_template_part_areas', 'vip_template_part_areas' );

function vip_template_part_areas( array $areas ) {
	$areas[] = array(
		'area'        => 'newsletter',
		'area_tag'    => 'newsletter',
		'label'       => __( 'Newsletter', 'vipfootballtickets' ),
		'description' => __( 'Custom description', 'vipfootballtickets' ),
		'icon'        => 'sidebar'
	);

	return $areas;
}





