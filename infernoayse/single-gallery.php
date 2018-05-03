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
if($post->post_parent){
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
		get_template_part('gallery','children');
	}else{
		get_template_part('gallery','r18regist');
	}
}else{
	get_template_part('gallery','parent');
}
?>
