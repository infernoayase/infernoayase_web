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
$titel=get_the_title();
$id=get_the_ID();
$args = array(
		'post_parent' => $id,
		'post_type'=>'gallery',
		'posts_per_page' => 9, 
		'order' => 'DESC',
		'orderby' => 'date',
		'paged'=>$paged
); 
query_posts($args);
get_header(); ?>
<script type="text/javascript">
var pege_nam = '<?php echo $paged; ?>';
</script>
<div id='blackout_wap'class='<?php 
if(!strpos($_SERVER['HTTP_REFERER'],'gallery')===false){
	echo 'bacondemand';}
?>'></div>
<script src="<?PHP echo get_stylesheet_directory_uri(); ?>/js/g_animetscript.js" type="text/javascript" ></script>
<div id="column2_wap" class="clearfix">
	<div class='column_min archive_gallery'>
	<span id='pege_level'>parent</span>
	<h1><?php echo$titel;?></h1>
		<?php while ( have_posts() ) : the_post(); ?>
		<article id="gallery-<?php the_ID(); ?>" <?php post_class('gallery_posts_listtiep posts clearfix children_post'); ?>> <a href="<?php the_permalink(); ?>" class='icon_links'>
			<div class='icon_wap'>
			<?PHP 
			$imgs = post_custom('画像');
			 if(has_post_thumbnail()){
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
					if(is_array($imgs)){
						sort($imgs);
						foreach($imgs as $var) {
							echo wp_get_attachment_image($var,'gallery_icon',true);
							break;
						}
					}else{
						echo wp_get_attachment_image($imgs,'gallery_icon',true); 
					}
				}else{
				?>
				<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/r-18_225.gif" alt="18禁" />				
				<?php	
				}
			  }else{
				  the_post_thumbnail('gallery_icon');
				}
			?>
			</div>
			<div class='wap_black'> </div>
			<h2>
				<?php echo mb_strimwidth(get_the_title(), 0,25, "…") ;?>
			</h2>
			</a> </article>
		<?php endwhile; // end of the loop. ?>
		<div id="nav-below" class="navigation clearfix fl">
			<div id="next_post" class='fl'>
				<?php previous_posts_link('<i class="icon-chevron-left icon-white"></i>新しい投稿'); ?>
			</div>
			<div id="prev_post" class='fr'>
				<?php next_posts_link('前の投稿<i class="icon-chevron-right icon-white"></i>'); ?>
			</div>
		</div>
	</div>
	<div id="column_sub">
		<?php dynamic_sidebar('sidebar_gallery'); ?>
	</div>
</div>
<?php get_footer(); ?>
