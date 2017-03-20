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

	get_header();?>
	
		<div id="primary" class="content-area single">
			<div id="content" class="site-content" role="main">
	
				<?php 
				while ( have_posts() ) : the_post();
	
					if (function_exists("et_pb_is_pagebuilder_used") && et_pb_is_pagebuilder_used( get_the_ID() )) {
						get_template_part('content-divi', get_post_type());
					}else{
						get_template_part('content', get_post_type());
					}
					 
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) {
						comments_template();
					}
	
				endwhile;
				?>
	
			</div><!-- #content -->
		</div><!-- #primary -->
		
	<?php
	get_sidebar();
	get_footer();
	
}
?>