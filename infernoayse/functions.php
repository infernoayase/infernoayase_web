<?php
	date_default_timezone_set('Asia/Tokyo');
/*メニュー周りの実装*/
add_theme_support( 'menus' );
add_filter('walker_nav_menu_start_el', 'description_in_nav_menu', 10, 4);

function description_in_nav_menu($item_output, $item){
	//属性が画像の場合表示するコード
	$filename = $item->attr_title;
	$exext = substr($filename, strrpos($filename, '.') + 1);
	$imgs = "";
	if($exext == 'jpg'||$exext == 'png'){
		$imgs = "<img src='". $filename ."'>";
		$item_output = preg_replace('/\stitle=".*?"/',"", $item_output);
	}
	
	
	$item_output = preg_replace('/(<a.*?>[^<]*?)</', '$1' . "<span class='cap_text'>{$item->description}</span><", $item_output);
	$item_output = preg_replace('/(<a.*?>)/', '$1' ."$imgs"."<span class='link_text'>", $item_output);
	$item_output = preg_replace('/(<span.*?>[^<]*?)</','$1'."</span><", $item_output);
	return $item_output;
}
/**
 *
 *カスタマイズコード
 *
 */

//ワードプレスジェネレーターを削除
remove_action('wp_head','wp_generator');

//Googleアナルティクス
add_action('wp_footer', 'ga');

function ga(){ ?>
	
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-43450699-1']);
  _gaq.push(['_setDomainName', 'infernoayase.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>	
	<?PHP
}

/*背景カスタマイズ機能の実装*/
add_action( 'customize_register', 'theme_customize_register' );
function theme_customize_register($wp_customize) {
	$wp_customize->add_section( 'custombackground_section', array(
		'title'          =>'背景スライダー',
		'priority'       => 100
	));
	$wp_customize->add_setting('custombackground_options[img01]', array(
   'type'  => 'option'
	));
	$wp_customize->add_setting('custombackground_options[img02]', array(
   'type'  => 'option'
	));
	$wp_customize->add_setting('custombackground_options[img03]', array(
   'type'  => 'option'
	));
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img_1', array(
	'label'        => "一枚目の画像",
	'section'    => 'custombackground_section',
	'settings'   => 'custombackground_options[img01]',
	) ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img_2', array(
	'label'        => "二枚目の画像",
	'section'    => 'custombackground_section',
	'settings'   => 'custombackground_options[img02]',
	) ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'img_3', array(
	'label'        => "三枚目の画像",
	'section'    => 'custombackground_section',
	'settings'   => 'custombackground_options[img03]',
	) ) );


}

/*不要な情報の削除*/
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'rsd_link');

/*BLOG用サイドバー*/
register_sidebar(array(
            'name'=>'sidebar_blogs',
			'description'   => 'ブログ用のサイドバー',
            'before_widget'=> '<aside class="sidebar-wrapper">',
            'after_widget' => '</aside>',
            'before_title' => '<header class="sidebar-title_wap"><h2 class="sidebar-title">',
            'after_title'  => '</h2></header>'
));

/*フッター用サイドバー*/
register_sidebar(array(
            'name'=>'footer',
			'description'   => 'フッターのウィジェット',
            'before_widget'=> '<aside class="footer-widget-wrapper">',
            'after_widget' => '</aside>',
            'before_title' => '<header class="footer-widget-title_wap"><h2 class="footer-widget-title">',
            'after_title'  => '</h2></header>'
));

/*ギャラリー用サイドバー*/
register_sidebar(array(
            'name'=>'sidebar_gallery',
			'description'   => 'ギャラリーのウィジェット',
            'before_widget'=> '<aside class="sidebar-wrapper">',
            'after_widget' => '</aside>',
            'before_title' => '<header class="sidebar-title_wap"><h2 class="sidebar-title">',
            'after_title'  => '</h2></header>'
));

