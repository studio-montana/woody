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
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('content-page'); ?>>
	
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	
	<?php if (function_exists("woodkit_pagination")){
		woodkit_pagination(array(), true, '<div class="pagination">', '</div>', '<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'); 
	}else{ 
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'woody') . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'woody') . ' </span>%',
			'separator'   => '<span class="screen-reader-text">, </span>',
			) );
	} ?>

	<footer class="entry-meta">
		<?php if (is_single() && get_the_author_meta('description') && is_multi_author()) : ?>
			<?php get_template_part('author-bio'); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
