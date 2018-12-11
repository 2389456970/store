<?php
if ($act=='index') {
	$sql = "select * from contact order by id desc"; //倒斜查询
    $result = select_list($sql);
    $total = "select count(id) from contact";
	$total_value = select_list($total);
    foreach ($result as $key => $value) {
		$result[$key]['time'] = date('Y-m-d',$value['time']);
	}
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
else if ($act=='add') {
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
else if($act == 'postadd'){
		$data = $_POST;
		$data['time'] = time();
		$id = insertAdd('contact',$data);
		if($id){
			echo "<script>alert('添加成功');window.parent.location.reload();</script>";
		}else{
			echo "<script>alert('添加失败');</script>";
		}
			
}
else if ($act=='update') {
	$id = $_GET['id'];
	if (!$id) {
		return false;
	}
	$sql = "select * from contact where id=$id";
	$result = select_one($sql);
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
elseif ($act=='updatepost') {
	$arr = $_POST;
	$data = '';
	foreach ($arr as $key => $value) {
        $data .= "`".$key."`" ."='".$value."',";
    }
    $str = rtrim($data,',');
    $sql = "update contact set $str where id={$arr['id']}";
    $result = update($sql);  //修改
    // 成功跳转与失败返回
    if($result){
        echo "<script>alert('修改成功');window.parent.location.reload();</script>";
    }else{
        echo "<script>alert('修改失败');history.back(-1);</script>";
    }
}
elseif ($act='del') {
	$id = intval($_POST['id']);
	$sql = "delete from contact where id=$id";
	$result = del($sql);
	if ($result) {
		$arr = ['code'=>2,'msg'=>'删除成功'];
		exit(json_encode($arr));
	}else{
		$arr = ['code'=>1,'msg'=>'删除失败'];
		exit(json_encode($arr));
	}
}

