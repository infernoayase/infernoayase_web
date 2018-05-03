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
/*事前処理*/
$args = array(
	'tax_query' => array(
		array(
			'taxonomy' => 'gallery_ct',
			'field' => 'slug',
			'terms' => 'カテゴリ'
		)
	),
	'offset'=>$paged,
	'orderby'=>'menu_order'
);
query_posts($args);

get_header(); 
?>
		<div id='blackout_wap'class='<?php 
		if(!strpos($_SERVER['HTTP_REFERER'],'gallery')===false){
			echo 'bacondemand';}
		?>'></div>
<script src="<?PHP echo get_stylesheet_directory_uri(); ?>/js/g_animetscript.js" type="text/javascript" ></script>
<div id="column2_wap" class="clearfix">
		<span id='pege_level'>archive</span>
		<div class='column_min archive_gallery'>
			<?php while ( have_posts() ) : the_post(); ?>
			<article id="gallery-<?php the_ID(); ?>" <?php post_class('gallery_posts_listtiep gallery_posts posts clearfix'); ?>>
			<a href="<?php the_permalink(); ?>" class='icon_links'>
			<div class='icon clearfix'>
			<?php
			$id=get_the_ID();
			$args = array(
				 'post_parent' => $id,
				 'post_type'=>'gallery',
				 'posts_per_page' => 9, 
				 'order' => 'DESC',
				 'orderby' => 'date'
			); ?>
			<?php $loop = new WP_Query( $args ); ?>
			
			  <?php if($loop -> have_posts()): ?>
			  <?php while($loop -> have_posts()): $loop->the_post();
				$imgs = post_custom('画像');
				$r18_regist = true;
				
				$genres = get_the_terms($post->ID, 'gallery_ct');
				$genres_n = array();
				
				foreach($genres as $genre){
				array_push($genres_n,$genre->name);
				}
				$r18_img_f = in_array('R-18',$genres_n);
				if($_COOKIE['r-18_over'] != 'TRUE' && $r18_img_f){
				$r18_regist = false;
				}

				if($r18_regist){
					if(has_post_thumbnail()){
						if(is_array($imgs)){
						  sort($imgs);
						  foreach($imgs as $var) {
							echo wp_get_attachment_image($var,'gallery_icon_sub',true);
								break;
						  }
						}else{
								echo wp_get_attachment_image($imgs,'gallery_icon_sub',true); 
						}
					
					}else{
						the_post_thumbnail('gallery_icon_sub');
					}
				}else{
				?>
				<img class='attachment-gallery_icon_sub' src="<?php echo get_stylesheet_directory_uri(); ?>/images/r-18_55.gif" alt="18禁" />				
				<?php	
				}
			   endwhile; endif; ?>
			<?php wp_reset_postdata(); ?>			
			</div>
			<div class='wap_black'>
			</div>
			<h2><?php the_title(); ?></h2>
			</a>
			</article>
		<?php endwhile; // end of the loop. ?>
			<div id="nav-below" class="navigation clearfix">
				<div id="next_post" class='fl'><?php previous_posts_link('<i class="icon-chevron-left icon-white"></i>新しい投稿'); ?></div>
				<div id="prev_post" class='fr'><?php next_posts_link('前の投稿<i class="icon-chevron-right icon-white"></i>'); ?></div>
			</div>

		</div>
		<div id="column_sub">
		<?php dynamic_sidebar('sidebar_gallery'); ?>
		</div>

</div>

<?php get_footer(); ?>