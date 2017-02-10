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

$display_title = true;
if (function_exists('woody_is_display_content_resume_title')){
	$display_title = woody_is_display_content_resume_title();
}
$display_meta = true;
if (function_exists('woody_is_display_content_resume_meta')){
	$display_meta = woody_is_display_content_resume_meta();
}
if (!function_exists('woody_entry_meta')){
	$display_meta = false;
}
$display_thumbnail = true;
if (function_exists('woody_is_display_content_resume_thumbnail')){
	$display_thumbnail = woody_is_display_content_resume_thumbnail();
}
if (post_password_required() || !has_post_thumbnail()){
	$display_thumbnail = false;
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('content-resume'); ?>>


	<?php if ($display_title || $display_thumbnail || $display_meta){ ?>
	
		<header class="entry-header">
	
			<?php if ($display_thumbnail){ ?>
				<div class="entry-thumbnail">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_post_thumbnail('post-content'); ?></a>
				</div>
			<?php } ?>

			<?php if ($display_title){ ?>
				<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr(get_the_title()); ?>"><?php the_title(); ?></a></h1>
			<?php } ?>

			<?php if ($display_meta){ ?>
				<div class="entry-meta"><?php woody_entry_meta(); ?></div>
			<?php } ?>
			
		</header>
		
	<?php } ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	
	<?php if (comments_open() && ! is_single()) : ?>
		<footer class="comments-link">
			<?php comments_popup_link('<span class="leave-reply">' . __('Comment', 'woody') . '</span>', __('One comment', 'woody'), __('See % comments', 'woody') ); ?>
		</footer><!-- .comments-link -->
	<?php endif; // comments_open() ?>
	
</article><!-- #post -->
