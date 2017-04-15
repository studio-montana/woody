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

$woody_layout = woody_get_layout();
if (!empty($woody_layout) && file_exists(get_template_directory().'/layouts/'.$woody_layout.'/'.basename(__FILE__))){
	include get_template_directory().'/layouts/'.$woody_layout.'/'.basename(__FILE__);
}else{
	?><!DOCTYPE html>
	<!--[if IE 7]>
	<html class="ie ie7" <?php language_attributes(); ?>>
	<![endif]-->
	<!--[if IE 8]>
	<html class="ie ie8" <?php language_attributes(); ?>>
	<![endif]-->
	<!--[if !(IE 7) | !(IE 8)  ]><!-->
	<html <?php language_attributes(); ?>>
	<!--<![endif]-->
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
		<?php endif; ?>
		<!--[if lt IE 9]>
		<script src="<?php echo get_stylesheet_directory_uri(); ?>/js/html5.js"></script>
		<![endif]-->
		<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
		<?php wp_head(); ?>
	</head>
	
	<body <?php body_class(); ?>>
	
		<?php do_action("wp_start_body"); ?>
	
		<?php if (function_exists("woodkit_splashscreen")){ woodkit_splashscreen(); }; ?>
	
		<div id="page" class="hfeed site">

			<?php 
			$custom_logo = '';
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			if (!empty($custom_logo_id)) {
				$custom_logo = (function_exists('get_custom_logo')) ? get_custom_logo() : '';
			}
			?>

			<header id="masthead" class="site-header <?php echo (empty($custom_logo) ? "no-site-logo" : "has-site-logo"); ?>" role="banner">
				<div class="site-header-container">
					<div class="site-branding">
						<div class="site-branding-container">
							<?php 
							if (!empty($custom_logo)) {
								echo $custom_logo;
							}?>
							<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
							<?php
							$description = get_bloginfo('description', 'display');
							if ($description || is_customize_preview()){ ?>
								<p class="site-description"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo $description; ?></a></p>
							<?php } ?>
						</div>
					</div><!-- .site-branding -->
			
					<div class="site-navigation" role="navigation">
						<div class="site-navigation-container main-navigation" role="navigation">
							<h3 class="menu-toggle">
								<span class="top stripe"></span>
								<span class="middle stripe"></span>
								<span class="bottom stripe"></span>
							</h3>
							<?php wp_nav_menu( array('theme_location' => 'primary', 'menu_class' => 'nav')); ?>
							<div style="clear: both;"></div>
						</div>
					</div><!-- #site-navigation -->
					<?php do_action("woody_after_main_navigation"); ?>
				</div>
				<div style="clear: both;"></div>
			</header><!-- .site-header -->
			
			<?php if (function_exists("tool_breadcrumb")){ ?>
			<div class="site-breadcrumb">
				<div class="site-breadcrumb-container">
					<?php tool_breadcrumb(array(), true); ?>
				</div>
			</div>
			<?php } ?>
			
			<div class="main site-main">
				<div class="site-main-container">
<?php 
}
?>
