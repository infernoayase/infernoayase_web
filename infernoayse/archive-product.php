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
			<article id="post-<?php the_ID(); ?>" <?php post_class('archive_posts product_posts posts clearfix'); ?>>
				<div class='product_pict_wap fl'>
					<?PHP
					$titel=get_the_title();
					$root_page = ps_get_root_page( $post );
					$root_pageurl = get_permalink($root_page->ID);
					$option_ater =array(
						'alt'=>$titel,
						'class'=>'thumbnail'
					);
					?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('product_icon_sub',$option_ater); ?></a>
				</div>
				<div class="posttimes"></div>
				<header class="product_header">
					<h1>
					<a href="<?php the_permalink(); ?>">
					<?php
					$logo_attid =ps_get_logo_treasure($post);
					$option_ater =array(
						'alt'=>$titel,
						'class'=>''
					);
					if(!post_custom('ロゴ')){
						if($logo_attid){
							foreach($logo_attid as $var) {
								echo wp_get_attachment_image($var,'posts_per_page',false,$option_ater);
							}
						}	
					}else{
						echo wp_get_attachment_image(post_custom('ロゴ'),'product_logo',false,$option_ater);
					}
					?>
					</a>
					</h1>
				</header>
				<div class='content_wap fr'>
					<nav>
						<ul class='product_archive_nav clearfix'>
								  <?php wp_list_pages('sort_column=menu_order&title_li=&post_type=product&child_of='.$root_page->ID); ?>
						</ul>
					</nav>
					<div class="entry-content">
						<?php  the_excerpt(); ?>
					</div><!-- .entry-content -->
				</div>
			</article><!-- #post -->
		<?php endwhile; // end of the loop. ?>
			<div id="nav-below" class="navigation clearfix">
				<div id="next_post" class='fl'><?php previous_posts_link('<i class="icon-chevron-left icon-white"></i>新しい投稿'); ?></div>
				<div id="prev_post" class='fr'><?php next_posts_link('前の投稿<i class="icon-chevron-right icon-white"></i>'); ?></div>
			</div>
</div>

<?php get_footer(); ?>