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
	
		<div id="primary" class="content-area">
			<div id="content" class="site-content" role="main">
	
			<?php if ( have_posts() ) : ?>
				<header class="archive-header entry-header">
					<div class="content">
						<h1 class="title"><?php echo single_term_title(); ?></h1>
						<?php
						$term_description = term_description();
						if (!empty($term_description)){ ?>
							<div class="chapo"><?php echo $term_description; ?></div>
						<?php } ?>
					</div>
				</header><!-- .archive-header -->
	
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part('content-resume', get_post_type()); ?>
				<?php endwhile; ?>
	
			<?php else : ?>
				<?php get_template_part('content', 'none'); ?>
			<?php endif; ?>
	
			</div><!-- #content -->
		</div><!-- #primary -->
	
	<?php
	get_sidebar();
	get_footer();
}
?>