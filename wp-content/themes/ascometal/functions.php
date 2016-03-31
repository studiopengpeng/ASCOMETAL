<?php
/**
 * Author: Ole Fredrik Lie
 * URL: http://olefredrik.com
 *
 * FoundationPress functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @package FoundationPress
 * @since FoundationPress 1.0.0
 */

/** Various clean up functions */
require_once( 'library/cleanup.php' );

/** Required for Foundation to work properly */
require_once( 'library/foundation.php' );

/** Register all navigation menus */
require_once( 'library/navigation.php' );

/** Add menu walkers for top-bar and off-canvas */
require_once( 'library/menu-walkers.php' );

/** Create widget areas in sidebar and footer */
require_once( 'library/widget-areas.php' );

/** Return entry meta information for posts */
require_once( 'library/entry-meta.php' );

/** Enqueue scripts */
require_once( 'library/enqueue-scripts.php' );

/** Add theme support */
require_once( 'library/theme-support.php' );

/** Add Nav Options to Customer */
require_once( 'library/custom-nav.php' );

/** Change WP's sticky post class */
require_once( 'library/sticky-posts.php' );

/** If your site requires protocol relative url's for theme assets, uncomment the line below */
// require_once( 'library/protocol-relative-theme-assets.php' );

//** Tailles d'images personnalisées
add_theme_support('post-thumbnails');
if (function_exists('add_image_size')) {
     add_image_size('vignette_actu', 190, 190, true);
	 add_image_size('vignette_blocs', 590, 590, array('center', 'center'));
}

//** titre de la page parente dans le header
function parent_page_title() {
	global $post;
	$parent = empty( $post->post_parent ) ? '' : get_the_title($post->post_parent);
    echo $parent;
}

// tronk actus
function tronk($texte, $nbcars, $separ) {
$max_caracteres=$nbcars;
//épure html
$phrase  = $texte;
$orig = array("<p>", "</p>", "<b>", "</b>", "<strong>", "</strong>");
$nouvo   = array("", "", "", "");
$texte = str_replace($orig, $nouvo, $phrase);
// tronque
if (strlen($texte)>$max_caracteres){    
$texte = substr($texte, 0, $max_caracteres);
$position_espace = strrpos($texte, " ");
$texte = substr($texte, 0, $position_espace);
$texte = $texte.$separ;
}
return $texte;
}


/**
 *Widget area pour l'actu sur homepage
 *
 */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home widget actu',
		'id'            => 'home_actu_widget',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="rounded">',
		'after_title'   => '</h3>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );

/*  Thumbnail upscale
/* ------------------------------------ */ 
function alx_thumbnail_upscale( $default, $orig_w, $orig_h, $new_w, $new_h, $crop ){
    if ( !$crop ) return null; // let the wordpress default function handle this
 
    $aspect_ratio = $orig_w / $orig_h;
    $size_ratio = max($new_w / $orig_w, $new_h / $orig_h);
 
    $crop_w = round($new_w / $size_ratio);
    $crop_h = round($new_h / $size_ratio);
 
    $s_x = floor( ($orig_w - $crop_w) / 2 );
    $s_y = floor( ($orig_h - $crop_h) / 2 );
 
    return array( 0, 0, (int) $s_x, (int) $s_y, (int) $new_w, (int) $new_h, (int) $crop_w, (int) $crop_h );
}
add_filter( 'image_resize_dimensions', 'alx_thumbnail_upscale', 10, 6 );
