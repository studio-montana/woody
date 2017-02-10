<?php
/**
 Template Name: Sitemap
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

get_header();?>

<?php 
function woody_sitemap_get_node($post_type, $posts, $is_hierarchical = false){
	global $post;
	?>
	<ul class="sitemap-box post-type-<?php echo $post_type; ?>">
	<?php
	foreach ($posts as $post){
		setup_postdata($post);
		?>
		<li><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></li>
		<?php
		if ($is_hierarchical){
			$sub_posts = get_pages(array("post_type" => $post_type, 'numberposts' => -1, "orderby" => "name", "order" => "ASC", "parent" => get_the_ID(), "suppress_filters" => false));
			if (!empty($sub_posts)){
				woody_sitemap_get_node($post_type, $sub_posts, $is_hierarchical);
			}
		}
		wp_reset_postdata();
	}
	?>
	</ul>
	<?php
}
?>

	<div id="primary" class="content-area page sitemap">
		<div id="content" class="site-content" role="main">
			<article>
				<?php 
				$available_posttypes = apply_filters("sitemap_available_posttypes", woody_get_displayed_post_types(true));
				foreach ($available_posttypes as $post_type){
					if ($post_type != 'wpcf7_contact_form'){
						$is_hierarchical = is_post_type_hierarchical($post_type);
						if ($is_hierarchical)
							$posts = get_pages(array("post_type" => $post_type, 'numberposts' => -1, "orderby" => "name", "order" => "ASC", "parent" => 0, "suppress_filters" => false));
						else
							$posts = get_posts(array("post_type" => $post_type, 'numberposts' => -1, "orderby" => "name", "order" => "ASC", "suppress_filters" => false));
						if (!empty($posts)){
							$current_post_type_label = get_post_type_labels(get_post_type_object($post_type));
							?>
							<h3 class="sitemap-title post-type-<?php echo $post_type; ?>"><?php echo $current_post_type_label->name; ?></h3>
							<?php woody_sitemap_get_node($post_type, $posts, $is_hierarchical); ?>
							<?php
						}
					}
				}
				?>
			</article>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
?>