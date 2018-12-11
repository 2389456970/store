<?php
if ($act=='index') {
	$sql = "select * from pic order by id desc"; //倒斜查询
    $result = select_list($sql);
    $total = "select count(id) from pic";
	$total_value = select_list($total);
    foreach ($result as $key => $value) {
    	$sql = "select name from category where id= {$value['cate_id']}";
    	$name = select_one($sql);
    	$result[$key]['cate_id'] = $name['name']; 
		$result[$key]['time'] = date('Y-m-d',$value['time']);
		$result[$key]['image1'] = empty($value['image1']) ? 'notadded.png':$value['image1'];
		$result[$key]['image2'] = empty($value['image2']) ? 'notadded.png':$value['image2'];
		$result[$key]['image3'] = empty($value['image3']) ? 'notadded.png':$value['image3'];
	}
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
else if ($act=='add') {
	$sql ="select * from category where cate_id=2";
	$result = select_list($sql);
	// print_r($result);
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
else if($act == 'postadd'){
		// print_r($_FILES);die;
		$files = upload($_FILES);
		$data = array_merge($files,$_POST);
		$data['time'] = time();
		// var_dump($data);die;
		$id = insertAdd('pic',$data);
		if($id){
			echo "<script>alert('添加成功');window.parent.location.reload();</script>";
		}else{
			echo "<script>alert('添加失败');</script>";
		}		
}

else if ($act=='update') {
	$id = $_GET['id'];
	// echo $id;
	if (!$id) {
		return false;
	}
	$sql = "select * from pic where id=$id";
	$result = select_one($sql);
	// print_r($result)
	$sql2 = "select * from category where cate_id=2";
	$result2 = select_list($sql2);
	// print_r($result2);die;
	// $tree = getList();
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
elseif ($act=='updatepost') {
	$arr = $_POST;
	$img = "select image1,image2,image3 from pic where id={$arr['id']}";
	$imgall=select_one($img);
	$files = upload($_FILES);
	$arr = array_merge($files,$arr);
	$data = '';
	foreach ($arr as $key => $value) {
        $data .= "`".$key."`" ."='".$value."',";
    }
    $str = rtrim($data,',');
    $sql = "update pic set $str where id={$arr['id']}";
    // echo $sql;die;
    $result = update($sql);  //修改
    // 成功跳转与失败返回
    if($result){
    	if(!empty($files)){
    		foreach ($files as $key => $value) {
    			if (!empty($imgall[$key])) {
    				unlink(UPLOAD.$imgall[$key]);
    			}	
    		}
    	}
        echo "<script>alert('修改成功');window.parent.location.reload();</script>";
    }else{
        echo "<script>alert('修改失败');history.back(-1);</script>";
    }
}
elseif ($act=='del') {
	$id = intval($_POST['id']);
	$sql = "delete from pic where id=$id";
	$img = "select image1,image2,image3 from pic where id=$id";
	$imgall=select_one($img);
	$result = del($sql);
	if ($result) {
		foreach ($imgall as $key => $value) {
			if (!empty($imgall[$key])) {
				unlink(UPLOAD.$imgall[$key]);
			}	
		}
		$arr = ['code'=>2,'msg'=>'删除成功'];
		exit(json_encode($arr));
	}else{
		$arr = ['code'=>1,'msg'=>'删除失败'];
		exit(json_encode($arr));
	}
}

elseif ($act=='logo') {
	$sql = "select * from logo where logo"; //倒斜查询
    $result = select_list($sql);
    foreach ($result as $key => $value) {
		$result[$key]['time'] = date('Y-m-d',$value['time']);
	}
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
elseif ($act=='logo-update') {
	$id = $_GET['logo'];
	// echo $id;
	if (!$id) {
		return false;
	}
	$sql = "select * from logo where logo=$id";
	$result = select_one($sql);
	// print_r($result)
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
else if($act == 'logo-postupdate'){
	$arr = $_POST;
	$img = "select image from logo where logo={$arr['logo']}";
	$imgall=select_one($img);
	$files = upload($_FILES);
	$arr = array_merge($files,$arr);
	$data = '';
	foreach ($arr as $key => $value) {
        $data .= "`".$key."`" ."='".$value."',";
    }
    $str = rtrim($data,',');
    $sql = "update logo set $str where logo={$arr['logo']}";
    // echo $sql;die;
    $result = update($sql);  //修改
    // 成功跳转与失败返回
    if($result){
    	if (!empty($imgall['image'])) {
    		unlink(UPLOAD.$imgall['image']);
    	}
        echo "<script>alert('修改成功');window.parent.location.reload();</script>";
    }else{
        echo "<script>alert('修改失败');die;history.back(-1);</script>";
    }	
}




