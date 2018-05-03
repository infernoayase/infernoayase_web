<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @subpackage infernoayase_Theme
 * @since infernoayse
 */

get_header(); ?>
<div id="column2_wap" class="clearfix">
<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('single_post entry-content column_min clearfix'); ?>>
			<?php
			if ( in_category('blog') ) {
				include(TEMPLATEPATH . '/single_templates/blog.php');
			}else{
				include(TEMPLATEPATH . '/single_templates/blog.php');
			}
			 ?>
	</article><!-- #post -->
<?php endwhile; // end of the loop. ?>
	<div id="column_sub">
	<?php dynamic_sidebar('sidebar_blogs'); ?>
	</div>
</div>
<?php get_footer(); ?>