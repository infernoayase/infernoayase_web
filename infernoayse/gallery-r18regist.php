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
				<h1 class="entry-title">警告：あなたは18才以上ですか？</h1>
			</header>
	
			<div class="entry-content-blog">
				<p>
				このコンテンツは成人向けコンテンツです。<br />
				18才未満には早い内容が含まれます。あなたは、18才以上ですか？
				</p>
						
				<p class='r18_regist_btn'>
				<a href="#" onclick="
				history.back(); return false;
				" class='btn btn-large'>いいえ 18才未満です</a>　
				<a href="#" onclick="
				jQuery.cookie('r-18_over','TRUE',{path:'/'});
				location.reload(true);
				return false;
				" class="btn btn-large btn-primary">はい 18才以上です</a><br /><br />
				<span class='cap'>
					※注意：「はい」を押した場合は18才以上と認証しブラウザを閉じるまで同一の人が利用していると、<br />				判断し以後の警告を省略し、すべてのコンテンツにアクセスできますので、<br />
							18才未満の方とパソコンを共有している場合は閲覧終了後に、<br />
							下部分の「R18認証解除」ボタンで強制的に成人認証を解除することを推奨いたします。
				</span>
				</p>
				
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