// JavaScript Document
jQuery(window).ready(function() {
	/*DOM構築後描写前の処理*/
	ui_init();
	
	/*Mozillaハック*/
	if(jQuery.browser.mozilla){
	jQuery('.entry-title').children().andSelf().contents().each(function() {
		if (this.nodeType == 3) {
			jQuery(this).replaceWith(jQuery(this).text().replace(/(-|ー|～|…)/, "<span class='moz_baka_rot'>$&</span>"));
		}
	});		
	}

	jQuery(".fade").champagne();
});

jQuery(window).load(function() {
	/*描写後の処理*/
	jQuery('.nav-menu>li').not('.current-menu-item').each(function(index, element) {
			castamu_animes_1(index, element);
	});
	i_browserchecker();
});

function castamu_animes_1(i, element){
	setTimeout(function(){
			jQuery(element).addClass('current-menu-item');
		},i*100);
	setTimeout(function(){
			jQuery(element).removeClass('current-menu-item');
		},(i*100)+500);		
	}

function i_browserchecker(){
var $ = jQuery;
var d_op ={
	autoOpen:false,
	closeOnEscape:false,
	show:'slide',
	hide:'slide',
	width:'320px',
	buttons: {
        "しばらく表示しない": function(event) {
            //「はい」を押したときに実行される処理
			$.cookie('browser_warning',true);
			$('#browserdialog').dialog("close");		
        	}
		}
	};
var opr = 1;
var html ='';

	if(!$.cookie('browser_warning')){
		if($.browser.msie && parseFloat(jQuery.browser.version) > 8 && parseFloat(jQuery.browser.version) < 10 ){
			//IE9向けのダイアログ
			html += '<img src="' + dcDirectory + '/images/browser_lite.png"  usemap="#browser_maps"/><p>簡易グラフィックスモードで表示中です。<br>最新のグラフィックス体験と安全なインターネットのために<br>ブラウザの変更を検討ください。</p>';			
			html += '<map name="browser_maps" id="browser_maps">';
			html += '<area shape="rect" coords="4,29,65,96" href="http://www.google.co.jp/intl/ja/chrome/" target="_blank" />';
			html += '<area shape="rect" coords="73,29,145,97" href="http://www.mozilla.jp/firefox/" target="_blank" />';
			html += '<area shape="rect" coords="155,28,222,96" href="http://support.apple.com/kb/DL1531?viewlocale=ja_JP" target="_blank" />';
			html += '<area shape="rect" coords="227,28,296,96" href="http://windows.microsoft.com/ja-jp/internet-explorer/ie-10-worldwide-languages" target="_blank" />';
			html += '</map>';
			$('#browserdialog').html(html);
			d_op.autoOpen = true;
			d_op.show = 'slideDown';
			d_op.hide = 'slideUp'
			d_op.position ='left bottom';
			opr = 0.7;
			}else if($.browser.msie && parseFloat(jQuery.browser.version) < 9){
			//IE9以下
			html += '<img src="' + dcDirectory + '/images/browser_cotion.png"  usemap="#browser_maps"/><p style="font-size:15px">ご利用のブラウザが古いです。<br>セキュリティ上の脆弱性やパフォーマンスの観点から早急に最新ブラウザへアップグレード。<br>※尚、当サイトはIE8以下のブラウザで正常な表示をサポートいたしません。</p>';			
			html += '<map name="browser_maps" id="browser_maps">';
			html += '<area shape="rect" coords="18,124,125,231" href="http://www.google.co.jp/intl/ja/chrome/" target="_blank" />';
			html += '<area shape="rect" coords="162,118,278,234" href="http://www.mozilla.jp/firefox/" target="_blank" />';
			html += '<area shape="rect" coords="314,117,428,231" href="http://support.apple.com/kb/DL1531?viewlocale=ja_JP" target="_blank" />';
			html += '<area shape="rect" coords="470,124,579,233" href="http://windows.microsoft.com/ja-jp/internet-explorer/ie-10-worldwide-languages" target="_blank" />';
			html += '</map>';
			$('#browserdialog').html(html);
			d_op.autoOpen = true;
			d_op.show = 'slideDown';
			d_op.hide = 'slideUp'
			d_op.position ='center';
			d_op.width = '620px';
			d_op.modal = true;
			opr = 1;
			
		}
	}
/*ダイアログの初期化*/
$('#browserdialog').dialog(d_op);
$('.ui-dialog').css('opacity',opr);

if(opr<1){
setTimeout(function(){$('#browserdialog').dialog("close");},10000);
}
}

function ui_init(){
	var $ = jQuery;
	/*ボタン周り初期化*/
	$("input[type=submit]").button();

}