//カレンダー土日クラス
function add_week_class2calendar( $calendar_output ) {
    $week_map = array(
        'mon' => '月曜日',
        'tue' => '火曜日',
        'wed' => '水曜日',
        'thu' => '木曜日',
        'fri' => '金曜日',
        'sat' => '土曜日',
        'sun' => '日曜日',
    );
  
    $regex = '/<th scope="col" title="([^"]+?)"/';
    $num = preg_match_all( $regex, $calendar_output, $m );
  
    if ( $num ) {
        $replace = array();
        for ( $i = 0; $i < $num; $i++ ) {
            $replace[$i] = '<th scope="col" class="' . array_search( $m[1][$i], $week_map ) . '" title="' . $m[1][$i] . '"';
        }
        $calendar_output = str_replace( $m[0], $replace, $calendar_output );
    }
    return $calendar_output;
}
add_filter( 'get_calendar', 'add_week_class2calendar' );
 
 
function add_week_classes2calendar( $calendar_output ) {
    global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;
  
    if ( isset($_GET['w']) )
        $w = ''.intval($_GET['w']);
  
    // Let's figure out when we are
    if ( !empty($monthnum) && !empty($year) ) {
        $thismonth = ''.zeroise(intval($monthnum), 2);
        $thisyear = ''.intval($year);
    } elseif ( !empty($w) ) {
        // We need to get the month from MySQL
        $thisyear = ''.intval(substr($m, 0, 4));
        $d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
        $thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
    } elseif ( !empty($m) ) {
        $thisyear = ''.intval(substr($m, 0, 4));
        if ( strlen($m) < 6 )
                $thismonth = '01';
        else
                $thismonth = ''.zeroise(intval(substr($m, 4, 2)), 2);
    } else {
        $thisyear = gmdate('Y', current_time('timestamp'));
        $thismonth = gmdate('m', current_time('timestamp'));
    }
  
    $jp_holidays = get_option( 'jp_holidays' );
  
    if ( ( ! $jp_holidays || !isset( $jp_holidays[$thisyear . $thismonth] ) || $jp_holidays[$thisyear . $thismonth]['expire'] < time() ) && $thisyear >= 2000 ) {
        $holiday_api = 'http://www.finds.jp/ws/calendar.php?php&y=' . $thisyear . '&m=' . $thismonth . '&t=h&l=2';
        $ch = curl_init( $holiday_api );
        curl_setopt( $ch, CURLOPT_FAILONERROR, true );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_TIMEOUT, 5 );
        $source = curl_exec( $ch );
        curl_close( $ch );
        if ( $source ) {
            $results = maybe_unserialize( $source );
            if ( isset( $results['status'] ) && $results['status'] == 200 ) {
                if ( ! is_array( $jp_holidays ) ) {
                    $jp_holidays = array();
                }
                $jp_holidays[$thisyear . $thismonth] = array();
                if ( isset( $results['result']['day'] ) ) {
                    foreach ( $results['result']['day'] as $hday ) {
                        $jp_holidays[$thisyear . $thismonth][$hday['mday']] = array( 'type' => $hday['htype'], 'name' => $hday['hname'] );
                    }
                    $jp_holidays[$thisyear . $thismonth]['expire'] = time() + 365 * 24 * 3600;
                }
                update_option( 'jp_holidays', $jp_holidays );
            }
        }
    }
  
    $yar = (int)$thisyear;
    $mon = (int)$thismonth;
    $day = 1;
    $regex = array();
    while( checkdate( $mon, $day, $yar ) ) {
        $classes = array();
        $wday = date( 'w', strtotime( sprintf( '%04d-%02d-%02d', $yar, $mon, $day ) ) );
        switch ( $wday ) {
        case 0 :
            $classes[] = 'sun';
            break;
        case 6 :
            $classes[] = 'sat';
            break;
        default :
        }
        if ( $jp_holidays && is_array( $jp_holidays ) && count( $jp_holidays[$thisyear . $thismonth] ) && isset( $jp_holidays[$thisyear . $thismonth][$day] ) ) {
            $classes[] = 'holiday';
        }
        $class = '';
  
        if ( count( $classes ) ) {
            $class =  ' class="' . implode( ' ', $classes ) . '"';
        }
        if ( $class ) {
            $regex['|<td( id="today")?>((<a href="[^"]+" title="[^"]+">)?' . $day . '(</a>)?)</td>|'] = '<td$1' . $class . '>$2</td>';
        }
        $day++;
    }
  
    $calendar_output = preg_replace( array_keys( $regex ), $regex, $calendar_output );
  
    return $calendar_output;
}
add_filter( 'get_calendar', 'add_week_classes2calendar', 0 );

