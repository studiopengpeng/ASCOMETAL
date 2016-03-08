<?php
/*
Plugin Name: Logos Showcase
Plugin URI: http://www.cmoreira.net/logos-showcase
Description: This plugin allows you to display images on a responsive grid or carousel. It's perfect to display logos of clients, partners, sponsors or any other group of images that requires this type of layout.
Author: Carlos Moreira
Version: 1.7
Author URI: http://cmoreira.net
*/

// Last modified: February 2 2015

// Next Edits:
// remember shortcode
// translation files

// Last Edits:

// visual composer integration
// added option to set custom wrapper css class
// added ability to set a custom url for the image
// added ability to add individual padding and margin values for each image
// added custom js field in the settings
// carousel css fix
// fontawesome version updated
// added quick edit fields



add_filter( 'pts_post_type_filter', "pts_disable");
function pts_disable( $args ) {
    $postType  = get_post_type();
    if( 'lshowcase' === $postType ){
        $args = array(
          'name' => 'lshowcase'
        );
    }
    return $args;
}

// ordering code

require_once dirname(__FILE__) . '/ordering-code.php';

// shortcode generator page

require_once dirname(__FILE__) . '/shortcode-generator.php';

// widget code

require_once dirname(__FILE__) . '/widget-code.php';


//count for multiple pager layouts in same page

$lshowcase_slider_count = 0;
$lshowcase_slider_array = array();

// Adding the necessary actions to initiate the plugin

add_action( 'init', 'register_cpt_lshowcase' );
add_action( 'admin_init', 'register_lshowcase_settings' );
//add_action( 'do_meta_boxes', 'lshowcase_image_box' ); 
add_action( 'admin_menu', 'lshowcase_shortcode_page_add' );
add_action( 'admin_menu', 'lshowcase_admin_page' );
add_filter( 'manage_posts_columns', 'lshowcase_columns_head' );
add_action( 'manage_posts_custom_column', 'lshowcase_columns_content', 10, 2 );

// Add support for post-thumbnails in case theme does not

add_action( 'init', 'lshowcase_add_thumbnails_for_cpt' );

function lshowcase_add_thumbnails_for_cpt()
{
	global $_wp_theme_features;
	if (isset($_wp_theme_features['post-thumbnails']) && $_wp_theme_features['post-thumbnails'] == 1) {
		return;
	}

	if (isset($_wp_theme_features['post-thumbnails'][0]) && is_array($_wp_theme_features['post-thumbnails'][0]) && count($_wp_theme_features['post-thumbnails'][0]) >= 1) {
		array_push($_wp_theme_features['post-thumbnails'][0], 'lshowcase' );
		return;
	}

	if (empty($_wp_theme_features['post-thumbnails'])) {
		$_wp_theme_features['post-thumbnails'] = array(
			array(
				'lshowcase'
			)
		);
		return;
	}
}

// Add New Thumbnail Size

$lshowcase_crop = false;
$lshowcase_options = get_option( 'lshowcase-settings' );

if ($lshowcase_options['lshowcase_thumb_crop'] == "true" ) {
	$lshowcase_crop = true;
}

add_image_size( 'lshowcase-thumb', $lshowcase_options['lshowcase_thumb_width'], $lshowcase_options['lshowcase_thumb_height'], $lshowcase_crop);


// register the custom post type for the logos showcase

function register_cpt_lshowcase()
{
	$options = get_option( 'lshowcase-settings' );
	$name = $options['lshowcase_name_singular'];
	$nameplural = $options['lshowcase_name_plural'];
	$labels = array(
		'name' => _x($nameplural, 'lshowcase' ) ,
		'singular_name' => _x($name, 'lshowcase' ) ,
		'add_new' => _x( 'Add New ' . $name, 'lshowcase' ) ,
		'add_new_item' => _x( 'Add New ' . $name, 'lshowcase' ) ,
		'edit_item' => _x( 'Edit ' . $name, 'lshowcase' ) ,
		'new_item' => _x( 'New ' . $name, 'lshowcase' ) ,
		'view_item' => _x( 'View ' . $name, 'lshowcase' ) ,
		'search_items' => _x( 'Search ' . $nameplural, 'lshowcase' ) ,
		'not_found' => _x( 'No ' . $nameplural . ' found', 'lshowcase' ) ,
		'not_found_in_trash' => _x( 'No ' . $nameplural . ' found in Trash', 'lshowcase' ) ,
		'parent_item_colon' => _x( 'Parent ' . $name . ':', 'lshowcase' ) ,
		'menu_name' => _x($nameplural, 'lshowcase' ) ,
	);
	$args = array(
		'labels' => $labels,
		'hierarchical' => false,
		'supports' => array(
			'title',
			'thumbnail',
			'custom-fields',
			'page-attributes'
		) ,
		'public' => false,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'publicly_queryable' => false,
		'exclude_from_search' => true,
		'has_archive' => true,
		'query_var' => true,
		'can_export' => true,
		'rewrite' => true,
		'capability_type' => 'post',
		'menu_icon' => plugins_url( 'images/icon16.png', __FILE__) ,
		//'menu_position' => 53
	);
	register_post_type( 'lshowcase', $args);
}

// register custom category
// WP Menu Categories

add_action( 'init', 'lshowcase_build_taxonomies', 0);

function lshowcase_build_taxonomies()
{
	register_taxonomy( 'lshowcase-categories', 'lshowcase', array(
		'hierarchical' => true,
		'label' => 'Categories',
		'query_var' => true,
		'rewrite' => true
	));
}

// move featured image box to top
//currently disabled - moved all metabox processing to same function lshowcase_add_custom_metabox
function lshowcase_image_box()
{

	$options = get_option( 'lshowcase-settings' );
	$name = $options['lshowcase_name_singular'];

	remove_meta_box( 'postimagediv', 'lshowcase', 'side' );
	add_meta_box( 'postimagediv', $name.' '.__( 'Image' ) , 'post_thumbnail_meta_box', 'lshowcase', 'normal', 'high' );
}

// change Title Info

function lshowcase_change_default_title($title)
{
	$screen = get_current_screen();
	$options = get_option( 'lshowcase-settings' );
	$name = $options['lshowcase_name_singular'];
	$nameplural = $options['lshowcase_name_plural'];
	if ( 'lshowcase' == $screen->post_type) {
		$title = 'Insert ' . $name . ' Name Here';
	}

	return $title;
}

add_filter( 'enter_title_here', 'lshowcase_change_default_title' );

function lshowcase_wps_translation_mangler($translation, $text, $domain)
{
	global $post;
	if (isset($post)) {
		if ($post->post_type == 'lshowcase' ) {
			$translations =  get_translations_for_domain($domain);
			if ($text == 'Publish' ) {
				return $translations->translate( 'SAVE' );
			}
		}
	}

	return $translation;
}

add_filter( 'gettext', 'lshowcase_wps_translation_mangler', 10, 4);

// Order by menu_order in the ADMIN screen

function lshowcase_admin_order($wp_query)
{
	if (is_post_type_archive( 'lshowcase' ) && is_admin()) {
		if (!isset($_GET['orderby'])) {
			$wp_query->set( 'orderby', 'menu_order' );
			$wp_query->set( 'order', 'ASC' );
		}
	}
}

// This will default the ordering admin to the 'menu_order' - will disable other ordering options

add_filter( 'pre_get_posts', 'lshowcase_admin_order' );

// to dispay all entries in admin

function lshowcase_posts_per_page_admin($wp_query) {
  if (is_post_type_archive( 'lshowcase' ) && is_admin() ) {    
		

		  $wp_query->set( 'posts_per_page', '-1' );
	
  		
  	}
}

//This will the filter above to display all entries in the admin page
add_filter('pre_get_posts', 'lshowcase_posts_per_page_admin');



/*
* Display the padding & margin metabox
*/


