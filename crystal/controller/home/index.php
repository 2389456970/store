<?php

$sql = "select * from about where cate_id=31";
$about = select_one($sql);
$str =strip_tags(htmlspecialchars_decode($about['content']));
$len =mb_strlen($str,'utf-8');
$about['content']=mb_substr($str,0,115,'utf-8').'......';


$sql = "select * from news  order by id desc limit 4";
$news = select_list($sql);
foreach ($news as $key => $value) {
	$str = strip_tags($value['title']);
	$len =mb_strlen($str,'utf-8');
	if ($len>30) {
		$news[$key]['title']=mb_substr($str,0,30,'utf-8').'......';
	}
	$str2 =strip_tags(htmlspecialchars_decode($value['content']));
	$len2 =mb_strlen($str2,'utf-8');
	// echo $len2;die;
	if ($len2>150) {
		$news[$key]['content']=mb_substr($str2,0,150,'utf-8').'......';
	}
	
}

$sql = "select * from product order by id desc limit 3";
$product = select_list($sql);
foreach ($product as $key => $value) {
	$str = strip_tags(htmlspecialchars_decode($value['content']));
	$len =mb_strlen($str,'utf-8');
	if ($len > 80) {
		$product[$key]['content']=mb_substr($str,0,80,'utf-8').'......';
	}

}

$sql = "select * from contact";
$contact = select_list($sql);



require_once "common.php";