/*
*
* カスタム投稿タイプスライダーを追加*
*
*/
// カスタム投稿タイプを作成する
//*カスタム投稿タイプ　※Galleryと作品情報*//
add_action('init', 'gallery_init');
function gallery_init()
{
  $labels = array(
    'name' => 'ギャラリー',
    'singular_name' => 'gallery',
    'add_new' => '画像追加',
    'add_new_item' => __('画像追加する'),
    'edit_item' => __('画像情報を編集'),
    'new_item' => __('新しい画像'),
    'view_item' => __('画像を見る'),
    'search_items' => __('画像を探す'),
    'not_found' =>  __('画像はありません'),
    'not_found_in_trash' => __('ゴミ箱に画像はありません'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_position' => 5,
    'supports' => array('title','editor','publicize','thumbnail','excerpt','author','comments','revisions','page-attributes'),
    'has_archive' => true
  );
  register_post_type('gallery',$args);
}

add_action('init', 'product_init');
function product_init()
{
  $labels = array(
    'name' => '作品',
    'singular_name' => 'product',
    'add_new' => '作品追加',
    'add_new_item' => __('作品を追加する'),
    'edit_item' => __('作品情報を編集'),
    'new_item' => __('新しい作品'),
    'view_item' => __('作品を見る'),
    'search_items' => __('作品を探す'),
    'not_found' =>  __('作品はありません'),
    'not_found_in_trash' => __('ゴミ箱に作品がありません'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => true,
    'menu_position' => 5,
    'supports' => array('title','publicize','editor','thumbnail','excerpt','author','comments','revisions','page-attributes'),
    'has_archive' => 'product'
  );
  register_post_type('product',$args);

 $args = array(
    'label' => '画像のカテゴリ',
    'labels' => array(
        'name' => '画像カテゴリ',
        'singular_name' => '画像カテゴリ',
        'search_items' => '画像カテゴリを検索',
        'popular_items' => 'よく使われている画像カテゴリ',
        'all_items' => 'すべての画像カテゴリ',
        'parent_item' => '親画像カテゴリ',
        'edit_item' => '画像カテゴリの編集',
        'update_item' => '更新',
        'add_new_item' => '新規画像カテゴリを追加',
        'new_item_name' => '新しい画像カテゴリ',
    ),
    'public' => true,
    'show_ui' => true,
    'show_tagcloud' => true,
	'rewrite' => true /* パーマリンクのリライトの許可 */

  );
  register_taxonomy('gallery_ct','gallery', $args);
  
   $args = array(
    'label' => '作品のカテゴリ',
    'labels' => array(
        'name' => '作品カテゴリ',
        'singular_name' => '作品カテゴリ',
        'search_items' => '作品カテゴリを検索',
        'popular_items' => 'よく使われている作品カテゴリ',
        'all_items' => 'すべての作品カテゴリ',
        'parent_item' => '親作品カテゴリ',
        'edit_item' => '作品カテゴリの編集',
        'update_item' => '更新',
        'add_new_item' => '新規作品カテゴリを追加',
        'new_item_name' => '新しい作品カテゴリ',
    ),
    'public' => true,
    'show_ui' => true,
    'show_tagcloud' => true,
	'rewrite' => true /* パーマリンクのリライトの許可 */

  );
  register_taxonomy('product_ct','product', $args);
}
add_action('init', 'add_slide_post_type');
function add_slide_post_type() {
    $params = array(
            'labels' => array(
                    'name' => 'スライド',
                    'singular_name' => 'スライド',
                    'add_new' => '新規追加',
                    'add_new_item' => 'スライドを新規追加',
                    'edit_item' => 'スライドを編集する',
                    'new_item' => '新規スライド',
                    'all_items' => 'スライド一覧',
                    'view_item' => 'スライドの説明を見る',
                    'search_items' => '検索する',
                    'not_found' => 'スライドが見つかりませんでした。',
                    'not_found_in_trash' => 'ゴミ箱内にスライドが見つかりませんでした。'
            ),
            'public' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'supports' => array(
                    'title',
                    'editor'
            ),
            'taxonomies' => array('slide_category','slide_tag')
    );
    register_post_type('Slide', $params);
}

add_action('init', 'add_event_post_type');
function add_event_post_type() {
    $params = array(
            'labels' => array(
                    'name' => '即売会',
                    'singular_name' => '即売会',
                    'add_new' => '新規追加',
                    'add_new_item' => '即売会を新規追加',
                    'edit_item' => '即売会を編集する',
                    'new_item' => '新規即売会',
                    'all_items' => '即売会一覧',
                    'view_item' => '即売会の説明を見る',
                    'search_items' => '検索する',
                    'not_found' => '即売会が見つかりませんでした。',
                    'not_found_in_trash' => 'ゴミ箱内に即売会が見つかりませんでした。'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
                    'title',
                    'editor'
            ),
    );
    register_post_type('event', $params);
}

//customize投稿履歴オブジェクト
/**
 * Recent_Posts widget w/ category exclude class
 * This allows specific Category IDs to be removed from the Sidebar Recent Posts list
 *
 */
class WP_Widget_Recent_Posts_Exclude extends WP_Widget {
	function __construct() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "The most recent posts on your site") );
		parent::__construct('recent-posts', __('Recent Posts with Exclude'), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array(&$this, 'flush_widget_cache') );
		add_action( 'deleted_post', array(&$this, 'flush_widget_cache') );
		add_action( 'switch_theme', array(&$this, 'flush_widget_cache') );
	}

	function widget($args, $instance) {
		$cache = wp_cache_get('widget_recent_posts', 'widget');

		if ( !is_array($cache) )
			$cache = array();

		if ( ! isset( $args['widget_id'] ) )
			$args['widget_id'] = $this->id;

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();
		extract($args);

		$title = apply_filters('widget_title', empty($instance['title']) ? __('Recent Posts') : $instance['title'], $instance, $this->id_base);
		if ( empty( $instance['number'] ) || ! $number = absint( $instance['number'] ) )
 			$number = 10;
 		$exclude = empty( $instance['exclude'] ) ? '' : $instance['exclude'];
		if($exclude==''){
		$r = new WP_Query(array(
		'posts_per_page' => $number,
		'no_found_rows' => true,
		'post_status' => 'publish', 
		'order'=>'DESC',
		'orderby'=>'date'
		)
		);
		}else{
		$r = new WP_Query(array(
		'posts_per_page' => $number,
		'no_found_rows' => true,
		'post_status' => 'publish', 
		'category__not_in' => explode(',', $exclude),
		'order'=>'DESC',
		'orderby'=>'date'
		)
		);
		}
		if ($r->have_posts()) :
?>
		<?php //echo print_r(explode(',', $exclude)); ?>
		<?php echo $before_widget; ?>
		<?php if ( $title ) echo $before_title . $title . $after_title; ?>
		<ul>
		<?php  while ($r->have_posts()) : $r->the_post(); ?>
		<li><a class="post_list" href="<?php the_permalink() ?>" title="<?php echo esc_attr(get_the_title() ? get_the_title() : get_the_ID()); ?>"><?php if ( get_the_title() ) the_title(); else the_ID(); ?></a><time datetime="<?php the_time('c'); ?>" pubdate="pubdate"><?php the_time('Y年m月d日（D）H時i分') ?></time></li>
		<?php endwhile; ?>
		</ul>
		<?php echo $after_widget; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		$cache[$args['widget_id']] = ob_get_flush();
		wp_cache_set('widget_recent_posts', $cache, 'widget');
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['exclude'] = strip_tags( $new_instance['exclude'] );
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	function form( $instance ) {
		$title = isset($instance['title']) ? esc_attr($instance['title']) : '';
		$number = isset($instance['number']) ? absint($instance['number']) : 5;
		$exclude = esc_attr( $instance['exclude'] );
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('Number of posts to show:'); ?></label>
		<input id="<?php echo $this->get_field_id('number'); ?>" name="<?php echo $this->get_field_name('number'); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>
		
		<p>
			<label for="<?php echo $this->get_field_id('exclude'); ?>"><?php _e( 'Exclude Category(s):' ); ?></label> <input type="text" value="<?php echo $exclude; ?>" name="<?php echo $this->get_field_name('exclude'); ?>" id="<?php echo $this->get_field_id('exclude'); ?>" class="widefat" />
			<br />
			<small><?php _e( 'Category IDs, separated by commas.' ); ?></small>
		</p>
<?php
	}
}

