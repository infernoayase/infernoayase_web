<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage infernoayase_Theme
 * @since infernoayse
 */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('anonymous_eventl'); ?>>
		<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>
		<div class="entry-content-blog">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'infernoayasetemp' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
	</article><!-- #post -->
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>