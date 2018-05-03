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
$weekday = array( '(日)', '(月)', '(火)', '(水)', '(木)', '(金)', '(土)' );
get_header(); ?>
<div id="column2_wap" class="clearfix">
		<?php while ( have_posts() ) : the_post(); ?>
			<section itemscope itemtype="http://schema.org/Festival" id="post-<?php the_ID(); ?>" <?php post_class('archive_posts event_posts posts'); ?>>
				<header class="event_header clearfix">
					<p class='date fl'><?PHP echo date('Y年n月j日', strtotime(post_custom('イベント開催期間_参加日'))).$weekday[date('w',strtotime(post_custom('イベント開催期間_参加日')))]; ?></p>
					<h1 itemprop="name" class="entry-title fl"><?php the_title(); ?></h1>
					<?PHP
					if(strtotime( "now" )>strtotime(post_custom('イベント開催期間_参加日'))){
						echo '<p class="fr">過去イベント</p>';
						}
					?>
				</header>
				<div class='content_wap'>
					<table class='table'>
					<tr>
						<th>
						参加日
						</th>
						<td itemprop='Date'>
						<?PHP echo date('Y年n月j日', strtotime(post_custom('イベント開催期間_参加日'))).$weekday[date('w',strtotime(post_custom('イベント開催期間_参加日')))]; ?>
						</td>
					</tr>
					<tr>
						<th>
						サークル名
						</th>
						<td>
							<span itemprop='performer'>inferno ayase-インフェルノアヤセ-</span>
						</td>
					</tr>
					<tr>
						<th>
						概要・頒布物
						</th>
						<td itemprop='description'>
							<?php the_content(); ?>
						</td>
					</tr>
					<tr>
						<th>
						スペース
						</th>
						<td itemprop='location'>
						<?PHP echo post_custom('スペース情報'); ?>
						</td>
					</tr>
					<tr>
						<th>
						開催場所
						</th>
						<td itemprop='location'>
						<?PHP echo post_custom('開催場所'); ?>
						</td>
					</tr>
					<tr>
						<th>
						即売会の開催日程
						</th>
						<td>
						<?PHP 
							if(post_custom('イベント開催期間_開始')==post_custom('イベント開催期間_終了')){
							?>
							<span itemprop='startDate'><?PHP echo date('Y年n月j日', strtotime(post_custom('イベント開催期間_開始'))).$weekday[date('w',strtotime(post_custom('イベント開催期間_開始')))]; ?></span>
							<?PHP
							}else{
						?>
							<span itemprop='startDate'><?PHP echo date('Y年n月j日', strtotime(post_custom('イベント開催期間_開始'))).$weekday[date('w',strtotime(post_custom('イベント開催期間_開始')))]; ?></span>
							～
							<span itemprop='endDate'><?PHP echo date('Y年n月j日', strtotime(post_custom('イベント開催期間_終了'))).$weekday[date('w',strtotime(post_custom('イベント開催期間_終了')))]; ?></span>

						<?PHP
							}
						?>
						</td>
					</tr>
					<tr>
						<th>
						主催
						</th>
						<td>
						<span itemprop='offers'><?PHP echo post_custom('主催'); ?></span> -<a itemprop='url' href="<?PHP echo post_custom('主催WebURL'); ?>" target="_blank"><?PHP echo post_custom('主催WebURL'); ?></a>-<br />
						※主催のWebページを熟読の上、イベントのルールを守ってご参加ください。
						</td>
					</tr>
					</table>
				</div>
			</section><!-- #post -->
		<?php endwhile; // end of the loop. ?>
			<div id="nav-below" class="navigation clearfix">
				<div id="next_post" class='fl'><?php previous_posts_link('<i class="icon-chevron-left icon-white"></i>新しい投稿'); ?></div>
				<div id="prev_post" class='fr'><?php next_posts_link('前の投稿<i class="icon-chevron-right icon-white"></i>'); ?></div>
			</div>
</div>

<?php get_footer(); ?>