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
?>
		<div class='sing_post_wap'>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
	
			<div class="entry-content-blog clearfix">
			<div class='post_metadeta clearfix'>
				<div class='tag_cts'>
				<?php
				/* translators: used between list items, there is a space after the comma */
				$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );
	
				/* translators: used between list items, there is a space after the comma */
				$tag_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
				if ( '' != $tag_list ) {
					$utility_text = __( 'カテゴリ：%1$s 　タグ： %2$s', 'twentyeleven' );
				} elseif ( '' != $categories_list ) {
					$utility_text = __( 'カテゴリ： %1$s ', 'twentyeleven' );
				} else {
					$utility_text = __( '', '' );
				}
	
				printf(
					$utility_text,
					$categories_list,
					$tag_list,
					esc_url( get_permalink() ),
					the_title_attribute( 'echo=0' ),
					get_the_author(),
					esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
				);
			?>
			</div>
			<time datetime="<?php the_time('c') ?>;" class='fr'><?php the_time('Y年m月d日(D)h時i分s秒'); ?></time>
		</div>
				<?php the_content(); ?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'infernoayasetemp' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		</div>
		<?php wp_social_bookmarking_light_output_e(null, get_permalink(), the_title("", "", false)); ?>
		<div class='comentarea_wap'>
			<?php if( pings_open() ) : ?>
			この記事のトラックバックURL<input class="input-block-level" type="text" value="<?php trackback_url(); ?>" />
			<?php endif; ?>
		</div>
		<div class='comentarea_wap'>
			<?php comments_template(); ?>
		</div>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'infernoayasetemp' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->

	