function WP_Widget_Recent_Posts_Exclude_init() {
    unregister_widget('WP_Widget_Recent_Posts');
    register_widget('WP_Widget_Recent_Posts_Exclude');
}

add_action('widgets_init', 'WP_Widget_Recent_Posts_Exclude_init');

/*アイキャッチ周り*/
add_theme_support( 'post-thumbnails', array( 'post' ) );
set_post_thumbnail_size( 150, 150, true );

/*小カテゴリーでも親カテゴリーのテンプレートを利用できるプラグイン*/
add_filter( 'category_template', 'my_category_template' );

function my_category_template( $template ) {
	$category = get_queried_object();
	if ( $category->parent != 0 &&
		( $template == "" || strpos( $template, "category.php" ) !== false ) ) {
		$templates = array();
		while ( $category->parent ) {
			$category = get_category( $category->parent );
			if ( !isset( $category->slug ) ) break;
			$templates[] = "category-{$category->slug}.php";
			$templates[] = "category-{$category->term_id}.php";
		}
		$templates[] = "category.php";
		$template = locate_template( $templates );
	}
	return $template;
}

/*ページングをカスタマイズ*/
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
function posts_link_attributes(){
	return 'class="btn btn-inverse"';
}
/*概要カスタマイズ*/
function new_excerpt_length($length) {	
     return 60;	
}	
add_filter( 'excerpt_length', 'new_excerpt_length', 999 );