function lshowcase_spacing_custom_metabox()
{
	global $post;

	$padding_top = get_post_meta($post->ID, '_lsptop', true);
	$padding_bottom = get_post_meta($post->ID, '_lspbottom', true);
	$padding_left = get_post_meta($post->ID, '_lspleft', true);
	$padding_right = get_post_meta($post->ID, '_lspright', true);
	$margin_top = get_post_meta($post->ID, '_lsmtop', true);
	$margin_bottom = get_post_meta($post->ID, '_lsmbottom', true);
	$margin_left = get_post_meta($post->ID, '_lsmleft', true);
	$margin_right = get_post_meta($post->ID, '_lsmright', true);
	$percentage = get_post_meta($post->ID, '_lspercentage', true);


 ?>
<table id="lshowcase_admin_table_spacing">	

	<tr>
		<td> <strong><?php echo __('Max-width Percentage','lshowcase'); ?></strong>
		</td>
		<td> &nbsp;
		</td>
		<td> <strong><?php echo __('Padding','lshowcase'); ?></strong>
		</td>
		<td> Top
		</td>
		<td> Right
		</td>
		<td> Bottom
		</td>
		<td> Left
		</td>
		<td> &nbsp;
		</td>
		<td> <strong><?php echo __('Margin','lshowcase'); ?></strong>
		</td>
		<td> Top
		</td>
		<td> Right
		</td>
		<td> Bottom
		</td>
		<td> Left
		</td>
		
		

	</tr>

	<tr>
		<td> <input id="_lspercentage" name="_lspercentage" type="text" value="<?php
					if ($percentage) {
						echo $percentage;
					} ?>" /> %
		</td>
		<td> 
		</td>
		<td> 
		</td>
		<td> <input id="_lsptop" name="_lsptop" type="text" value="<?php
					if ($padding_top) {
						echo $padding_top;
					} ?>" />
		</td>
		<td> <input id="_lspright" name="_lspright" type="text" value="<?php
					if ($padding_right) {
						echo $padding_right;
					} ?>" />
		</td>
		<td> <input id="_lspbottom" name="_lspbottom" type="text" value="<?php
					if ($padding_bottom) {
						echo $padding_bottom;
					} ?>" />
		</td>
		<td> <input id="_lspleft" name="_lspleft" type="text" value="<?php
					if ($padding_left) {
						echo $padding_left;
					} ?>" />
		</td>
		<td> &nbsp;
		</td>
		<td> 
		</td>
		<td> <input id="_lsmtop" name="_lsmtop" type="text" value="<?php
					if ($margin_top) {
						echo $margin_top;
					} ?>" />
		</td>
		<td> <input id="_lsmright" name="_lsmright" type="text" value="<?php
					if ($margin_right) {
						echo $margin_right;
					} ?>" />
		</td>
		<td> <input id="_lsmbottom" name="_lsmbottom" type="text" value="<?php
					if ($margin_bottom) {
						echo $margin_bottom;
					} ?>" />
		</td>
		<td> <input id="_lsmleft" name="_lsmleft" type="text" value="<?php
					if ($margin_left) {
						echo $margin_left;
					} ?>" />
		</td>
		
		
	</tr>
	<tr>
		<td colspan="13">
			<span class="howto"><?php echo __('Use these fields to add custom spacing values to this image. Don\'t forget to use the unit, like 10px or 1.1em.','lshowcase'); ?>
		</td>
	</tr>

</table>
<?php
}

/**
 * Display the URL metabox
 */

