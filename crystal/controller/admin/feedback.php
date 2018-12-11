<?php
if($act == 'index'){
	 //加载页面之前，先处理业务逻辑
	$sql = "select * from feedback order by id desc";
	$data = select_list($sql);
	$total = "select count(id) from feedback";
	$total_value = select_list($total);
	foreach ($data as $key => $value) {
		$data[$key]['time'] = date('Y-m-d',$value['time']);
		$str =strip_tags($value['message']);
		$len =mb_strlen($str,'utf-8');
		if ($len>50) {
			$data[$key]['message']=mb_substr($str,0,50,'utf-8');
		}
	}
     require_once(VIEW.DS.$mol.DS.$ctl.DS.$act.HTL);
}

else if($act == 'del'){
	$id = intval($_POST['id']);
	$sql = "delete from feedback where id=$id";
	$result = del($sql);
	if ($result) {
		$arr = ['code'=>2,'msg'=>'删除成功'];
		exit(json_encode($arr));
	}else{
		$arr = ['code'=>1,'msg'=>'删除失败'];
		exit(json_encode($arr));
	}
}
else if($act == 'alldel'){
	$id = $_POST['ids'];
	// var_dump($id);die;
	$sql = "delete from feedback where id in ({$id})";
	$result = del($sql);
	if ($result) {
		$arr = ['code'=>2,'msg'=>'删除成功'];
		exit(json_encode($arr));
	}else{
		$arr = ['code'=>1,'msg'=>'删除失败'];
		exit(json_encode($arr));
	}
}
