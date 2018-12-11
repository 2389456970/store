<?php

if($act == 'index'){
//加载页面之前，先处理业务逻辑
    $sql = "select * from user order by user_id desc";

   // dump($data);
   //时间处理   
    $data = select_list($sql);
    foreach ($data as $key => $value) {
        $data[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
        $data[$key]['static'] =$value['static'] == 0 ? '正常':'不正常';
     }
    require_once(VIEW.DS.$mol.DS.$ctl.DS.$act.HTL);    
}
elseif($act =='add'){
    require_once(VIEW.DS.$mol.DS.$ctl.DS.$act.HTL);
}
else if($act =='addpost'){
	// var_dump($_POST);
	$data = $_POST;
	$data['create_time'] = time();
	$keys = array_keys($data);
	$values = array_values($data);
	$str1 = "`".implode('`,`',$keys)."`";
	$str2 = "'".implode("','", $values)."'";
	$sql = "insert into user($str1) values($str2)";
	// echo $sql;
	$id = add($sql);
	if($id){
		echo "<script>alert('添加成功');window.location.href='index.php?m=admin&ctl=user&act=index';</script>";
	}else{
		echo "<script>alert('添加失败');</script>";
	}
	
}
//删除
elseif($act=="del"){
	// print_r($_POST);
	$id =intval($_POST['id']);
	$sql = "delete from user where user_id=$id";
	// echo $sql;
	$result =del($sql);
	// var_dump($result);
	if($result){
		$arr = ['code'=>2,'mgs'=>'删除成功'];
		exit(json_encode($arr));
	}else{
		$arr = ['code'=>1,'mgs'=>'删除失败'];
		exit(json_encode($arr));
	}
}
//修改页面
elseif($act=="update"){
	$id = $_GET['id'];
	if(!$id){
		return false;

	}
	$sql = "select * from user where user_id=$id";
	$result = select_one($sql);
	include	VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
}	
//修改后提交的数据
elseif($act=="updatepost"){
	$arr =$_POST;
	
	
	$data ='';
	foreach ($arr as $key => $value) {
		$data .= "`".$key."`" ."='".$value."',";
	}
 
	$str = rtrim($data,',');
   
	$sql = "update user set $str where user_id={$arr['user_id']}";
	$result = update($sql); 
	//var_dump($result);
	//成功跳转与失败返回
	if($result){
		echo "<script>alert('修改成功');window.location.href='index.php?m=admin&ctl=user&act=index';</script>";
	}else{
		echo "<script>alert('修改失败');history.back(-1);</script>";
	}
	
}