function lshowcase_url_custom_metabox()
{
	global $post;
	$urllink = get_post_meta($post->ID, 'urllink', true);
	$urldesc = get_post_meta($post->ID, 'urldesc', true);

	if ($urllink != "" && !preg_match( "/http(s?):\/\//", $urllink)) {
		$errors = 'Url not valid';
		$urllink = 'http://';
	}

	// output invlid url message and add the http:// to the input field

	if (isset($errors)) {
		echo $errors;
	} ?>

	<table id="lshowcase_admin_table">
		
		<thead>
			<tr>
				<th><?php echo __('URL:','lshowcase'); ?></th>
				<th><?php echo __('Description:','lshowcase'); ?></th>
			<tr>
		</thead>
		<tbody>
			<tr>
				<td class="left" style="width:50%;"> 
					<label class="screen-reader-text" for="siteurl"><?php echo __('URL','lshowcase'); ?></label>
					<input style="width:100%;" id="siteurl" name="siteurl" type="url" value="<?php
					if ($urllink) {
						echo $urllink;
					} ?>" />

				</td>
				<td style="width:50%;"> 
					<label class="screen-reader-text" for="urldesc"><?php echo __('Description','lshowcase'); ?></label>
					<textarea style="width:100%;" id="urldesc" rows="2" cols="25" name="urldesc" ><?php
					if ($urldesc) {
						echo $urldesc;
					} ?>
					</textarea>
				</td>
			</tr>
			<tr>
				<td class="left"> 
					<span class="howto"><?php echo _('Link to open when image is cliked (if links are active)'); ?></span>
				</td>
				<td> 
					<span class="howto"><?php echo _('Description for this entry. Might be used as the alt or title parameter of the image, or to be displayed in a tooltip.'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>


<?php
}


function lshowcase_image_url_custom_metabox()
{
	global $post;
	$customlink = get_post_meta($post->ID, '_lscustomimageurl', true);

	?>

	<table id="lshowcase_admin_table">
		
		<thead>
			<tr>
				<th><?php echo __('Image URL:','lshowcase'); ?></th>
			<tr>
		</thead>
		<tbody>
			<tr>
				<td> 
					<label class="screen-reader-text" for="siteurl"><?php echo __('URL','lshowcase'); ?></label>
					<input style="width:100%;" id="_lscustomimageurl" name="_lscustomimageurl" type="url" value="<?php
					if ($customlink) {
						echo $customlink;
					} ?>" />

				</td>
			</tr>
			<tr>
				<td> 
					<span class="howto"><?php echo _('If you don\'t want to use an image from your media gallery, you can set an URL for your image here.'); ?></span>
				</td>
			</tr>
		</tbody>
	</table>


<?php
}

/**
 * Process the custom metabox fields
 */

function lshowcase_save_custom_url($post_id)
{
	global $post;
	if (isset($post)) {
		if ($post->post_type == 'lshowcase' ) {
			if ($_POST) {
				update_post_meta($post->ID, 'urllink', $_POST['siteurl']);
				update_post_meta($post->ID, 'urldesc', $_POST['urldesc']);
				update_post_meta($post->ID, '_lsptop', $_POST['_lsptop']);
				update_post_meta($post->ID, '_lspbottom', $_POST['_lspbottom']);
				update_post_meta($post->ID, '_lspleft', $_POST['_lspleft']);
				update_post_meta($post->ID, '_lspright', $_POST['_lspright']);
				update_post_meta($post->ID, '_lsmtop', $_POST['_lsmtop']);
				update_post_meta($post->ID, '_lsmbottom', $_POST['_lsmbottom']);
				update_post_meta($post->ID, '_lsmleft', $_POST['_lsmleft']);
				update_post_meta($post->ID, '_lsmright', $_POST['_lsmright']);
				update_post_meta($post->ID, '_lspercentage', $_POST['_lspercentage']);
				update_post_meta($post->ID, '_lscustomimageurl', $_POST['_lscustomimageurl']);

			}
		}
	}
}

// Add action hooks. Without these we are lost

add_action( 'do_meta_boxes', 'lshowcase_add_custom_metabox' );
add_action( 'save_post', 'lshowcase_save_custom_url' );
/**
 * Add meta box
 */

function lshowcase_add_custom_metabox()
{

	//lshowcase_image_box
	$options = get_option( 'lshowcase-settings' );
	$name = $options['lshowcase_name_singular'];

	remove_meta_box( 'postimagediv', 'lshowcase', 'side' );
	add_meta_box( 'postimagediv', $name.' '.__( 'Image' ) , 'post_thumbnail_meta_box', 'lshowcase', 'normal', 'high' );


	add_meta_box( 'lshowcase-custom-metabox', __( 'URL &amp; Description' ) , 'lshowcase_url_custom_metabox', 'lshowcase', 'normal', 'high' );
	add_meta_box( 'lshowcase-custom-metabox-spacing', __( 'Custom Spacing' ) , 'lshowcase_spacing_custom_metabox', 'lshowcase', 'normal', 'high' );
	add_meta_box( 'lshowcase-custom-metabox-url', __( 'Custom Image URL' ) , 'lshowcase_image_url_custom_metabox', 'lshowcase', 'normal', 'high' );

}

/**
 * Get and return the values for the URL and description
 */

function lshowcase_get_url_desc_box()
{
	global $post;
	$urllink = get_post_meta($post->ID, 'urllink', true);
	$urldesc = get_post_meta($post->ID, 'urldesc', true);
	return array(
		$urllink,
		$urldesc
	);
}

// get the array of data
// $urlbox = get_url_desc_box();
// echo $urlbox[0]; // echo out the url of a post
// echo $urlbox[1]; // echo out the url description of a post


// add options page

function lshowcase_admin_page()
{

	$menu_slug = 'edit.php?post_type=lshowcase';
	$submenu_page_title = 'Settings';
	$submenu_title = 'Settings';
	$capability = 'manage_options';
	$submenu_slug = 'lshowcase_settings';
	$submenu_function = 'lshowcase_settings_page';
	$defaultp = add_submenu_page($menu_slug, $submenu_page_title, $submenu_title, $capability, $submenu_slug, $submenu_function);
}

// options page build

function lshowcase_settings_page()
{
?>
    <div class="wrap">
<h2>Settings</h2>
    <?php
	if (isset($_GET['settings-updated']) && $_GET['settings-updated'] == "true" ) {
		$msg = "Settings Updated";
		lshowcase_message($msg);
	} ?>
	<form method="post" action="options.php" id="dsform">
    <?php
	settings_fields( 'lshowcase-plugin-settings' );
	$options = get_option( 'lshowcase-settings' );
?>
    <table width="70%" border="0" cellspacing="5" cellpadding="5">
  <tr>
    <td colspan="3"><h2>Logo Showcase Names</h2></td>
    </tr>
  <tr>
    <td align="right">Singular Name:</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_name_singular]" value="<?php
	echo $options['lshowcase_name_singular']; ?>" /></td>
    <td rowspan="2" valign="top"><p class="howto">What do you want to call this feature?</p>
      <p class="howto">For Administration purposes only.</p></td>
  </tr>
  <tr>
    <td align="right">Plural Name:</td>
    <td>    <input type="text" name="lshowcase-settings[lshowcase_name_plural]" value="<?php
	echo $options['lshowcase_name_plural']; ?>" />
</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><h2>Logo Image Size Settings</h2></td>
    </tr>
  <tr>
    <td align="right">Width</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_thumb_width]" value="<?php
	echo $options['lshowcase_thumb_width']; ?>" /></td>
    <td rowspan="3" valign="top"><span class="howto">This will be the size of the Images. When they are uploaded they will follow this settings. If you change this settings after the image is uploaded they will show scaled.</span></td>
  </tr>
  <tr>
    <td align="right">Height</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_thumb_height]" value="<?php
	echo $options['lshowcase_thumb_height']; ?>" /></td>
    </tr>
  <tr>
    <td align="right">Crop</td>
    <td><select name="lshowcase-settings[lshowcase_thumb_crop]">
      <option value="true" <?php
	selected($options['lshowcase_thumb_crop'], 'true' ); ?>>Yes</option>
      <option value="false" <?php
	selected($options['lshowcase_thumb_crop'], 'false' ); ?>>No</option>
    </select></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><h2>Default Carousel Settings</h2></td>
    </tr>
  <tr>
    <td align="right" nowrap>Auto Scroll</td>
    <td><select name="lshowcase-settings[lshowcase_carousel_autoscroll]">
      <option value="true"  <?php
	selected($options['lshowcase_carousel_autoscroll'], 'true' ); ?>>Yes - Auto Scroll With Pause</option>
      <option value="ticker"  <?php
	selected($options['lshowcase_carousel_autoscroll'], 'ticker' ); ?>>Yes - Auto Scroll Non Stop</option>
      <option value="false" <?php
	selected($options['lshowcase_carousel_autoscroll'], 'false' ); ?>>No</option>
    </select></td>
    <td><span class="howto">Slides will automatically transition</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Pause Time</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_carousel_pause]" value="<?php
	echo $options['lshowcase_carousel_pause']; ?>" /></td>
    <td><span class="howto">The amount of time (in ms) between each auto transition (if Auto Scroll with Pause is On)</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Pause on Hover</td>
    <td><select name="lshowcase-settings[lshowcase_carousel_autohover]">
      <option value="true" <?php
	selected($options['lshowcase_carousel_autohover'], 'true' ); ?>>Yes</option>
      <option value="false" <?php
	selected($options['lshowcase_carousel_autohover'], 'false' ); ?>>No</option>
    </select></td>
    <td><span class="howto">Auto scroll will pause when mouse hovers over slider</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Auto Controls</td>
    <td><select name="lshowcase-settings[lshowcase_carousel_autocontrols]">
      <option value="true" <?php
	selected($options['lshowcase_carousel_autocontrols'], 'true' ); ?>>Yes</option>
      <option value="false" <?php
	selected($options['lshowcase_carousel_autocontrols'], 'false' ); ?>>No</option>
    </select></td>
    <td><span class="howto">If active, "Start" / "Stop" controls will be added (Doesn't work for Auto Scroll Non Stop)</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Transition Speed:</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_carousel_speed]" value="<?php
	echo $options['lshowcase_carousel_speed']; ?>" /></td>
    <td><span class="howto">Slide transition duration (in ms - intenger) </span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Image Margin:</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_carousel_slideMargin]" value="<?php
	echo $options['lshowcase_carousel_slideMargin']; ?>" /></td>
    <td><span class="howto">Margin between each image (intenger)</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Infinite Loop:</td>
    <td><select name="lshowcase-settings[lshowcase_carousel_infiniteLoop]">
      <option value="true" <?php
	selected($options['lshowcase_carousel_infiniteLoop'], 'true' ); ?>>Yes</option>
      <option value="false" <?php
	selected($options['lshowcase_carousel_infiniteLoop'], 'false' ); ?>>No</option>
    </select></td>
    <td><span class="howto">If Active, clicking "Next" while on the last slide will transition to the first slide and vice-versa</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Show Pager:</td>
    <td><select name="lshowcase-settings[lshowcase_carousel_pager]">
      <option value="true" <?php
	selected($options['lshowcase_carousel_pager'], 'true' ); ?>>Yes</option>
      <option value="false" <?php
	selected($options['lshowcase_carousel_pager'], 'false' ); ?>>No</option>
    </select></td>
    <td><span class="howto">If Active, a pager will be added. (Doesn't work for Auto Scroll Non Stop)</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Show Controls:</td>
    <td><select name="lshowcase-settings[lshowcase_carousel_controls]">
      <option value="true" <?php
	selected($options['lshowcase_carousel_controls'], 'true' ); ?>>Yes</option>
      <option value="false" <?php
	selected($options['lshowcase_carousel_controls'], 'false' ); ?>>No</option>
    </select></td>
    <td><span class="howto">If Active, "Next" / "Prev" image controls will be added. (Doesn't work for Auto Scroll Non Stop)</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Minimum Slides:</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_carousel_minSlides]" value="<?php
	echo $options['lshowcase_carousel_minSlides']; ?>" /></td>
    <td><span class="howto">The minimum number of slides to be shown.</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Maximum Slides:</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_carousel_maxSlides]" value="<?php
	echo $options['lshowcase_carousel_maxSlides']; ?>" /></td>
    <td><span class="howto">The maximum number of slides to be shown. (Place 0 to let the script calculate the maximum number of slides that fit the viewport) </span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Number of Slides to move:</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_carousel_moveSlides]" value="<?php
	echo $options['lshowcase_carousel_moveSlides']; ?>" /></td>
    <td><span class="howto">The number of slides to move on transition.  If zero, the number of fully-visible slides will be used.</span></td>
  </tr>

  

  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><h2>Advanced Settings</h2></td>
    </tr>
 
   <tr>
    <td align="right" valign="top" nowrap>Custom CSS:</td>
    <td><textarea rows="6" columns="10" name="lshowcase-settings[lshowcase_css]"><?php
	if(isset($options['lshowcase_css'])) { echo $options['lshowcase_css']; }  ?></textarea></td>
    <td><span class="howto">Place here any custom CSS you want to display together with the Logos Showcase layout. You can for example target the text below the logos if active, using the following css:
 <br>.lshowcase-description { color:#333; font-weight:bold; }
    </span></td>
  </tr>
   <tr>
    <td align="right" valign="top" nowrap>Custom JS:</td>
    <td><textarea rows="6" columns="10" name="lshowcase-settings[lshowcase_js]"><?php
	if(isset($options['lshowcase_js'])) { echo $options['lshowcase_js']; }  ?></textarea></td>
    <td><span class="howto">Place here any custom javascript you want to display together with the Logos Showcase layout. 
    </span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Default Image URL:</td>
    <td><input type="text" name="lshowcase-settings[lshowcase_default_image]" value="<?php
	if(isset($options['lshowcase_default_image'])) { echo $options['lshowcase_default_image']; }  ?>" /></td>
    <td><span class="howto">If you want the logo entries with no image to display a default one, place the URL here.</span></td>
  </tr>
  <tr>
    <td align="right" nowrap>Force Carousel Transition Mode:</td>
    <td>

    <?php
    $mode = isset($options['lshowcase_carousel_mode']) ? $options['lshowcase_carousel_mode'] : 'horizontal';
    ?>

	<select name="lshowcase-settings[lshowcase_carousel_mode]">
      <option value="horizontal"  <?php
	selected($mode, 'horizontal' ); ?>>Horizontal</option>
      <option value="vertical"  <?php
	selected($mode, 'vertical' ); ?>>Vertical</option>
      <option value="fade"  <?php
	selected($mode, 'fade' ); ?>>Fade</option>
    </select>

</td>
    <td><span class="howto">Options available: 'horizontal', 'vertical' and 'fade'. The 'fade' and 'vertical' mode will only display one slide at a time, ignoring the minimum and maximum slides settings above. Automatic non-stop scrolling carousel will not work in 'fade' mode. This will affect all carousels.</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
 </table>

    
    
	<input type="submit" class="button-primary" value="<?php
	_e( 'Save Changes' ) ?>" />
</form>
<?php
}

