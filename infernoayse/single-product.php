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

<article>
	<div id="column2_wap" class="clearfix">
		<?php while ( have_posts() ) : the_post(); ?>
		<div class='product_navi'>
			<header>
			<?PHP
			$titel=get_the_title();
			$root_page = ps_get_root_page( $post );
			$root_pageurl = get_permalink($root_page->ID);
			?>
							<a href="<?PHP echo $root_pageurl ?>">
			<?php
			$logo_attid =ps_get_logo_treasure($post);
			$option_ater =array(
				'alt'=>$titel
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
			</header>
			<nav>
			<ul>
			  <?php wp_list_pages('sort_column=menu_order&title_li=&post_type=product&child_of='.$root_page->ID); ?>
			</ul>
			</nav>
		</div>
		<div id="post-<?php the_ID(); ?>" <?php post_class('product_content clearfix entry-content'); ?>>
			<?php the_content(); ?>
		</div>
		<?php endwhile; // end of the loop. ?>
	</div>
	<div id='product_coment'>
		<?php wp_social_bookmarking_light_output_e(null, get_permalink(), the_title("", "", false)); ?>
		<div class='comentarea_wap'>
				<?php comments_template(); ?>
		</div>
	</div>
</article>
<?php get_footer(); ?>
