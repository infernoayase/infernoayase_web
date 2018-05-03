<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @subpackage infernoayase_Theme
 * @since infernoayse
 */
?>
<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=1200" />
<link href="https://plus.google.com/117357271253028258879" rel="publisher" />
<title>
<?php wp_title('|', true, 'right'); ?>
<?php bloginfo('name'); ?>
</title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php // Loads HTML5 JavaScript file to add support for HTML5 elements in older IE versions. ?>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<!--JSLibrary-->
<?PHP
wp_enqueue_script( 'jquery' );
wp_enqueue_script('jquery-ui-1.8.9', get_bloginfo('template_url').'/js/jquery-ui-1.10.3.custom.min.js', array('jquery'), '1.10.3');
wp_enqueue_script('jquery-cookie-1.3.1', get_bloginfo('template_url').'/js/jquery.cookie.js', array('jquery'), '1.3.1');
wp_enqueue_script( 'jquery-xdomainajax', get_stylesheet_directory_uri() . '/js/jquery.xdomainajax.js',array('jquery'));
wp_enqueue_style('jquery-ui-1.8.9', get_bloginfo('template_url').'/css/dark-hive/jquery-ui-1.10.3.custom.css');
wp_enqueue_script( 'backstretch', get_stylesheet_directory_uri() . '/js/jquery.backstretch.min.js' );
wp_enqueue_script( 'champagne', get_stylesheet_directory_uri() . '/js/jquery.champagne.js' );

wp_enqueue_script( 'customJS', get_stylesheet_directory_uri() . '/js/custom.js' );
$options =  get_option('custombackground_options');
?>
<?php wp_head(); ?>
<script type="text/javascript" src="//use.typekit.net/lha7tib.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<script type="text/javascript">
var dcDirectory = '<?PHP echo get_stylesheet_directory_uri(); ?>';

jQuery( function () {
	jQuery.backstretch([<?php
	 foreach($options as $key=>$val){
		 $res .= "'" .$val . "'," ;
	}
	echo substr($res, 0, -1);
?>],{duration: 6000, fade: 2000});
});
</script>

</head>
<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.7";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div id="header_wap">
		<header id='root_header' class="clearfix">
				<hgroup>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><h1 class="site-title"><?php bloginfo( 'name' ); ?></h1></a>
				<h2><?php bloginfo( 'description' ); ?></h2>
				</hgroup>
				<nav>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
				</nav>
		</header>
		</div>