// register settings

function register_lshowcase_settings()
{
	register_setting( 'lshowcase-plugin-settings', 'lshowcase-settings' );
}

// register default values

register_activation_hook(__FILE__, 'lshowcase_defaults' );

function lshowcase_defaults()
{
	$tmp = get_option( 'lshowcase-settings' );

	// check for settings version

	if ((!is_array($tmp)) || !isset($tmp['lshowcase_carousel_autoscroll'])) {
		delete_option( 'lshowcase-settings' );
		$arr = array(
			"lshowcase_name_singular" => "Logo",
			"lshowcase_name_plural" => "Logos",
			"lshowcase_thumb_width" => "200",
			"lshowcase_thumb_height" => "200",
			"lshowcase_thumb_crop" => "false",
			"lshowcase_carousel_autoscroll" => "false",
			"lshowcase_carousel_pause" => "4000",
			"lshowcase_carousel_autohover" => "false",
			"lshowcase_carousel_autocontrols" => "false",
			"lshowcase_carousel_speed" => "500",
			"lshowcase_carousel_slideMargin" => "10",
			"lshowcase_carousel_infiniteLoop" => "true",
			"lshowcase_carousel_pager" => "false",
			"lshowcase_carousel_controls" => "true",
			"lshowcase_carousel_minSlides" => "1",
			"lshowcase_carousel_maxSlides" => "0",
			"lshowcase_carousel_moveSlides" => "1",
			"lshowcase_carousel_mode" => "horizontal",
			"lshowcase_css" => "",
			"lshowcase_js" => "",
			"lshowcase_default_image" => "",
			"lshowcase_capability_type_settings" => "manage_options",
			"lshowcase_capability_type_manage" => "manage_options",
			"lshowcase_empty" => "2",
		);
		update_option( 'lshowcase-settings', $arr);
	}
}

// To Show styled messages

function lshowcase_message($msg)
{ ?>
  <div id="message" class="l_updated"><p><?php
	echo $msg; ?></p></div>
<?php
}

// Add new column

function lshowcase_columns_head($defaults)
{
	global $post;
	if (isset($post->post_type) && 'lshowcase' == $post->post_type) {
  		$defaults['lshowcase-categories'] = __('Categories','lshowcase');
		$defaults['featured_image'] = __('Image','lshowcase');
		$defaults['urldesc'] = __('Description','lshowcase');
		$defaults['urllink'] = __('URL','lshowcase');

	}

	return $defaults;
}

// SHOW THE FEATURED IMAGE in admin

function lshowcase_columns_content($column_name, $post_ID)
{
	global $post;
	if ($post->post_type == 'lshowcase' ) {

		if($column_name == 'lshowcase-categories') {
	      $term_list = wp_get_post_terms($post_ID, 'lshowcase-categories', array("fields" => "names"));
	      foreach ( $term_list as $term ) {
	        echo $term.'<br>';
	        }
	     }


		if($column_name == 'urldesc') {
	       echo get_post_meta( $post_ID , 'urldesc' , true );
	     }

	     if($column_name == 'urllink') {
	       echo get_post_meta( $post_ID , 'urllink' , true );
	     }


		if ($column_name == 'featured_image' ) {

			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post_ID) , 'thumbnail');

			if($image != false) {

				$file_info = pathinfo($image[0]);
				if($file_info['extension'] == 'svg') {

					$lshowcase_options = get_option( 'lshowcase-settings' );
					$opt_w = $lshowcase_options['lshowcase_thumb_width'];
					$opt_h = $lshowcase_options['lshowcase_thumb_height'];
					$svg_w = 80;
					$svg_h = (80*$opt_h)/$opt_w;

					echo '<img src="'.$image[0].'" width="'.$svg_w.'" height="'.$svg_h.'">';

				} else {

					echo get_the_post_thumbnail(
						$post_ID, array(
						80,
						80
					));

				}


			}

			
		}
	}
}

// Shortcode
// Add shortcode functionality

add_shortcode( 'show-logos', 'shortcode_lshowcase' );
add_filter( 'widget_text', 'do_shortcode' );
add_filter( 'the_excerpt', 'do_shortcode' );

function shortcode_lshowcase($atts)
{
	$orderby = (array_key_exists( 'orderby', $atts) ? $atts['orderby'] : "menu_order" );
	$category = (array_key_exists( 'category', $atts) ? $atts['category'] : "0" );
	$style = (array_key_exists( 'style', $atts) ? $atts['style'] : "normal" );
	$interface = (array_key_exists( 'interface', $atts) ? $atts['interface'] : "grid" );
	$activeurl = (array_key_exists( 'activeurl', $atts) ? $atts['activeurl'] : "inactive" );
	$tooltip = (array_key_exists( 'tooltip', $atts) ? $atts['tooltip'] : "false" );
	$description = (array_key_exists( 'description', $atts) ? $atts['description'] : "false" );
	$limit = (array_key_exists( 'limit', $atts) ? $atts['limit'] : 0);
	$slidersettings = (array_key_exists( 'carousel', $atts) ? $atts['carousel'] : "");
	$img = (array_key_exists( 'img', $atts) ? $atts['img'] : 0);
	$filter = (array_key_exists( 'filter', $atts) ? $atts['filter'] : 'false');
	$class = (array_key_exists('class',$atts) ? $atts['class'] : '');

	//not part of the shortcode generator, but can be used to filter ids:
	$ids = (array_key_exists( 'ids', $atts) ? $atts['ids'] : "0" );

	$html = build_lshowcase($orderby, $category, $activeurl, $style, $interface, $tooltip, $description, $limit, $slidersettings,$img,$ids,$filter,$class);
	return $html;
}



/*
*
* /////////////////////////////
* FUNCTION TO DISPLAY THE LOGOS
* /////////////////////////////
*
*/

