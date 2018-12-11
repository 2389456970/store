<?php
//设置路由规则
include('model/init.php');//加载初始化配置

$mol =empty($_GET['m'])? 'admin':$_GET['m'];//模块 admin home
$ctl =empty($_GET['ctl'])? 'index': $_GET['ctl'];//控制器  文件

//index的自定义路径
$act =isset($_GET['act']) ? $_GET['act'] :'index';//控制器里的分支控制

// include "CTL/admin/index.php";
//连接controller里面的文件
$file_path = CITL.DS.$mol.DS.$ctl.EXT;
if (file_exists($file_path)) {
   include $file_path;
}else{
    echo "对不起，主人，我找不到。嘤嘤嘤！！！";
}