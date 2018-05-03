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
 * Template Name:blogアーカイブ
 */

get_header(); ?>

<div id="column2_wap" class="clearfix">
<?PHP query_posts('post_type=post&paged='.$paged); ?>
		<div class='column_min archive_blog'>
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('blog_posts posts clearfix'); ?>>
				<div class='sums_wap fl'>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
				</div>
				<div class="posttimes"></div>
				<header class="entry-header fr clearfix">
						<a href="<?php the_permalink(); ?>"><h1 class="entry-title fl"><?php the_title(); ?></h1></a>
						<time datetime="<?php the_time('c') ?>;" class='fr'><?php the_time('Y年m月d日'); ?></time>
				</header>
				<div class='content_wap fr'>
					<div class="entry-content">
						<?php the_excerpt(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'infernoayasetemp' ), 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
				</div>
				<a class="read_moer fr btn btn-inverse" href="<?php the_permalink(); ?>">
					続きを読む
				</a>
			</article><!-- #post -->
		<?php endwhile; // end of the loop. ?>
			<div id="nav-below" class="navigation clearfix">
				<div id="next_post" class='fl'><?php previous_posts_link('<i class="icon-chevron-left icon-white"></i>新しい投稿'); ?></div>
				<div id="prev_post" class='fr'><?php next_posts_link('前の投稿<i class="icon-chevron-right icon-white"></i>'); ?></div>
			</div>
		</div>
		<div id="column_sub">
		<?php dynamic_sidebar('sidebar_blogs'); ?>
		</div>

</div>

<?php get_footer(); ?>