function build_lshowcase($order = "menu_order", $category = "", $activeurl = "new", $style = "normal", $interface = "grid", $tooltip = "false", $description = "false", $limit = - 1, $slidersettings="", $imgwo=0, $ids="0", $filter="false", $custom_class='')
{



	global $lshowcase_slider_count;
	global $post;

	add_action('wp_footer', 'lshowcase_custom_css',99);

	//will be used to include carousel code before tooltip code.
	$carousel = false;

	//image size override
	$imgwidth = "";
	if($imgwo!="" && $imgwo!=0 && $imgwo!='0'){
		$imgwidth = explode(',',$imgwo);
		}


	$html = "";

	if($custom_class!='') {
		$html = '<div class="'.$custom_class.'">';
	}

	//if there's a filter active:
	if($filter!='false' && $interface != 'hcarousel') {
		$html .= lshowcase_build_filter($filter, $category);
	}
	


	
	$thumbsize = "lshowcase-thumb";
	$class = "lshowcase-thumb";
	$divwrap = "lshowcase-wrap-normal";
	$divwrapextra = "";
	$divboxclass = "lshowcase-box-normal";
	$divboxinnerclass = "lshowcase-boxInner-normal";
	if ($order == 'none' ) {
		$order = 'menu_order';
	};
	if ($interface != "grid" && $interface != "hcarousel" && $interface != "vcarousel" ) {
		$columncount = substr($interface, 4);
		$divboxclass = "lshowcase-wrap-responsive";
		$divboxinnerclass = "lshowcase-boxInner";
		$divwrap = "lshowcase-box-" . $columncount;
	}

	if ($interface == "hcarousel" ) {

		$options = get_option( 'lshowcase-settings' );
		$mode = isset($options['lshowcase_carousel_mode']) ? $options['lshowcase_carousel_mode'] : 'horizontal';


		$divwrapextra = "style='display:none;' class='lshowcase-wrap-carousel-".$lshowcase_slider_count."'";
		$class = "lshowcase-thumb";
		$divwrap = "lshowcase-wrap-normal";
		$divboxclass = "lshowcase-box-normal";
		$divboxinnerclass = "lshowcase-slide";
		$carousel = true;
		lshowcase_add_carousel_js();

		//if mode is horizontal we add extra call to control better css

		if($mode == 'horizontal') {

			$divboxinnerclass = "lshowcase-slide lshowcase-horizontal-slide";

		}

	}

	$stylearray = lshowcase_styles_array();
	$class = $stylearray[$style]["class"];

	if($style == 'jgrayscale') {

		lshowcase_add_grayscale_js();

	}

	//tooltip code
	if ($tooltip == 'true' || $tooltip == 'true-description' ) {
		$class.= " lshowcase-tooltip";

		lshowcase_add_tooltip_js($carousel);
	}

	$postsperpage = - 1;
	$nopaging = true;
	if ($limit >= 1) {
		$postsperpage = $limit;
		$nopaging = false;
	}

	$ascdesc = 'DESC';
	if ($order == 'name' || $order == 'title' || $order == 'menu_order' ) {
		$ascdesc = 'ASC';
	};
	$args = array(
		'post_type' => 'lshowcase',
		'lshowcase-categories' => $category,
		'orderby' => $order,
		'order' => $ascdesc,
		'posts_per_page' => $postsperpage,
		'nopaging' => $nopaging,
		'suppress_filters' => true
	);

	if($ids != '0' && $ids != '') {
		$postarray = explode(',', $ids);

	 	if($postarray[0]!='') {
		$args['post__in'] = $postarray;
		}
	} 


	$loop = new WP_Query($args);

	// to force random again - uncomment in case random is not working
	// if($order=='rand' ) {
	// shuffle( $loop->posts );
	// }

	if(!$loop->have_posts()) {

			return "<!-- Empty Logos Showcase Container -->";

		}


	$html.= '<div class="lshowcase-clear-both">&nbsp;</div>';
	$html.= '<div class="lshowcase-logos"><div ' . $divwrapextra . ' >';

	$lshowcase_options = get_option( 'lshowcase-settings' );

	while ($loop->have_posts()):
		
		$loop->the_post();

		//asign custom image url to a variable, to use later
		$custom_img_url = get_post_meta(get_the_ID() , '_lscustomimageurl', true);

		if (has_post_thumbnail() || $lshowcase_options['lshowcase_default_image'] != '' || $custom_img_url != ''):
		// if (1==1):

			//check if there is img overide settings
			if(is_array($imgwidth)) {
				$thumbsize = $imgwidth;
				
			}

			$width = '';
			$height = '';


			$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID) , $thumbsize);
			
			
			$dwidth = $lshowcase_options['lshowcase_thumb_width'];
			$desc = get_post_meta(get_the_ID() , 'urldesc', true);

			if($image != false) {
				$width = $image[1];
				$height = " height = '".$image[2]."' ";
			}

		

			if($image == false && $custom_img_url != '') {
				$image = array();
				$image[0] = $custom_img_url; //url to image
				$image[1] = $lshowcase_options['lshowcase_thumb_width']; //image width
				$image[2] = $lshowcase_options['lshowcase_thumb_height']; //image height

				$width = $image[1];
				$height = "";

			}


			if($image == false && $custom_img_url == '' && $lshowcase_options['lshowcase_default_image'] != '') {
				$image = array();
				$image[0] = $lshowcase_options['lshowcase_default_image']; //url to image
				$image[1] = $lshowcase_options['lshowcase_thumb_width']; //image width
				$image[2] = $lshowcase_options['lshowcase_thumb_height']; //image height

				$width = $image[1];
				$height = "";

			}


			//to filter the quotes and make them html compatible
			$desc = str_replace("'", '&apos;', $desc);

			if(is_array($imgwidth)) {
				$dwidth = $thumbsize[0];
			}

			//if it's an SVG
			$file_info = pathinfo($image[0]);
			if(isset($file_info['extension']) && $file_info['extension'] == 'svg') {
				$width = $lshowcase_options['lshowcase_thumb_width'];
				$height = " height = '".$lshowcase_options['lshowcase_thumb_height']."' ";

				if(is_array($imgwidth)) {
				$width = $thumbsize[0];
				$height = " height = '".$thumbsize[1]."' ";
				}
			}

			//get categories to add as classes
			$cat = $filter!='false' ? ' lshowcase-filter-active ' : ' ';

		    $terms = get_the_terms( get_the_ID() , 'lshowcase-categories' );
		      if(is_array($terms)) {
		        foreach ( $terms as $term ) {
		        $cat .= 'ls-'.$term->slug.' ';
		        }
		      } 

			if ($interface != "hcarousel" ) {
				$html.= "<div class='" . $divwrap . $cat . "'>";
				$html.= '<div class="' . $divboxclass . '">';
				//$height = "";
			}

			if ($interface == "grid" ) {
				$html.= '<div class="' . $divboxinnerclass . '" style="width:' . $dwidth . 'px; align:center; text-align:center;">';
			}
			else {
				$html.= '<div class="' . $divboxinnerclass . '">';
			}

			$url = get_post_meta(get_the_ID() , 'urllink', true);

			//set default attributes for tooltip 
			if ($tooltip=="true") {
				$alt = $desc;
				$title = the_title_attribute( 'echo=0' );
			}

			//switch attributes to reflect on toolip
			if($tooltip=="true-description") {
				$title = $desc;
				$alt = the_title_attribute( 'echo=0' );
			}

			//if tooltip is off
			if($tooltip=="false") {
				$title = '';
				$alt = the_title_attribute( 'echo=0' );
			}		


			//try out flex div
			//$html .= '<div class="lshowcase-flexdiv">';

			//to display info above (not in shortcode generator)
			if ($description=="true-above" || $description=="true-description-above" || $description=="true-title-above-description-below") {
				$lsdesc = the_title_attribute( 'echo=0' );
				if($description=="true-description-above") { $lsdesc = $desc; }
				$html .= "<div class='lshowcase-description'>".nl2br($lsdesc)."</div>";
			}
			

			//inline styles form custom spacing options
			$inlinestyle = '';
				//image spacing values
				$percentage = get_post_meta(get_the_ID() , '_lspercentage', true);
				if($percentage!='') {
					$inlinestyle .= 'height:auto; max-width:'.$percentage.'%;';
				}
				$ptop = (get_post_meta(get_the_ID() , '_lsptop', true)!='') ? 'padding-top:'.get_post_meta(get_the_ID() , '_lsptop', true).';' : '';
				$pright = (get_post_meta(get_the_ID() , '_lspright', true)!='') ? 'padding-right:'.get_post_meta(get_the_ID() , '_lspright', true).';' : '';
				$pbottom = (get_post_meta(get_the_ID() , '_lspbottom', true)!='') ? 'padding-bottom:'.get_post_meta(get_the_ID() , '_lspbottom', true).';' : '';
				$pleft = (get_post_meta(get_the_ID() , '_lspleft', true)!='') ? 'padding-left:'.get_post_meta(get_the_ID() , '_lspleft', true).';' : '';
				$mtop = (get_post_meta(get_the_ID() , '_lsmtop', true)!='') ? 'margin-top:'.get_post_meta(get_the_ID(), '_lsmtop', true).';' : '';
				$mright = (get_post_meta(get_the_ID() , '_lsmright', true)!='') ? 'margin-right:'.get_post_meta(get_the_ID() , '_lsmright', true).';' : '';
				$mbottom = (get_post_meta(get_the_ID() , '_lsmbottom', true)!='') ? 'margin-bottom:'.get_post_meta(get_the_ID() , '_lsmbottom', true) .';': '';
				$mleft = (get_post_meta(get_the_ID() , '_lsmleft', true)!='') ? 'margin-left:'.get_post_meta(get_the_ID() , '_lsmleft', true).';' : '';

				$inlinestyle .= $ptop.$pright.$pbottom.$pleft.$mtop.$mright.$mbottom.$mleft;



			$instyle = ($inlinestyle!='') ? "style='".$inlinestyle."'" : '';


			if ($activeurl != "inactive" && $url != "" ) {



				$target = "";
				if ($activeurl == "new" ) {
					$target = "target='_blank'";
				}

				if ($activeurl == "new_nofollow" ) {
					$target = "target='_blank' rel='nofollow'";
				}

				//to make some nofollow
				//include #nofollow in the end of the link
				/*
				if (strpos($url,'#nofollow') !== false) {
				   $target = "target='_blank' rel='nofollow'";
				    $url = str_replace('#nofollow', '', $url);
				}
				*/


				


				$html.= "<a href='" . $url . "' " . $target . ">";
				$html.= "<img src='" . $image[0] . "' width='" . $width . "' ".$height." alt='" . $alt . "' title='" . $title . "' class='" . $class . "' ".$instyle." />";

				// $html .= get_the_post_thumbnail($post->ID,$thumbsize,array( 'class' => $class, 'alt'	=> $alt, 'title' => $title));

				$html.= "</a>";
			}
			else {

				$html.= "<img src='" . $image[0] . "' width='" . $width . "' ".$height." alt='" . $alt . "' title='" . $title . "' class='" . $class . "' ".$instyle." />";

				// $html .= get_the_post_thumbnail($post->ID,$thumbsize,array( 'class' => $class, 'alt'	=> $alt, 'title' => $title));

			}


			//to display info below
			if ($description=="true" || $description=="true-description" || $description=="true-title-above-description-below") {
				$lsdesc = the_title_attribute( 'echo=0' );
				if($description=="true-description" || $description=="true-title-above-description-below") { $lsdesc = $desc; }

				//to make it clickable
				if ($activeurl != "inactive" && $url != "" ) {
					//$lsdesc = "<a href='" . $url . "' " . $target . ">".$lsdesc."</a>";
				}

				$html .= "<div class='lshowcase-description'>".nl2br($lsdesc)."</div>";
			}

			//close flex div (contains image and eventually the description)
			//$html .= '</div>';
			

			if ($interface != "hcarousel" ) {
				$html.= "</div></div>";

			}

			$html.= "</div>";

			


		endif;
	endwhile;

	// Restore original Post Data

	wp_reset_postdata();
	$html.= '</div></div><div class="lshowcase-clear-both">&nbsp;</div>';

	//Add Carousel Code 
	if ( $interface == 'hcarousel') {

				lshowcase_bxslider_options_js($lshowcase_slider_count,$slidersettings,$dwidth);
				$lshowcase_slider_count++;
			
			}


	lshowcase_add_main_css();

	/* Display category used before logos grid */

	/* if($category!='') {

		$cat = get_term_by('slug', $category, 'lshowcase-categories');

		if(is_object($cat)) {

			$catname = $cat->name;
			$html = '<h2>'.$catname.'</h2>'.$html;
		
		}

	}

	*/

	if($custom_class!='') {
		$html .= '</div>';
	}

	return $html;
}

