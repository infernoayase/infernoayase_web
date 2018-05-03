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
<?PHP 
/*
TOPイメージスライダー
*/
 ?>
<script type="text/javascript" src="<?PHP echo get_stylesheet_directory_uri(); ?>/js/jquery.bxslider.js"></script>
<link rel="stylesheet" type="text/css" media="all" href="<?PHP echo get_stylesheet_directory_uri(); ?>/css/jquery.bxslider.css" />
<link rel="stylesheet" type="text/css" media="all" href="<?PHP echo get_stylesheet_directory_uri(); ?>/css/bx.slider.customize.css" />
<script type="text/javascript">
jQuery(document).ready(function () {
	jQuery('#slider article').eq(0).addClass('s_active');
	jQuery('#slider').bxSlider({
			mode:'fade',
			auto:true,
			pager:true,
			speed:1000,
			pause:4000,
			prevText:'前のスライダー',
			nextText:'次のスライダー',
			slideSelector:'article',
			onSlideBefore:function(e,o,n){
				jQuery('#slider article').eq(o).removeClass('s_active');
				setTimeout( function(){jQuery('#slider article').eq(n).addClass('s_active');},2);
				}
			});
});
</script>
		<div id="slider">
		<?php
		query_posts('post_type=slide&orderby=menu_order&order=ASC');
		while(have_posts()) : the_post();
		?>
		<article>
		<?php the_content(); ?>
		</article>
		<?php endwhile; ?>
		</div>
		<div id="main_content_wap">
			<div id="main_content">

			</div>
		</div>
<?php get_footer(); ?>