
//footer链接宽高获取1
	var $navli_wd=parseInt($('.footer .nav li').css('width'));
	// alert($navli_wd);
	var $navli_num=$('.footer .nav li').length;
	var $navli_bord_wd=parseInt($('.footer .nav li').css('border-right-width'));
	var $nav_wd=$navli_wd*$navli_num+$navli_bord_wd*($navli_num-1)+10+'px';
	// alert($nav_wd);
	$('.footer .nav').css('width',$nav_wd);
	//footer链接宽高获取2
	$('.footer .tel li').eq(0).css('padding','0px 27px')
	var $tel_li_wd1=parseInt($('.footer .tel li').eq(0).css('width'));
	var $telli_pdl1=parseInt($('.footer .tel li').eq(0).css('padding-left'));
	var $telli_pdr1=parseInt($('.footer .tel li').eq(0).css('padding-right'));
	var $telli_wd1=$tel_li_wd1+$telli_pdl1+$telli_pdr1;	
	var $tel_li_wd2=parseInt($('.footer .tel li').eq(1).css('width'));
	var $telli_pdl2=parseInt($('.footer .tel li').eq(1).css('padding-left'));
	var $telli_pdr2=parseInt($('.footer .tel li').eq(1).css('padding-right'));
	var $telli_wd2=$tel_li_wd2+$telli_pdl2+$telli_pdr2;	
	var $tel_li_wd3=parseInt($('.footer .tel li').eq(2).css('width'));
	var $telli_pdl3=parseInt($('.footer .tel li').eq(2).css('padding-left'));
	var $telli_pdr3=parseInt($('.footer .tel li').eq(2).css('padding-right'));
	var $telli_wd3=$tel_li_wd3+$telli_pdl3+$telli_pdr3;
	var $telli_num=$('.footer .tel li').length;
	var $telli_bord_wd=parseInt($('.footer .tel li').css('border-right-width'));
	var $tel_wd=$telli_wd1+$telli_wd2+$telli_wd3+$telli_bord_wd*($telli_num-1)+10+'px';
	$('.footer .tel').css('width',$tel_wd)
	//选择器

	$('.footer .nav li:last-child').css('border','0px');
	$('.footer .tel li:last-child').css('border','0px');
	

	$banner_list_wd=parseInt($('.banner').css('width'));
	
	//page获取宽度
    var $page_li_wd=parseInt($('.page li').css('width'))+2;
    var $page_li_num=$('.page li').length;
    var $page_wd=$page_li_num*$page_li_wd+'px';
    $('.page').css('width',$page_wd);
	//contact
    $('.msg li:last-child').css({'padding-left':'98px','padding-top':'11px'});
	
	//index
//	高
	var $textarea_hg=$('.contact .contact_main .right .textarea_box').css('height');
	var $stextarea_hg=parseInt($textarea_hg)-19+'px';
	$('.contact .main .right .textarea_box textarea').css('height',$stextarea_hg);
	$('.contact .main .tel li:first-child').css('margin-bottom','47px');
	$('.contact .main .tel li').eq(1).css('margin-bottom','37px');
	$('.contact .main .right ul li').eq(2).css('width','100%');
	$('.contact .main .right ul li').eq(2).css('margin-top','32px');
	$('.contact .main .right ul li').eq(1).css('float','right');
//banner_list ul宽度获取及定位中部
//宽度获取
$('.banner .banner_list li').eq(0).css('margin-left',0);
var $banner_list_li_wd=parseInt($('.banner .banner_list li').css('width'));
var $banner_list_li_ml=parseInt($('.banner .banner_list li:last-child').css('margin-left'));
var $banner_list_li_num=$('.banner .banner_list li').length;
var $banner_list_wd=$banner_list_li_num*$banner_list_li_wd+$banner_list_li_ml*($banner_list_li_num-1)+'px';
$('.banner .banner_list').css('width',$banner_list_wd);
//定位中部

$banner_img_wd=parseInt($('.banner').css('width'));
var $banner_list_wd=parseInt($('.banner .banner_list').css('width'));
$banner_list_left=($banner_img_wd-$banner_list_wd)/2;
$('.banner .banner_list').css('left',$banner_list_left);

$('.msg ul li').eq(4).children('input').css({"width":"100px","margin-left":"5px","height":"38px","line-height":"38px","font-size":"20px"})
$('.msg ul li').eq(4).children('label').css('margin','0px')
$('.msg ul li').eq(4).children('a').css('display','inline-block')

//about
$('.text img').eq(0).css('float','left');
$('.text img').eq(1).css('float','right');