/*フッターナビゲーション*/
//カスタムメニュー
register_nav_menus(array(
	'foot_navigation' => 'フッターナビ'
	));

/*ビジュアルエディタカスタマイズ*/
function my_theme_add_editor_styles() {
    add_editor_style( 'style.css' );
}
add_action( 'init', 'my_theme_add_editor_styles' );

function custom_editor_settings( $initArray ){
	$initArray['body_class'] = 'entry-content edit_admin';
	return $initArray;
}
add_filter( 'tiny_mce_before_init', 'custom_editor_settings' );

//JetPackカスタム投稿タイプサポート
add_action('init', 'my_custom_init');
function my_custom_init() {
    add_post_type_support( 'product', 'gallery' );
}
//画像サイズジェネレーション/
add_image_size( 'maxpege', 920, 9999 );
add_image_size( 'inyou_maxpege', 768, 9999 );
add_image_size( 'gallery_icon',225, 225,true );
add_image_size( 'gallery_icon_sub',55, 55,true );
add_image_size( 'product_icon_sub',220, 300,true);
add_image_size( 'product_logo',330,9999);

//親子判定
function is_subpage() {
	global $post;                                 // $post には現在の固定ページの情報があります
        if ( is_page() && $post->post_parent ) {      // 現在の固定ページが親ページを持つかどうかをチェックします
               return $post->post_parent;                      // 親ページの ID を返します
        } else {                                      // 親ページを持たないので...
               return false;                          // ...false を返します
        };
};

