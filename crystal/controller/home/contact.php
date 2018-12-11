<?php
$sql = "select * from contact";
$contact = select_list($sql);
// print_r($contact);die;

if($act == 'feedbackpost'){
		$data = $_POST;
		if (empty($data['name'])) {
			echo "<script>alert('用户名不能为空');history.back(-1);</script>";
		   	exit;
		}
		if (empty($data['mobile'])) {
			echo "<script>alert('电话不能为空');history.back(-1);</script>";
		   	exit;
		}
		$name = "/^[\x7f-\xff]+$/";
        if (!preg_match($name,$data['name'])) {
        	echo "<script>alert('姓名只能输入中文');history.back(-1);</script>";
        	exit();
        }
		$number ="/^1[3-9][0-46-9]{9}/";
        if (!preg_match($number,$data['mobile'])) {
        	echo "<script>alert('请输入正确的手机号码');history.back(-1);</script>";
        	exit();
        }
        $mail = "/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
        if (!preg_match($mail,$data['e-mail'])) {
        	echo "<script>alert('请输入正确的邮箱地址');history.back(-1);</script>";
        	exit();
        }
		$data['time'] = time();
		$id = insertAdd('feedback',$data);
		if($id){
			echo "<script>alert('提交成功');window.location.href='index.php?m=home&ctl=index'</script>";
		}else{
			echo "<script>alert('提交失败');</script>";
		}
			
}
require_once "common.php";