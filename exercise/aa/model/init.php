<?php
//基本设置
 header('content-type:text/html;charset=utf-8');
 date_default_timezone_set('PRC');//中国时区
//设置controller路径的常量date_default_timezone_set('PRC');//中国时区
define('DS','/');
define('EXT','.php');
//设置控制器常量
define('CITL','controller');
define('C_PATH','controller'.DS.'admin'.DS);

//数据库配置
define('HOST','127.0.0.1');//地址
define('USER','root');//数据库账号
define('PASSWORD','root');//数据库密码
define('DBNAME','exercise');//数据库名
define('CHARSET','utf8');//编码
//设置前端view文件路径
define('VIEW','view');
//设置view的文件路径
define('PUBLICS','public'.DS.'admin'.DS);
//html的自定义
define('HTL','.html');

include "fun.php";  
include "model/db.php";
db();

