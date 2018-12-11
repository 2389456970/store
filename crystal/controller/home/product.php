<?php
$pid = empty($_GET['cate_id']) ? '35' :$_GET['cate_id'];
$sql = "select name from category where id = $pid";
$cate_tit = select_one($sql);

$sql = "select * from category where cate_id=26";
$product_menu = select_list($sql);


$page = empty($_GET['page'])? 1 : $_GET['page'];
$num = 6;
$start_page = $num*($page-1);
//总条数
$sql = "select * from product where cate_id={$pid} order by id desc limit $start_page,$num";
$product = select_list($sql);
foreach ($product as $key => $value) {
	$str = strip_tags(htmlspecialchars_decode($value['content']));
	$product[$key]['content']=mb_substr($str,0,100,'utf-8').'......';
}
//上一页
$prev = $page>1 ?$page-1 : 1;
//总条数
$sql = "select count(id) as count from product where cate_id={$pid}";
$total = select_one($sql);
//总页数
$page_total = ceil($total['count']/$num);
//下一页
$next = ($page < $page_total and $page > 0)? $page + 1 : $page_total;

require_once "common.php";
