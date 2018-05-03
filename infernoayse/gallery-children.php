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

get_header();
echo '<script type="text/javascript" src="'.get_stylesheet_directory_uri().'/js/pixiv_loader.js"></script>';
?>
<div id="column2_wap" class="clearfix">
<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class('single_gallery_post column_min clearfix'); ?>>
		<div class='sing_post_wap'>
		<span id='pege_level'>children</span>
			<header class="entry-header">
				<h1 class="entry-title"><?php the_title(); ?></h1>
			</header>
	
			<div class="entry-content-blog">
				<?php the_content(); ?>
				<p class='gallery_tax'>
				登録タグ：<?php
				$genres = get_the_terms($post->ID, 'gallery_ct');
				$genrenames = array();
				foreach( $genres as $genre ){
					$path = get_term_link($genre->slug,'gallery_ct');
					echo'<span class="label label-info"><a href="'.$path.'" title="タグ：'.$genre->name.'の付いた作品一覧">'. $genre->name .'</a> 
					<a data="'.$genre->slug.'" href="http://dic.pixiv.net/a/'.$genre->slug.'" class="pixiv_pedia" target="_blank" title="ピクシブ百科辞典で「'.$genre->name.'」を検索"><i class="icon-book icon-white op05"></i></a></span>';
				}
				?>
				</p>
				<?php
				$postCustomMulti = post_custom('画像');
				$option_ater = array(
				'class'=>''
				);
				
				if(is_array($postCustomMulti)){
					sort($postCustomMulti);
					foreach($postCustomMulti as $var) {
					$image_link = wp_get_attachment_image_src($var,'full',false);
					?>
					<a target="_blank" href="<?PHP echo $image_link[0];?>">
					<?PHP
						echo wp_get_attachment_image($var, array(670,99999),false,$option_ater);
					?>
					</a>
					<?PHP
					}
				}else{
					$image_link = wp_get_attachment_image_src($postCustomMulti,'full',false);
					?>
					<a target="_blank" href="<?PHP echo $image_link[0];?>">
					<?PHP
					echo wp_get_attachment_image($postCustomMulti, array(670,99999),false,$option_ater);
					?>
					</a>
					<?PHP
				}	
				?>
				<?PHP
				if(post_custom('ピクシブ') or post_custom('ニコニコ静画')){
				?>
				<h2>外部サービスの投稿を見る</h2>
				<?PHP 
				}
				?>
				<?PHP
				if(post_custom('ピクシブ')){
				?>
				<a target="_blank" href="<?PHP echo post_custom('ピクシブ'); ?>">
				<img width="150" src="<?php echo get_stylesheet_directory_uri(); ?>/images/pixiv_logo.svg" />
				</a>
				<?PHP 
				}
				?>
				<?PHP
				if(post_custom('ニコニコ静画')){
				?>　
				<a target="_blank" href="<?PHP echo post_custom('ニコニコ静画'); ?>">
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/niconico.png" />
				</a>
				<?PHP 
				}
				?>
				<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'infernoayasetemp' ), 'after' => '</div>' ) ); ?>
			</div><!-- .entry-content -->
		</div>
		<?php wp_social_bookmarking_light_output_e(null, get_permalink(), the_title("", "", false)); ?>
		<div class='comentarea_wap'>
			<?php comments_template(); ?>
		</div>
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'infernoayasetemp' ), '<span class="edit-link">', '</span>' ); ?>
		</footer><!-- .entry-meta -->

	</article><!-- #post -->

<?php endwhile; // end of the loop. ?>
	<div id="column_sub">
		<?php dynamic_sidebar('sidebar_gallery'); ?>
	</div>
</div>
<?php get_footer(); ?>