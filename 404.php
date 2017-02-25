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

	get_header(); ?>

	<div id="primary" class="content-area page-not-found">
		<div id="content" class="site-content" role="main">
	
			<article class="not-found">
				<header class="entry-header">
					<h1 class="entry-title">404</h1>
				</header>
				<div class="entry-content">
					<p class="causes-title">
						<?php _e("We couldn't find the page you were looking for. This is either because", 'woody'); ?>
						:
					</p>
					<ul class="causes">
						<li><?php _e("There is an error in the URL entered into your web browser. Please check the URL and try again", 'woody'); ?>.</li>
						<li><?php _e("The page you are looking for has been moved or deleted", 'woody'); ?>.</li>
					</ul>
					<p class="solution">
						<?php _e("You can return to our homepage by", 'woody'); ?>
						&nbsp;<a href="<?php echo esc_url(home_url('/')); ?>"
							title="<?php _e("Home", 'woody'); ?>"><?php _e("clicking here", 'woody'); ?>
						</a>,&nbsp;
						<?php _e("or you can try searching for the content you are seeking", 'woody'); ?>
						.
						<?php get_search_form(); ?>
					</p>
				</div>
			</article>
	
		</div>
		<!-- #content -->
	</div>
	<!-- #primary -->

	<?php
	get_footer();
}
?>