//galleryアーカイブのカスタマイズ
function gallery_archive_filter($query){
	if(!is_admin() && $query->is_main_query() && $query->is_archive() && $query->is_tax('gallery_ct')){
	$query->set( 'posts_per_page', '9' );
	}
	if(!is_admin() && $query->is_main_query() && $query->is_archive() && $query->is_post_type_archive('product')){
		$query->set( 'post_parent', '0' );
		$query->set( 'depth', '1' );
		$query->set( 'orderby', 'menu_order' );
		$query->set( 'order', 'ASC' );


	}
	if(!is_admin() && $query->is_main_query() && $query->is_archive() && $query->is_post_type_archive('event')){
		$query->set( 'orderby', 'meta_value' );
		$query->set( 'meta_key', 'イベント開催期間_参加日' );
		$query->set( 'order', 'DESC' );
	}
	return $query;
}
add_action('pre_get_posts', 'gallery_archive_filter');

//祖先を探る
function ps_get_root_page( $cur_post, $cnt = 0 ) {
	if ( $cnt > 100 ) { return false; }
	$cnt++;
	if ( $cur_post->post_parent == 0 ) {
		$root_page = $cur_post;
	} else {
		$root_page = ps_get_root_page( get_post( $cur_post->post_parent ), $cnt );
	}
	return $root_page;
}
//先祖までロゴを探る

function ps_get_logo_treasure( $cur_post, $cnt = 0 ) {
	if ( $cnt > 100 ) { return false; }
	$cnt++;
	if ( $cur_post->post_parent == 0 && !get_post_meta($cur_post->ID,'ロゴ')) {
		return false;
	}else{
		if(get_post_meta($cur_post->ID,'ロゴ')){
			$root_img = get_post_meta($cur_post->ID,'ロゴ');
		}else{
			$root_img = ps_get_logo_treasure( get_post( $cur_post->post_parent ), $cnt );
		}
	
	}
	return $root_img;
}
//タグクラウド'gallery用'
function gallery_tax_tag_cloud_filter( $args = array() ){
	if($args['taxonomy'] == 'gallery_ct'){
		$args['exclude'] = '69';
	}
	return $args;
}
add_filter('widget_tag_cloud_args', 'gallery_tax_tag_cloud_filter');

// カスタム投稿時、wp_list_pages() に current_page_item を付与 
function kct_page_css_class( $css_class, $page, $depth, $args, $current_page ) {
	if ( !isset($args['post_type']) || !is_singular($args['post_type']) )
		return $css_class;
	global $post;
	$current_page  = $post->ID;
	$_current_page = $post;
	_get_post_ancestors($_current_page);
	if ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) )
		$css_class[] = 'current_page_ancestor';
	if ( $page->ID == $current_page )
		$css_class[] = 'current_page_item';
	elseif ( $_current_page && $page->ID == $_current_page->post_parent )
		$css_class[] = 'current_page_parent';
	return $css_class;
}
add_filter( 'page_css_class', 'kct_page_css_class', 10, 5 );

add_filter('redirect_canonical','my_disable_redirect_canonical');
function my_disable_redirect_canonical($redirect_url) {
	if ( is_single() ){
		$subject = $redirect_url;
		$pattern = '/\/page\//'; // URLに「/page/」があるかチェック
		preg_match($pattern, $subject, $matches);

		if ($matches){
		//リクエストURLに「/page/」があれば、リダイレクトしない。
		$redirect_url = false;
		return $redirect_url;
		}
	}
}
/**
 * WordPress の TinyMCE エディタで meta, style, link など使えるようにする
 *
 * @author    hayashikejinan
 * @copyright Copyright (c) 2014, hayashikejinan
 * @link      http://hayashikejinan.com/?p=1184
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 *
 * @param $settings
 *
 * @return mixed
 */
function additional_tags_for_tiny_mce( $settings ) {
    if ( ! empty( $settings['valid_children'] ) ) {
        $settings['valid_children'] .= ';';
    } else {
        $settings['valid_children'] = '';
    }
 
    $settings['valid_children'] .= '+body[link|meta|style],+div[span|meta],+span[span|meta]';
 
    return $settings;
}
 
//アップロード制限を解除
function custom_mime_types( $mimes ) {
	$mimes['zip'] = 'application/zip';
	return $mimes;
}
add_filter( 'upload_mimes', 'custom_mime_types' );
add_filter( 'tiny_mce_before_init', 'additional_tags_for_tiny_mce' );
?>