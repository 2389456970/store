<?php
header('content-type:text/html;charset=utf-8');
date_default_timezone_set('PRC');
session_start();

define('CITL','controller');

define('DS', '/');
define('EXT','.php');

define('C_PATH', 'controller'.DS.'admin'.DS);
define('FONTS','font'.DS);
//前端资源地址
define('HOME','public'.DS.'home'.DS);

define('HOST','127.0.0.1',false);
define('USER','root');
define('PASSWORD','root');
define('DBNAME','crystal');
define('CHARSET','utf8');


include('fun.php');
include('db.php');

db();
// check_login();
//view 路径
define('VIEW', 'view');
define('PUBLICS', 'public'.DS.'admin'.DS);
define('HTL','.html');

//upload路径
define('UPLOAD', 'upload'.DS);



