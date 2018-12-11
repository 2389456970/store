<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');//中国时区
session_start();  //在这里开启session 就会为所有有session的的控制器开启
//路径  controller
define('CITL','controller');

define('DS','/');

define('EXT','.php');

//路径 view
define('VIEW','view');
define('PUBLICS','public'.DS.'admin'.DS);
define('HTL','.html');
define('C_PATH','controller'.DS.'admin'.DS); //admin控制器的路径的常量
define('DE','upload'.DS);

//数据库配置

// 初始化配置

define('HOST','127.0.0.1');  //地址，域名

define('USER','root'); //数据库帐号


define('PASSWORD','root'); //数据库密码

define('DBNAME','lzj'); //数据库名

define('CHARSET','utf8'); //编码

//设置home前端项目路径

define('HOME','public'.DS.'home'.DS);





include "fun.php";

include "model/db.php";

db();





