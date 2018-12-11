<?php
if ($act=='index') {
	$sql = "select * from product order by id desc";
    $result = select_list($sql);
    $total = "select count(id) from product";
	$total_value = select_list($total);
    $data['time'] = time();
    foreach ($result as $key => $value) {
    	$sql = "select name from category where id= {$value['cate_id']}";
    	$name = select_one($sql);
    	$result[$key]['cate_id'] = $name['name']; 
		$result[$key]['time'] = date('Y-m-d',$value['time']);
		$result[$key]['content'] = htmlspecialchars_decode($value['content']);
		$str =strip_tags(htmlspecialchars_decode($value['content']));
		$len =mb_strlen($str,'utf-8');
		if ($len>50) {
			$result[$key]['content']=mb_substr($str,0,50,'utf-8');
		}
	}
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
else if ($act=='add') {
	$sql ="select * from category where cate_id=26";
	$result = select_list($sql);
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
else if($act == 'postadd'){
		$files = upload($_FILES);
		$data = array_merge($files,$_POST);
		if(!empty($data['content'])){
			$data['content'] = htmlspecialchars($data['content']);
		}
		$data['time'] = time();
		$id = insertAdd('product',$data);
		if($id){
			echo "<script>alert('添加成功');window.parent.location.reload();</script>";
		}else{
			echo "<script>alert('添加失败');</script>";
		}
			
}
else if ($act=='show') {
	$id = $_GET['id'];
	if (!$id) {
		return false;
	}
	$sql = "select * from product where id=$id";
	$result = select_one($sql);
	$result['content'] = htmlspecialchars_decode($result['content']);
	$sql2 = "select * from product order by id desc";
    $result2 = select_list($sql);
	$sql = "select name from category where id= {$result2[0]['cate_id']}";
	$name = select_one($sql);
	$result2[0]['cate_id'] = $name['name']; 
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
else if ($act=='update') {
	$id = $_GET['id'];
	if (!$id) {
		return false;
	}
	$sql = "select * from product where id=$id";
	$result = select_one($sql);
	$result['content'] = htmlspecialchars_decode($result['content']);
	// die;
	$sql2 = "select * from category where cate_id=26";
	$result2 = select_list($sql2);
	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
elseif ($act=='updatepost') {
	$arr = $_POST;
	if(!empty($arr['content'])){
		$arr['content'] = htmlspecialchars($arr['content']);
	}
	$files = upload($_FILES);
	$arr = array_merge($files,$arr);
	$img = "select image from product where id={$arr['id']}";
	$imgall=select_one($img);
	$data = '';
	foreach ($arr as $key => $value) {
        $data .= "`".$key."`" ."='".$value."',";
    }
    $str = rtrim($data,',');
    $sql = "update product set $str where id={$arr['id']}";
    $result = update($sql);
    if($result){
    	if (!empty($imgall['image'])) {
    		unlink(UPLOAD.$imgall['image']);
    	}
        echo "<script>alert('修改成功');window.parent.location.reload();</script>";
    }else{
        echo "<script>alert('修改失败');history.back(-1);</script>";
    }
}
elseif ($act=='del') {
	$id = intval($_POST['id']);
	$sql = "delete from product where id=$id";
	$img = "select image from product where id=$id";
	$imgall=select_one($img);
	$result = del($sql);
	if ($result) {
		unlink(UPLOAD.$imgall['image']);
		$arr = ['code'=>2,'msg'=>'删除成功'];
		exit(json_encode($arr));
	}else{
		$arr = ['code'=>1,'msg'=>'删除失败'];
		exit(json_encode($arr));
	}
}
else if($act == 'alldel'){
	$id = $_POST['ids'];
	$img = "select image from product where id in ({$id})";
	$imgall=select_list($img);
	$sql = "delete from product where id in ({$id})";
	$result = del($sql);
	if ($result) {
	foreach ($imgall as $key => $value) {
		unlink(UPLOAD.$value['image']);
	}
		$arr = ['code'=>2,'msg'=>'删除成功'];
		exit(json_encode($arr));
	}else{
		$arr = ['code'=>1,'msg'=>'删除失败'];
		exit(json_encode($arr));
	}
}