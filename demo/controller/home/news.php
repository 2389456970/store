<?php 
// ob_start();//开启缓存
// $file = "view/rbm/output00001.html";
// if(file_exists($file)){
//     require_once("view/rbm/output00001.html");//缓存文件
//     exit;
// }


$pid = empty($_GET['cate_id'])? 35:$_GET['cate_id'];
// echo $pid;
//新闻分类菜单 表category
$sql = "select * from category where cate_id = 33";
$news_menu = select_list($sql);
//分类标题 class="title"
$sql ="select name from category where id = $pid ";
$cate_tit =select_one($sql);
//新闻列表数据 表 news cate_id = $pid
$sql = "select * from news where cate_id={$pid} order by id desc";
// echo $sql;die;
$news = select_list($sql);
// echo $news;die;
// print_r($news_menu);die;


//分页 
//select * from news where cate_id={$pid} limit起始页，一页多条数据 order by id desc ;
//$page页码
$page = empty($_GET['page'])? 1 :$_GET['page'];

$num =10;
//第一页page=1  0-9  第二页 page=2  10-19  第三页page=3    20-29
$start_page = $num*($page-1);

$sql = "select * from news where cate_id={$pid} order by id desc limit $start_page,$num";
$news =select_list($sql);
// echo "<pre>";
// print_r($re);die;
//页码跳转
//上一页
$prev = $page>1 ? $page-1 : 1 ; //大于一就按上一页就会跳转
//总条数
$sql ="select count(id) as count  from news where cate_id={$pid}";
$total = select_one($sql);
// var_dump($total);die;
//总页数
$page_total =ceil($total['count']/$num) ; //10/3 = 3 1 ceil() 3.3 4 向上取值
//下一页
$next =($page < $page_total and $page >0 )? $page+1 : $page_total;
// echo $next;die;
require_once "common.php"; 
/*
ob_start();开启缓存
 
*/ 

// $content =ob_get_content();
// $fp = fopen("view/rbm/output00001.html","w"); //I/o创建一个文件，并打开，准备写入  如果文件不存在会生成新的文件,w写入读取，r读取。
// fwrite($fp, $content); //把php页面的内容全部写入output00001.html，然后。。。
// fclose($fp);//关闭文件