/* CSS enqueue functions */

function lshowcase_add_main_css()
{
	wp_deregister_style( 'lshowcase-main-style' );
	wp_register_style( 'lshowcase-main-style', plugins_url( '/styles.css', __FILE__) , array() , false, 'all');
	wp_enqueue_style( 'lshowcase-main-style' );
}

/* JS for grayscale with jQuery - not implemented */
function lshowcase_add_grayscale_js() {

	wp_deregister_script( 'lshowcase-jgrayscale' );
	wp_register_script( 'lshowcase-jgrayscale', plugins_url( '/js/grayscale.js', __FILE__) , array(
		'jquery'
	) , false, false);
	wp_enqueue_script( 'lshowcase-jgrayscale' );
}

add_action( 'admin_print_scripts-post-new.php', 'lshowcase_admin_styles', 11 );
add_action( 'admin_print_scripts-post.php', 'lshowcase_admin_styles', 11 ); 
function lshowcase_admin_styles() {
    global $post_type;
    if( 'lshowcase' == $post_type ) {
    	wp_deregister_style( 'lshowcase-admin-style' );
		wp_register_style( 'lshowcase-admin-style', plugins_url( 'css/admin.css', __FILE__) , array() , false, 'all');
		wp_enqueue_style( 'lshowcase-admin-style' );
    }
}

/*   JS for Slider */

function lshowcase_add_carousel_js()
{

	// wp_enqueue_script( 'jquery' );

	wp_deregister_script( 'lshowcase-bxslider' );
	wp_register_script( 'lshowcase-bxslider', plugins_url( '/bxslider/jquery.bxslider.min.js', __FILE__) , array(
		'jquery'
	) , false, true);
	wp_enqueue_script( 'lshowcase-bxslider' );
	wp_deregister_style( 'lshowcase-bxslider-style' );
	wp_register_style( 'lshowcase-bxslider-style', plugins_url( '/bxslider/jquery.bxslider.css', __FILE__) , array() , false, 'all');
	wp_enqueue_style( 'lshowcase-bxslider-style' );
	
}

function lshowcase_add_individual_carousel_js($sliderarray)
{

	

	wp_deregister_script( 'lshowcase-bxslider-individual' );
	wp_register_script( 'lshowcase-bxslider-individual', plugins_url( '/js/carousel.js', __FILE__) , array(
		'jquery',
		'lshowcase-bxslider'
	) , false, true);
	wp_enqueue_script( 'lshowcase-bxslider-individual' );

	wp_localize_script('lshowcase-bxslider-individual', 'lssliderparam', $sliderarray);
	
	
}

/* Tooltip Scripts */

function lshowcase_add_tooltip_js($slidertrue)
{

	//$array = array('jquery','jquery-ui-core');
	$array = array('ls-jquery-ui');

	if($slidertrue) {
		//$array = array('jquery','jquery-ui-core','lshowcase-bxslider-individual');
		$array = array('ls-jquery-ui','lshowcase-bxslider-individual');
	}

	wp_deregister_script( 'ls-jquery-ui' );
	wp_register_script( 'ls-jquery-ui', plugins_url( '/js/jquery-ui.min.js', __FILE__) , array(
		'jquery'
	) , false, false);
	wp_enqueue_script( 'ls-jquery-ui' );
	

	wp_deregister_script( 'lshowcase-tooltip' );
	wp_register_script( 'lshowcase-tooltip', plugins_url( '/js/tooltip.js', __FILE__) , $array , false, false);
	wp_enqueue_script( 'lshowcase-tooltip' );
}

/* Styles Function */
/* YOU CAN ADD NEW STYLES.
ADD ITEMS TO ARRAY
*/

function lshowcase_styles_array()
{
	$styles = array(
		"normal" => array(
			"class" => "lshowcase-normal",
			"description" => "Normal - No Styles",
		) ,
		"boxhighlight" => array(
			"class" => "lshowcase-boxhighlight",
			"description" => "Box Highlight on hover",
		) ,
		"grayscale" => array(
			"class" => "lshowcase-grayscale",
			"description" => "Always Grayscale",
		) ,
		"hgrayscale" => array(
			"class" => "lshowcase-hover-grayscale",
			"description" => "Grayscale and Color on hover",
		),
		"hgrayscale2" => array(
			"class" => "lshowcase-grayscale-2",
			"description" => "Grayscale and Color on hover II",
		),
		
		/*
		"jgrayscale" => array(
			"class" => "lshowcase-jquery-gray",
			"description" => "Grayscale Hover (Javascript - Beta)",
		),
		*/
		
		"opacity-enhance" => array(
			"class" => "lshowcase-opacity-enhance",
			"description" => "Full Opacity on Hover",
		),
		"lower-opacity" => array(
			"class" => "lshowcase-lower-opacity",
			"description" => "Lower Opacity on Hover",
		)
	);
	return $styles;
}


