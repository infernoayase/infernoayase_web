// JavaScript Document
(function($){
	$(document).ready(function(e) {
		if(typeof(pege_nam) == "undefined"){
			pege_nam=0
			}
		if(pege_nam==0 && jQuery.cookie('pageng')=='null'){
			matrix = {
				0:[-1200,-1200,1],
				1:[0,-1200,1],
				2:[1200,-1200,1],
				3:[-1200,0,1],
				4:[0,0,0],
				5:[1200,0,1],
				6:[-1200,1200,1],
				7:[0,1200,1],
				8:[1200,1200,1],
				9:[-1200,2400,2],
				10:[0,2400,2],
				11:[1200,2400,2]
				}
			$('article.gallery_posts_listtiep').each(function(index, element) {
				$(element).addClass('x10s').css('left',matrix[index][0]).css('top',matrix[index][1]);	
			});
			$(window).load(function(e) {
				var reset_0 = function(ob){
					$ob = $(ob);
					$ob.addClass('animate_gallery').removeClass('x10s').css('left',0).css('top',0);
					}
				$('article.gallery_posts_listtiep').each(function(index, element) {
					var e = this;
					setTimeout(function(){reset_0(e); },matrix[index][3]*200);
				});
			});		
		}else if(!jQuery.cookie('pageng')!='null'){
			if(pege_nam>$.cookie('old_pageng')){
				$('.archive_gallery').css('left','1000px').css('opacity',0);
			}else if(pege_nam<$.cookie('old_pageng')){
				$('.archive_gallery').css('left','-1000px').css('opacity',0);
			}
			$('.archive_gallery').addClass('animate_gallery');
			$(window).load(function(e) {
						$('.archive_gallery').css('left','0').css('opacity',1);
			});
			
			$.cookie('pageng',null,{path:'/'});
		}
		
		if($('#blackout_wap.bacondemand').length){
			$(window).load(function(e) {
				$('#blackout_wap').fadeOut(300);				
			});
		}else{
			$('#blackout_wap').fadeOut(0);
		}
		$('.icon_links').click(function(event){
			$(this).addClass('g_link_ed');
			var $query =$(this);
			if(event.ctrlKey || event.shiftKey){
			$query.new_window = true;
			}
			setTimeout(function(){g_goto_tha_anime($query);},300);
			$('#blackout_wap').fadeIn(300);
			return false;			
			});
			
			var g_goto_tha_anime = function(query){
				var $a = query;
				url = $a.attr('href');
				if($a.new_window){
				window.open(url);
				}else{
				window.location = url;
				}
			};
		$('#next_post a,#prev_post a').click(function(e) {
			$.cookie('old_pageng',pege_nam,{path:'/'});
			$.cookie('pageng',true,{path:'/'});
			var bottons = $(this).parent().attr('id');
			var $ob = $(this);
			
			if(bottons == 'next_post'){
				$('.archive_gallery').addClass('animate_gallery').css('left','1000px').css('opacity',0);
			}else{
				$('.archive_gallery').addClass('animate_gallery').css('left','-1000px').css('opacity',0);
			}
			$('#blackout_wap').fadeIn(300);
			setTimeout(function(){g_goto_tha_anime($ob);},200);
			var g_goto_tha_anime = function(query){
				var $a = query;
				url = $a.attr('href');
				if($a.new_window){
				window.open(url);
				}else{
				window.location = url;
				}
			};
		});
	});
	})(jQuery);
	