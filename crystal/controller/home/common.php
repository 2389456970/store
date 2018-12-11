<?php
$sql = "select * from logo";
$logo = select_list($sql);

$sql =" select * from category where cate_id=2";
$menu = select_list($sql);

switch ($ctl) {
	case 'index':
		$bid = 16;
		$title = '首页';
	break;
	case 'about':
		$bid = 24;
		$title ='公司介绍';
	break;
	case 'news':
		$bid = 25;
		$title ='国内旅游';
	break;
	case 'product':
		$bid = 26;
		$title ='境外旅游';
	break;
	case 'contact':
		$bid = 27;
		$title ='联系我们';
	break;
}
$sql = "select * from pic where cate_id={$bid}";
$pic = select_list($sql);
// $sql = "select * from category where cate_id=2";

require_once(VIEW.DS.$mol.DS.'header'.HTL);
require_once(VIEW.DS.$mol.DS.$ctl.HTL);
require_once(VIEW.DS.$mol.DS.'footer'.HTL);