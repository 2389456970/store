<?php

function dump($data){
	if(is_array($data)){
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
	else{
		echo "<pre>";
		echo $data;
		echo "</pre>";
	}
}


function file_error($name){

	switch ($name) {
		case 1:
			$mgs = '上传的文件超过2M';
			break;
		case 2:
			$mgs = '上传文件的大小超过了HTML';
			break;
		case 3:
			$mgs = '文件只有部分被上传';
			break;
		case 4:
			$mgs = '没有文件被上传';
			break;
			
	}

	return $mgs;
}

function check_login(){
	
	if (empty($_SESSION['uname'])) {

		echo "<script>alert('请先登录');window.location.href='index.php?m=admin&ctl=login&act=index';</script>";
	}
}
// //登录页面函数
// function login($user,$data){
// 	$sql = "select * from $user where username='{$data['username']}'";
// 	$result = select_one($sql);
// 	if ($result) {
// 		if (md5($data['password']) == $result['password']) {
// 			$_SESSION['uname'] = $data['username'];
// 			$_SESSION['nickname'] = $result['nickname'];
// 			echo "<script>alert('登录成功');window.location.href='index.php?m=admin&ctl=index&act=index';</script>";
// 		}else{
// 			echo "<script>alert('密码不正确，请重新输入');history.back(-1);</script>";
// 		}
// 	}else{
// 		echo "<script>alert('不存在此用户名，请重新输入');history.back(-1);</script>";
// 	}
// }
// 
// 图片上传函数
function upload($array,$upload='upload'){
	$arr = ['image/png','image/jpeg','image/gif'];
	$data = [];
	foreach ($array as $key => $value) {
		if (!empty($value['name'])) {
			if($value['error']>0){
				$error = file_error($value['error']);
				
				echo 
				"<script>
					alert('".$error."');history.back(-1);
				</script>";
				exit();
			}
			if (!in_array($value['type'],$arr)) {
				echo 
				"<script>
					alert('请上传图片文件');history.back(-1);
				</script>";
				exit();
			}
			if (!file_exists($upload)) {
				mkdir($upload,777);
			}
			//实现新文件名
		        // echo $value['name'];
		        $file_arr = explode('.',$value['name']); // 文件名拆为数组
		        // print_r($file_arr);

		        $len = count($file_arr); //计算数组个数

		        $ext = '.'.$file_arr[$len-1]; //取数组最后一个元素

		        // echo $ext;
	            //新文件名
		        $file = date("Ymd",time()).rand(1000,9999).$ext;	
	            //上传图片到指目录
		        $res = move_uploaded_file($value['tmp_name'],$upload.'/'.$file);

		        if($res){
		        	$data[$key] = $file;
		        }      
		}
	} 
	return $data;
}