function lshowcase_bxslider_options_js($id, $slidersettings,$slidewidth)
{
	global $lshowcase_jquery_noconflict;
	global $lshowcase_slider_array;

	$mode = "'horizontal'";
	$options = get_option( 'lshowcase-settings' );
	if ($slidewidth=="" || $slidewidth == 0 || $slidewidth == '0') {
		$slidewidth = $options['lshowcase_thumb_width'];
	}
	
	$name = '.lshowcase-wrap-carousel-'.$id;

	if( $slidersettings == "" ) {
		
		$autoscroll = $options['lshowcase_carousel_autoscroll'];
		$pausetime = $options['lshowcase_carousel_pause'];
		$autohover = $options['lshowcase_carousel_autohover'];
		$pager = $options['lshowcase_carousel_pager'];
		$tickerhover = $autohover;
		$ticker = 'false';
		$usecss = 'true';
		$auto = 'true';

		if ($autoscroll == 'false') {
			$auto = 'false';
		}

		if ($autoscroll=='ticker') {
			$ticker = 'true';
			$tickerhover = $autohover;
			$autoscroll = 'true';
			$pager = 'false';
			$auto = 'false';
			
			if ($tickerhover=='true') {
				$usecss = 'false';
			} 
		}

		$autocontrols = $options['lshowcase_carousel_autocontrols'];
		$speed = $options['lshowcase_carousel_speed'];
		$slidemargin = $options['lshowcase_carousel_slideMargin'];
		$loop = $options['lshowcase_carousel_infiniteLoop'];
		$controls = $options['lshowcase_carousel_controls'];
		$minslides = $options['lshowcase_carousel_minSlides'];
		$maxslides = $options['lshowcase_carousel_maxSlides'];
		$moveslides = $options['lshowcase_carousel_moveSlides'];		

		$mode = isset($options['lshowcase_carousel_mode']) ? $options['lshowcase_carousel_mode'] : 'horizontal';

		

	} else {

		$carouselset = explode(',', $slidersettings);		
		$autoscroll = $carouselset[0];
		$pausetime = $carouselset[1];
		$autohover = $carouselset[2];
		$pager = $carouselset[7];
		$tickerhover = $autohover;
		$ticker = 'false';
		$usecss = 'true';
		$auto = 'true';



		if ($autoscroll == 'false') {
			$auto = 'false';
		}

		if ($autoscroll=='ticker') {
			$ticker = 'true';
			$tickerhover = $autohover;
			$autoscroll = 'true';
			$pager = 'false';
			$auto = 'false';

			if ($autohover=='true') {
				$usecss = 'false';
			} 
		}

		$autocontrols = $carouselset[3];
		$speed = $carouselset[4];
		$slidemargin = $carouselset[5];
		$loop = $carouselset[6];
		
		$controls = $carouselset[8];
		$minslides = $carouselset[9];
		$maxslides = $carouselset[10];
		$moveslides = $carouselset[11];	

		$mode = isset($options['lshowcase_carousel_mode']) ? $options['lshowcase_carousel_mode'] : 'horizontal';
		
	}

$new_ls_array = array('divid' => '.lshowcase-wrap-carousel-'.$id,
						'auto' => $auto,
						'pause' => $pausetime,
						'autohover' => $autohover,
						'ticker' => $ticker,
						'tickerhover' => $tickerhover,
						'useCSS' => $usecss,
						'autocontrols' => $autocontrols,
						'speed' => $speed,
						'slidewidth' => $slidewidth,
						'slidemargin' => $slidemargin,
						'infiniteloop' => $loop,
						'pager' => $pager,
						'controls' => $controls,
						'minslides' => $minslides,
						'maxslides' => $maxslides,
						'moveslides' => $moveslides,
						'mode' => $mode //options: 'horizontal', 'vertical', 'fade'
						);

array_push($lshowcase_slider_array, $new_ls_array);
	
lshowcase_add_individual_carousel_js($lshowcase_slider_array);

}

//Custom CSS

function lshowcase_custom_css () {
	$options = get_option( 'lshowcase-settings' );
	$css = $options['lshowcase_css'];
	if($css!=''){
		echo '
		<!-- Custom Styles for Logos Showcase -->
		<style type="text/css">
		'.$css.'
		</style>';
	}

	$js = $options['lshowcase_js'];
	if($js!=''){
		echo "
		<!-- Custom Javascript for Logos Showcase -->
		<script type='text/javascript'>
		".$js."
		</script>";
	}

}




//New Icons
$lshowcase_wp_version =  floatval( get_bloginfo( 'version' ) );

if($lshowcase_wp_version >= 3.8) {
	add_action( 'admin_head', 'lshowcase_font_icon' );
}


function lshowcase_font_icon() {
?>

		<style> 
			#adminmenu #menu-posts-lshowcase div.wp-menu-image img { display: none;}
			#adminmenu #menu-posts-lshowcase div.wp-menu-image:before { content: "\f180"; }
		</style>


<?php
}


//shortcode to display filter
add_shortcode( 'show-logos-filter', 'shortcode_lshowcase_filter' );

function shortcode_lshowcase_filter($atts) {

	$categories = (array_key_exists( 'category', $atts) ? $atts['category'] : "0" );
	$filter = (array_key_exists( 'filter', $atts) ? $atts['filter'] : "false" );

	$html = lshowcase_build_filter($filter, $categories);
	return $html;

}

//Function to display Filter
function lshowcase_build_filter($display = 'hide', $category = "") {


	$html = '';
	
	
	if ('enhance' == $display) {
	lshowcase_enhance_filter_code();
	$html .= "<ul id='ls-enhance-filter-nav'>";
	}

	if ('hide' == $display) {
	lshowcase_filter_code();
	$html .= "<ul id='ls-filter-nav'>";
	}
			
	
	$html .= "<li id='ls-all'>".__('All','lshowcase')."</li>";

	$includecat = array();

	if($category != "" && $category!="0") { 

		 $cats = explode(',',$category);
		 
		 foreach ($cats as $cat) {
		 
		 	$term = get_term_by('slug', $cat, 'lshowcase-categories');
		 	array_push($includecat,$term->term_id);

		 }

		 $args = array(
		 	'include' => $includecat
		 	);

	}

	$args['orderby'] = 'slug';
	$args['order'] = 'ASC';
	$args['parent'] = 0;
	
	$terms = get_terms("lshowcase-categories",$args);

	 $count = count($terms);
	 if ( $count > 0 ){		 
			 foreach ( $terms as $term ) {


			 	//We check for children
			 	$childs = '';

			 	$children_args = array(
				    'orderby'	=> 'slug', 
				    'order'	=> 'ASC',
				    'child_of'	=> $term->term_id); 

			 	$children = get_terms("lshowcase-categories",$children_args);
			 	$children_count = count($children);

			 	if($children_count) {

			 		$childs .= '<ul>';
			 		foreach ( $children as $cterm ) {
			 			$childs .= "<li id='ls-".$cterm->slug."'>".$cterm->name."</li>";
			 		}

			 		$childs .= '</ul>';

			 	}

			$html .= "<li id='ls-".$term->slug."'>".$term->name.$childs."</li>";
			
			}		 
	 }
	$html .= "</ul>";
	

return $html;

}

/* JS For Filter */ 
function lshowcase_filter_code() {
	
	wp_deregister_script( 'lshowcase-filter' );
	wp_register_script( 'lshowcase-filter', plugins_url( '/js/filter.js', __FILE__ ),array('jquery','jquery-ui-core','jquery-effects-core'),false,false);
	wp_enqueue_script( 'lshowcase-filter' );
			
}

function lshowcase_enhance_filter_code() {
	
	wp_deregister_script( 'lshowcase-enhance-filter' );
	wp_register_script( 'lshowcase-enhance-filter', plugins_url( '/js/filter-enhance.js', __FILE__ ),array('jquery','jquery-effects-core'),false,false);
	wp_enqueue_script( 'lshowcase-enhance-filter' );
			
}


/* Quick Edit */

add_action( 'quick_edit_custom_box', 'lshowcase_display_custom_quickedit', 10, 2 );

