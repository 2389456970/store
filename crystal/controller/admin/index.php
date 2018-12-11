<?php

if($act =='index'){
   $sql = "select * from category where cate_id=1 and is_show=1";
   $res = select_list($sql);
   foreach ($res as $key => $value) {
   	    $sql = "select * from category where cate_id={$value['id']} and is_show=1";
   	    $result = select_list($sql);
   	    foreach ($result as $k => $v) {
   	    	$result[$k]['url_path'] = 'index.php?m=admin&'.$v['url_path'];
   	    }
   	    $res[$key]['next']=$result;
   }
	// print_r($res);die;
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	// echo $file;
	include $file;
}

elseif ($act == 'welcome') {
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
// include "view/admin/index/index.html";
// include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;