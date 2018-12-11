<?php


if ($act=='index') {
	require_once(VIEW.DS.$mol.DS.$ctl.DS.$act.HTL);
}
elseif ($act=='checkpost') {
	// print_r($_POST);	
	// $login = login('user',$data);
	$data = $_POST;
	if(strtolower($data['verify']) != $_SESSION['code']){
		echo "<script>alert('验证码不正确，请重输');history.back(-1);</script>";
		exit();
	}
	$sql = "select * from user where username='{$data['username']}'";
	$result = select_one($sql);
	if ($result) {
		if (md5($data['password']) == $result['password']) {
			$_SESSION['uname'] = $data['username'];
			$_SESSION['nickname'] = $result['nickname'];
			echo "<script>alert('登录成功');window.location.href='index.php?m=admin&ctl=index&act=index';</script>";
		}else{
			echo "<script>alert('密码不正确，请重新输入');history.back(-1);</script>";
		}
	}else{
		echo "<script>alert('不存在此用户名，请重新输入');history.back(-1);</script>";
	}
}
elseif ($act=='vcode') {
	include "model/code.php";	
	$code = new ValidateCode();  //实例化验证类
	$code->doimg(); //对外方法
	$_SESSION['code'] = $code->getCode();
}
elseif ($act== 'out') {
	session_destroy();
	echo "<script>alert('退出成功');window.location.href='index.php?m=admin&ctl=login&act=index';</script>";
}