<?php
$pid = empty($_GET['cate_id']) ? '31' :$_GET['cate_id'];
// echo $pid;
//新闻分类菜单 表category

//分类标题 class="tittle"
$sql = "select name from category where id = $pid";
$cate_tit = select_one($sql);

$sql = "select * from category where cate_id=24";
$about_menu = select_list($sql);
//新闻列表数据 表news cate_id
$sql = "select * from about where cate_id={$pid} order by id desc";
$about = select_list($sql);
require_once "common.php";