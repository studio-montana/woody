<?php
/**
 Theme Name: Woody
 Theme URI: http://lab.studio-montana.com/woody-theme/
 Author: Studio Montana (Sebastien Chandonay / Cyril Tissot)
 Author URI: http://www.studio-montana.com
 License: GNU General Public License v2 or later
 License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License, version 2, as
 published by the Free Software Foundation.
 
 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.
 
 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

/**
 * Constantes
 */
define ( 'WOODY_THEME_NAME', 'woody' );
define ( 'WOODY_THEME_FILE', __FILE__ );
define ( 'WOODY_THEME_PATH', get_template_directory () );
define ( 'WOODY_THEME_URI', get_template_directory_uri () );

define ( 'WOODY_CSS_FOLDER', 'css/' );
define ( 'WOODY_JS_FOLDER', 'js/' );
define ( 'WOODY_LANG_FOLDER', 'lang/' );
define ( 'WOODY_INC_FOLDER', 'inc/' );

/**
 * Woody setup.
 *
 * @return void
 *
 */
function woody_setup() {
	
	/*
	 * Widgets
	 */
	include (get_template_directory () . '/inc/widgets/widget-image.class.php');
	
	/*
	 * Customizer
	 */
	include (get_template_directory () . '/inc/customizer.php');
	
	/*
	 * Makes Woody available for translation.
	 */
	load_theme_textdomain ( 'woody', WOODY_THEME_PATH . '/' . WOODY_LANG_FOLDER );
	
	/*
	 * Adds RSS feed links to <head> for posts and comments.
	 */
	add_theme_support ( 'automatic-feed-links' );
	
	/*
	 * Switches default core markup for search form, comment form, and comments to output valid HTML5.
	 */
	add_theme_support ( 'html5', array (
			'search-form',
			'comment-form',
			'comment-list' 
	) );
	
	/*
	 * This theme supports all available post formats by default. See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support ( 'post-formats', array () );
	
	/*
	 * This theme supports title tag
	 */
	add_theme_support ( 'title-tag' );
	
	/*
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menu ( 'primary', __ ( 'Main menu', 'woody' ) );
	register_nav_menu ( 'footer', __ ( 'Footer menu', 'woody' ) );
	
	/*
	 * This theme uses a custom image size for featured images, displayed on "standard" posts and pages.
	 */
	add_theme_support ( 'post-thumbnails' );
	set_post_thumbnail_size ( 1200, 400, true );
	add_image_size ( 'woody-small', 200 );
	add_image_size ( 'woody-medium', 600 );
	add_image_size ( 'woody-large', 900 );
	add_image_size ( 'woody-xlarge', 1200 );
	add_image_size ( 'woody-xxlarge', 1600 );
	add_image_size ( 'woody-landscape-small', 200, 105, true );
	add_image_size ( 'woody-landscape-medium', 600, 315, true );
	add_image_size ( 'woody-landscape-large', 900, 475, true );
	add_image_size ( 'woody-landscape-xlarge', 1200, 635, true );
	add_image_size ( 'woody-square-small', 200, 200, true );
	add_image_size ( 'woody-square-medium', 600, 600, true );
	add_image_size ( 'woody-square-large', 900, 900, true );
	add_image_size ( 'woody-square-xlarge', 1200, 1200, true );
	
	/*
	 * This theme supports logo
	 */
	add_theme_support ( 'custom-logo', array (
			'header-text' => array (
					'site-title',
					'site-description' 
			) 
	) );
	
	/*
	 * Woocommerce support
	 */
	add_theme_support ( 'woocommerce' );
}
add_action ( 'after_setup_theme', 'woody_setup' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 *        
 */
function woody_content_width() {
	$GLOBALS ['content_width'] = apply_filters ( 'woody_content_width', 1200 );
}
add_action ( 'after_setup_theme', 'woody_content_width', 0 );

/**
 * Enqueue scripts and styles for the front end.
 *
 * @return void
 *
 */
function woody_scripts_styles() {
	
	// get woody layout
	$woody_layout = woody_get_layout ();
	
	$depends_css = array ();
	
	// Action before woody enqueue scripts
	do_action ( "woody_front_enqueue_scripts_before" );
	
	$first_style_dependencies = array ();
	if (class_exists ( 'Woodkit' )) { // Woodkit plugin support
		$first_style_dependencies [] = 'woodkit-core-slider-style';
	}
	
	// Loads Functions JavaScript file
	wp_enqueue_script ( 'script-woody-functions', get_template_directory_uri () . '/js/functions.js', array (
			'jquery' 
	), '1.0', true );
	if (is_multisite ()) {
		$home_url = get_site_url ( BLOG_ID_CURRENT_SITE );
		$home_multisite_url = get_site_url ( get_current_blog_id () );
	} else {
		$home_url = home_url ( '/' );
		$home_multisite_url = "";
	}
	$id_blog_page = get_option ( 'page_for_posts' );
	if (! empty ( $id_blog_page ) && is_numeric ( $id_blog_page )) {
		$blog_url = get_permalink ( $id_blog_page );
	} else {
		$blog_url = "";
	}
	if (is_single () && get_post_type () == 'post') {
		$is_post = "1";
	} else {
		$is_post = "0";
	}
	$current_url = woody_get_current_url ();
	wp_localize_script ( 'script-woody-functions', 'Woody', array (
			'current_url' => $current_url,
			'home_url' => $home_url,
			'home_multisite_url' => $home_multisite_url,
			'blog_url' => $blog_url,
			'is_post' => $is_post 
	) );
	
	// Layout script
	if (! empty ( $woody_layout )) {
		wp_enqueue_script ( 'woody-layout-script', get_template_directory_uri () . '/layouts/' . $woody_layout . '/script.js', array (
				'script-woody-functions' 
		), '1.0', true );
	}
	
	// Knacss style
	if (file_exists ( get_template_directory () . '/css/knacss.css' )) {
		wp_enqueue_style ( 'woody-knacss-css', get_template_directory_uri () . '/css/knacss.css', $first_style_dependencies, '1.0' );
		$depends_css = array (
				'woody-knacss-css' 
		);
	}
	
	// Layout style
	if (! empty ( $woody_layout )) {
		wp_enqueue_style ( 'woody-layout-css', get_template_directory_uri () . '/layouts/' . $woody_layout . '/style.css', $depends_css, '1.0' );
		$depends_css = array (
				'woody-layout-css' 
		);
	}
	
	// Layout Internet Explorer specific stylesheet
	if (! empty ( $woody_layout )) {
		wp_enqueue_style ( 'woody-ie-css', get_template_directory_uri () . '/layouts/' . $woody_layout . '/ie.css', $depends_css, '1.0' );
		wp_style_add_data ( 'woody-ie-css', 'conditional', 'lt IE 9' );
		$depends_css = array (
				'woody-ie-css' 
		);
	}
	
	// Woody main style
	$main_style_version = apply_filters ( "woody_main_style_version", "1.0" );
	$depends_css = apply_filters ( "woody_main_style_dependencies", $depends_css );
	wp_enqueue_style ( 'woody-main-style', get_stylesheet_uri (), $depends_css, $main_style_version );
	
	// Action after woody enqueue scripts
	do_action ( "woody_front_enqueue_scripts_after" );
}
if (class_exists ( 'Woodkit' )) // Woodkit plugin support
	add_action ( 'woodkit_front_enqueue_scripts_after', 'woody_scripts_styles' );
else
	add_action ( 'wp_enqueue_scripts', 'woody_scripts_styles' );

/**
 * Enqueue scripts and styles for the back end.
 *
 * @return void
 *
 */
function woody_admin_scripts_styles() {
	
	// Action before woody enqueue scripts
	do_action ( "woody_admin_enqueue_scripts_before" );
	
	// Action after woody enqueue scripts
	do_action ( "woody_admin_enqueue_scripts_after" );
}
if (class_exists ( 'Woodkit' )) // Woodkit plugin support
	add_action ( 'woodkit_admin_enqueue_scripts_after', 'woody_admin_scripts_styles' );
else
	add_action ( 'admin_enqueue_scripts', 'woody_admin_scripts_styles' );

/**
 * admin init hook
 */
function woody_admin_init() {
	
	// get woody layout
	$woody_layout = woody_get_layout ();
	
	// Layout Admin Editor style
	if (! empty ( $woody_layout )) {
		add_editor_style ( 'layouts/' . $woody_layout . '/editor-style.css' );
	}
	
	add_editor_style (); // please create editor-style.css at root of your child theme
}
add_action ( 'admin_init', 'woody_admin_init' );

/**
 * Register widgets areas.
 *
 * @return void
 *
 */
function woody_widgets_init() {
	register_sidebar ( array (
			'name' => __ ( 'Sidebar', 'woody' ),
			'id' => 'sidebar',
			'description' => __ ( 'Shown in your site', 'woody' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s"><div class="widget-container">',
			'before_title' => '<h3 class="widget-title">',
			'after_title' => '</h3>',
			'after_widget' => '</div></aside>' 
	) );
}
add_action ( 'widgets_init', 'woody_widgets_init' );

if (! function_exists ( "woody_get_current_url" )) :
	/**
	 * get the current URL
	 */
	function woody_get_current_url($with_parameters = false) {
		if ($with_parameters) {
			$protocol = woody_get_protocol ();
			return $protocol . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
		} else {
			$uri_parts = explode ( '?', $_SERVER ['REQUEST_URI'] );
			$protocol = woody_get_protocol ();
			return $protocol . $_SERVER ['HTTP_HOST'] . $uri_parts [0];
		}
	}



endif;

if (! function_exists ( "woody_get_protocol" )) :
	/**
	 * get the current Protocol (http || https)
	 */
	function woody_get_protocol() {
		if (isset ( $_SERVER ['HTTPS'] ) && ($_SERVER ['HTTPS'] == 'on' || $_SERVER ['HTTPS'] == 1) || isset ( $_SERVER ['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER ['HTTP_X_FORWARDED_PROTO'] == 'https') {
			$protocol = 'https://';
		} else {
			$protocol = 'http://';
		}
		return $protocol;
	}



endif;

if (! function_exists ( 'woody_entry_meta' )) :
	/**
	 * Woodkit entry-meta
	 *
	 * @since Woodkit 1.0
	 * @return void
	 *
	 */
	function woody_entry_meta() {
		if (is_sticky () && is_home () && ! is_paged ())
			echo '<span class="featured-post">' . __ ( 'Sticky', 'woody' ) . '</span>';
		
		if (! has_post_format ( 'link' ) && 'post' == get_post_type ())
			woody_entry_date ();
			
			// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list ( __ ( ', ', 'woody' ) );
		if ($categories_list) {
			echo '<span class="categories-links">' . $categories_list . '</span>';
		}
		
		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list ( '', __ ( ', ', 'woody' ) );
		if ($tag_list) {
			echo '<span class="tags-links">' . $tag_list . '</span>';
		}
		
		// Translators: used between list items, there is a space after the comma.
		$taxes = get_the_taxonomies ( null, array (
				'template' => __ ( '<span class="label">%s : </span>%l' ) 
		) );
		foreach ( $taxes as $tax ) {
			echo '<span class="taxes-links">' . $tax . '</span>';
		}
		
		// Post author
		if ('post' == get_post_type ()) {
			printf ( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>', esc_url ( get_author_posts_url ( get_the_author_meta ( 'ID' ) ) ), esc_attr ( sprintf ( __ ( 'View all posts by %s', 'woody' ), get_the_author () ) ), get_the_author () );
		}
	}



endif;

if (! function_exists ( 'woody_entry_date' )) :
	/**
	 * Woodkit entry-date
	 *
	 * @since Woodkit 1.0
	 * @return void
	 *
	 */
	function woody_entry_date($echo = true) {
		if (has_post_format ( array (
				'chat',
				'status' 
		) ))
			$format_prefix = _x ( '%1$s on %2$s', '1: post format name. 2: date', 'woody' );
		else
			$format_prefix = '%2$s';
		
		$date = sprintf ( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>', esc_url ( get_permalink () ), esc_attr ( sprintf ( __ ( 'Permalink to %s', 'woody' ), the_title_attribute ( 'echo=0' ) ) ), esc_attr ( get_the_date ( 'c' ) ), esc_html ( sprintf ( $format_prefix, get_post_format_string ( get_post_format () ), get_the_date () ) ) );
		
		if ($echo)
			echo $date;
		
		return $date;
	}



endif;

if (! function_exists ( "woody_get_displayed_post_types" )) :
	/**
	 * Récupère les post_types (exceptés "attachment", "revision", "nav_menu_item")
	 *
	 * @param $sort :
	 *        	alphabetic sorting
	 * @return array:
	 *
	 */
	function woody_get_displayed_post_types($sort = false) {
		$displayed_post_types = array ();
		foreach ( get_post_types () as $post_type ) {
			if ($post_type != "attachment" && $post_type != "revision" && $post_type != "nav_menu_item") {
				$post_type_object = get_post_type_object ( $post_type );
				if ($post_type_object->public == 1) {
					$displayed_post_types [] = $post_type;
				}
			}
		}
		if ($sort == true)
			usort ( $displayed_post_types, "woody_cmp_posttypes" );
		return $displayed_post_types;
	}



endif;

if (! function_exists ( "woody_cmp_posttypes" )) :
	/**
	 * Comparator for post_types string
	 */
	function woody_cmp_posttypes($post_type_1, $post_type_2) {
		$current_post_type_label_1 = get_post_type_labels ( get_post_type_object ( $post_type_1 ) );
		$current_post_type_label_2 = get_post_type_labels ( get_post_type_object ( $post_type_2 ) );
		return strcmp ( $current_post_type_label_1->name, $current_post_type_label_2->name );
	}



endif;

/**
 * WooCommerce Supports (theme's supports - http://docs.woothemes.com/document/third-party-woodkit-theme-compatibility/)
 */
remove_action ( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action ( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action ( 'woocommerce_before_main_content', 'woody_woocommerce_wrapper_start', 10 );
add_action ( 'woocommerce_after_main_content', 'woody_woocommerce_wrapper_end', 10 );
function woody_woocommerce_wrapper_start() {
	echo '<section id="main">';
}
function woody_woocommerce_wrapper_end() {
	echo '</section>';
}

if (! function_exists ( "woody_get_layout" )) :
	/**
	 * Retrieve Woody Layout
	 */
	function woody_get_layout() {
		global $woody_layout;
		if (! isset ( $woody_layout ) || is_customize_preview ()) {
			$woody_layout = get_theme_mod ( 'woody_layout', '' );
		}
		if ($woody_layout == 'none') {
			$woody_layout = '';
		}
		return $woody_layout;
	}


endif;

/**
 * Display Content Title
 */
function woody_is_display_content_title() {
	return apply_filters ( "woody_is_display_content_title", true );
}

/**
 * Display Content Page Title
 */
function woody_is_display_content_page_title() {
	return apply_filters ( "woody_is_display_content_page_title", true );
}

/**
 * Display Content Page Blog Title
 */
function woody_is_display_content_page_blog_title() {
	return apply_filters ( "woody_is_display_content_page_blog_title", true );
}

/**
 * Display Content Resume Title
 */
function woody_is_display_content_resume_title() {
	return apply_filters ( "woody_is_display_content_resume_title", true );
}

/**
 * Display Content Thumbnail
 */
function woody_is_display_content_thumbnail() {
	return apply_filters ( "woody_is_display_content_thumbnail", true );
}

/**
 * Display Content Page Thumbnail
 */
function woody_is_display_content_page_thumbnail() {
	return apply_filters ( "woody_is_display_content_page_thumbnail", true );
}

/**
 * Display Content Page Blog Thumbnail
 */
function woody_is_display_content_page_blog_thumbnail() {
	return apply_filters ( "woody_is_display_content_page_blog_thumbnail", true );
}

/**
 * Display Content Resume Thumbnail
 */
function woody_is_display_content_resume_thumbnail() {
	return apply_filters ( "woody_is_display_content_resume_thumbnail", true );
}

/**
 * Display Content Meta
 */
function woody_is_display_content_meta() {
	return apply_filters ( "woody_is_display_content_meta", true );
}

/**
 * Display Content Page Meta
 */
function woody_is_display_content_page_meta() {
	return apply_filters ( "woody_is_display_content_page_meta", true );
}

/**
 * Display Content Page Blog Meta
 */
function woody_is_display_content_page_blog_meta() {
	return apply_filters ( "woody_is_display_content_page_blog_meta", true );
}

/**
 * Display Content Resume Meta
 */
function woody_is_display_content_resume_meta() {
	return apply_filters ( "woody_is_display_content_resume_meta", true );
}

/**
 * This must the last instruction of this file - loads layout functions file
 */
$woody_layout = woody_get_layout ();
if (! empty ( $woody_layout )) {
	require_once get_template_directory () . '/layouts/' . $woody_layout . '/functions.php';
}