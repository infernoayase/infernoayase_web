// JavaScript Document
(function(jQuery){
jQuery(document).ready(function(e) {
pixiv_load();	
});
})(jQuery);

function pixiv_load(){
	if(!Array.indexOf){
	Array.prototype.indexOf = function(target){
	for(var i = 0; i < this.length; i++){
	if(this[i] === target){ 
	return i;
	}
	}
	return -1;
	}
	}

	jQuery('.gallery_tax .pixiv_pedia').children('i').addClass('op05');
	if(typeof jQuery.cookie('tag') == 'undefined'){
		tag_array =Object();
		}else{
		tag_array =JSON.parse(jQuery.cookie('tag'));
		}
	jQuery('.gallery_tax .pixiv_pedia').each(function(index, element) {
		try {
				var test = tag_array[jQuery(this).attr('data')]['cmp'];
			}
			catch (e) {
				tag_array[jQuery(this).attr('data')] = {
				cmp:-1,
				url:jQuery(this).attr('href')
				};
			}
		if(tag_array[jQuery(this).attr('data')]['cmp'] == 1){
				jQuery(this).children('i').removeClass('op05');
			}else if(tag_array[jQuery(this).attr('data')]['cmp'] == -1){
				jQuery.ajax({
					url:tag_array[jQuery(this).attr('data')]['url'],
					type:'GET',
					objects:jQuery(this),
					success: function(data){
						var jQueryob = this.objects;
						if(jQuery(data.responseText).find('.summary').text().indexOf('このタイトルの記事は、まだ作成されていません。') == -1){
								tag_array[jQueryob.attr('data')]['cmp'] = 1;
								jQueryob.children('i').removeClass('op05');
							}else{
								tag_array[jQueryob.attr('data')]['cmp'] = 0;
							}
							jQuery.cookie('tag',JSON.stringify(tag_array),{path:'/',expires:2})
						}});
				
			}
});
}