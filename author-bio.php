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
	?>
	<div class="author-info">
		<div class="author-avatar">
			<?php
			/**
			 * Filter the author bio avatar size.
			 *
			 * @since Woody 1.0
			 *
			 * @param int $size The avatar height and width size in pixels.
			 */
			$author_bio_avatar_size = apply_filters('woody_author_bio_avatar_size', 74 );
			echo get_avatar( get_the_author_meta('user_email'), $author_bio_avatar_size );
			?>
		</div><!-- .author-avatar -->
		<div class="author-description">
			<h2 class="author-title"><?php printf( __('About %s', 'woody'), get_the_author() ); ?></h2>
			<p class="author-bio">
				<?php the_author_meta('description'); ?>
				<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ); ?>" rel="author">
					<?php printf( __('View all posts by %s <span class="meta-nav">&rarr;</span>', 'woody'), get_the_author() ); ?>
				</a>
			</p>
		</div><!-- .author-description -->
	</div><!-- .author-info -->
<?php } ?>