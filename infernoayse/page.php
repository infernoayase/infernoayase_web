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
			<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('single_p'); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content clearfix">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'infernoayasetemp' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php wp_social_bookmarking_light_output_e(null, get_permalink(), the_title("", "", false)); ?>
		<div class='comentarea_wap'>
			<?php comments_template(); ?>
		</div>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'infernoayasetemp' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
	<?php endwhile; // end of the loop. ?>
	

<?php get_footer(); ?>