<?php
if ($act == 'index') {
	// $sql ="select * from category where cate_id=1 and is_show=1";
	// $result =select_list($sql);
	// // print_r($result);die;/
	// foreach ($result as $key => $value) {
	// 	$sql ="select * from category where cate_id={$value['id']} and is_show=1";
	// 	$result =select_list($sql);
	// 	foreach ($result as $key => $v) {
	// 		$result[$key]['url_path']='index.php?m=admin&'.$v['url_path'];
	// 	}
	// 	$result[$key]['next'] =$result;

	// }
    $file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    // echo $file;
    include $file;
 
}
elseif($act == 'welcome'){
    $file =VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
}
 