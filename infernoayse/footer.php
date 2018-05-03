<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @subpackage infernoayase_Theme
 * @since infernoayse
 */
?>

		<div id="followme">
			<a href="https://twitter.com/K_chachamaru" target="_blank">
			<img src="<?php echo get_template_directory_uri(); ?>/images/followme.png" width="30" height="130" alt="followMe">
			</a>
		</div>
		<article id="browserdialog" titel='最新のブラウザが利用できます。'>
		</article>
		<footer>
			<div id='foot_wi_area' class="clearfix">
			<?php dynamic_sidebar('footer'); ?>
			</div>
			<div id="foot_nav">
			<?php wp_nav_menu(array(
				'theme_location' => 'foot_navigation'
				));?>
			</div>
			<div id='foot_copyright'>
				&copy;infernoayase All Rights Reserved.
			</div>

		</footer>
<?php
if($_COOKIE['r-18_over'] == 'TRUE'){

/*R18認証解除*/
?>
<div id='r18_regist_tools' class="animate_gallery">
<div class='alert alert-info'>
<strong>成人向けコンテンツ認証システム</strong>このパソコンは現在成人(18才以上)のユーザーがご利用中と認証しています。
<a href="#" class='btn btn-mini' onclick="
				jQuery.cookie('r-18_over','false',{path:'/'});
				location.reload(true);
				return false;
">
成人認証の解除
</a>
</div>
</div>
<?php
}
?>
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>