function lshowcase_display_custom_quickedit( $column_name, $post_type ) {
    static $printNonce = TRUE;
    if ( $printNonce ) {
        $printNonce = FALSE;
        wp_nonce_field( plugin_basename( __FILE__ ), 'lshowcase_edit_nonce' );
    }

    ?>
    <fieldset class="inline-edit-col-right inline-edit-book">
      <div class="inline-edit-col column-<?php echo $column_name; ?>">
        <label class="inline-edit-group">
        <?php 
         switch ( $column_name ) {
         case 'urldesc':
             ?><span class="title">Description</span><input name="urldesc" /><?php
             break;
         case 'urllink':
             ?><span class="title">URL</span><input name="urllink" /><?php
             break;
         }
        ?>
        </label>
      </div>
    </fieldset>
    <?php
}


add_action( 'save_post', 'lshowcase_save_meta' );

function lshowcase_save_meta( $post_id ) {
    
    $slug = 'lshowcase';
    if ( isset($_POST['post_type']) && $slug !== $_POST['post_type'] ) {
        return;
    }
    if ( !current_user_can( 'edit_post', $post_id ) ) {
        return;
    }
    $_POST += array("{$slug}_edit_nonce" => '');
    if ( !wp_verify_nonce( $_POST["{$slug}_edit_nonce"],
                           plugin_basename( __FILE__ ) ) )
    {
        return;
    }

    if ( isset( $_REQUEST['urldesc'] ) ) {
        update_post_meta( $post_id, 'urldesc', $_REQUEST['urldesc'] );
    }
   if ( isset( $_REQUEST['urllink'] ) ) {
        update_post_meta( $post_id, 'urllink', $_REQUEST['urllink'] );
    }
}

/* load script in the footer */
if ( ! function_exists('lshowcase_admin_enqueue_scripts') ):
function lshowcase_admin_enqueue_scripts( $hook ) {

	if ( 'edit.php' === $hook &&
		isset( $_GET['post_type'] ) &&
		'lshowcase' === $_GET['post_type'] ) {

		wp_enqueue_script( 'my_custom_script', plugins_url('js/admin_edit.js', __FILE__),
			false, null, true );

	}

}
endif;
add_action( 'admin_enqueue_scripts', 'lshowcase_admin_enqueue_scripts' );





// VISUAL COMPOSER CLASS

class lshowcase_VCExtendAddonClass {
    function __construct() {
        // We safely integrate with VC with this hook
        add_action( 'init', array( $this, 'integrateWithVC' ) );

    }
 
    public function integrateWithVC() {
        // Check if Visual Composer is installed
        if ( !defined('WPB_VC_VERSION') || !function_exists('vc_map')) {
            // Display notice that Visual Compser is required
            // add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }
 		


		if(function_exists('vc_map')) {

			$options = get_option( 'lshowcase-settings' );
			$name = $options['lshowcase_name_singular'];
			$nameplural = $options['lshowcase_name_plural'];


			$terms = get_terms( "lshowcase-categories" );
			$count = count($terms);
			$categories = array();
			$categories['All'] = '0';
			if ($count > 0) {
				foreach($terms as $term) {
					$categories[$term->name] =  $term->slug;
				}
			}

			$styles = array();
			$stylesarray = lshowcase_styles_array();
			foreach($stylesarray as $option => $key) {
				$styles[$key['description']] = $option; 
			}
     


			vc_map( array(
            "name" => $nameplural,
            "description" => __("Insert ".$nameplural." grid or carousel", 'lshowcase'),
            "base" => "show-logos",
            "class" => "",
            //"front_enqueue_css" => plugins_url('includes/visual_composer.css', __FILE__),
            "front_enqueue_js" => plugins_url('includes/visual_composer.js', __FILE__),
            "icon" => plugins_url('images/icon64.png', __FILE__),
            "category" => __('Content', 'js_composer'),
            "params" => array(
                array(
                  "admin_label" => true,
                  "type" => "dropdown",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Order by", 'lshowcase'),
                  "param_name" => "orderby",
                  "value" => array(
                  	'Default' => 'none',
                  	'ID' => 'id',
                  	'Title' => 'title',
                  	'Date' => 'date',
                  	'Modified' => 'modified',
                  	'Random' => 'rand'
                  	),
                  "description" => __("Display entries ordered by", 'lshowcase')
              ),
                array(
                  "admin_label" => true,
                  "type" => "dropdown",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Category", 'lshowcase'),
                  "param_name" => "category",
                  "value" => $categories,
                  "description" => __("Category to display", 'lshowcase')
              ),

                 array(
                  "admin_label" => true,
                  "type" => "textfield",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Limit", 'lshowcase'),
                  "param_name" => "limit",
                  "value" => '0',
                  "description" => __("How many entries to display. Leave blank or '0' to display all", 'lshowcase')
              ),

                array(
                  "admin_label" => true,
                  "type" => "dropdown",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("URL", 'lshowcase'),
                  "param_name" => "activeurl",
                  "value" => array(
                  	'Open in same window' => 'same',
                  	'Inactive' => 'inactive',
                  	'Open in new window' => 'new',
                  	'Open in new window (nofollow)' => 'new_nofollow'
                  	),
                  "description" => __("Image URL Settings", 'lshowcase')
              ),
                array(
                  "admin_label" => true,
                  "type" => "dropdown",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Style", 'lshowcase'),
                  "param_name" => "style",
                  "value" => $styles,
                  "description" => __("Image effect to apply", 'lshowcase')
              ),

                array(
                  "admin_label" => true,
                  "type" => "dropdown",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Layout", 'lshowcase'),
                  "param_name" => "interface",
                  "value" => array(
                  	'Normal Grid' => 'grid',
                  	'Horizontal Carousel' => 'hcarousel',
                  	'Responsive Grid - 12 Columns' => 'grid12',
                  	'Responsive Grid - 11 Columns' => 'grid11',
                  	'Responsive Grid - 10 Columns' => 'grid10',
                  	'Responsive Grid - 9 Columns' => 'grid9',
                  	'Responsive Grid - 8 Columns' => 'grid8',
                  	'Responsive Grid - 7 Columns' => 'grid7',
                  	'Responsive Grid - 6 Columns' => 'grid6',
                  	'Responsive Grid - 5 Columns' => 'grid5',
                  	'Responsive Grid - 4 Columns' => 'grid4',
                  	'Responsive Grid - 3 Columns' => 'grid3',
                  	'Responsive Grid - 2 Columns' => 'grid2',
                  	'Responsive Grid - 1 Columns' => 'grid1',
                  	),
                  "description" => __("In what form do you want the images to display", 'lshowcase')
              ),

                array(
                  "admin_label" => true,
                  "type" => "dropdown",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Show Tooltip", 'lshowcase'),
                  "param_name" => "tooltip",
                  "value" => array(
                  	'No' => 'false',
                  	'Show Title' => 'true',
                  	'Show Description' => 'true-description'
                  	),
                  "description" => __("Display tooltip information on hover", 'lshowcase')
              ),

                array(
                  "admin_label" => true,
                  "type" => "dropdown",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Show Info", 'lshowcase'),
                  "param_name" => "description",
                  "value" => array(
                  	'No' => 'false',
                  	'Title Below' => 'true',
                  	'Description Below' => 'true-description',
                  	'Title Above' => 'true-above',
                  	'Description Above' => 'true-description-above',
                  	'Title Above & Description Below' => 'true-title-above-description-below'
                  	),
                  "description" => __("Display information above or below image", 'lshowcase')
              ),

                array(
                  "admin_label" => true,
                  "type" => "dropdown",
                  "holder" => "hidden",
                  "class" => "",
                  "heading" => __("Show Filter", 'lshowcase'),
                  "param_name" => "filter",
                  "value" => array(
                  	'No' => 'false',
                  	'Hide Filter' => 'hide',
                  	'Enhance Filter' => 'enhance'
                  	),
                  "description" => __("Display live filter menu above grid", 'lshowcase')
              ),


            ),
           
        	));

		}

        
    }
}
// Finally initialize code
new lshowcase_VCExtendAddonClass();




//Fix to load files on all pages
/*
add_action( 'init', 'lshowcase_load_all_pages' );
function lshowcase_load_all_pages() {
	lshowcase_add_tooltip_js(false);
	lshowcase_add_main_css();
}
*/

?>