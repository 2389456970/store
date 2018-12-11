<?php

include('model/init.php');
$mol = empty($_GET['m'])?'admin':$_GET['m'];
$ctl = empty($_GET['ctl'])?'index':$_GET['ctl'];
$act = isset($_GET['act'])?$_GET['act']:'index';

if ($mol=='admin' &&$ctl!='login') {
	check_login();
}
// include "controller/admin/news.php";
// include "controller/admin/pro.php";
// 

// echo CITL;

$file_path = CITL.DS.$mol.DS.$ctl.EXT;

// echo $file_path;
// echo "</br>";

if (file_exists($file_path)) {
	include $file_path;
}
else{
	echo "没有这个文件";
}