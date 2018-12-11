<?php
/*

限制不是我们网站的用户登录，用到回话控制 session cookie
session存在服务器
cookie存在本地
*/

if ($act =='index') {
    $file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
	include $file;
}
elseif($act == "checkpost"){
    // print_r($_POST);
    //获取数据
        $data =$_POST;
        
        if(strtolower($data['verify']) != $_SESSION['code']){
            echo "<script>alert('验证码错误，请重新输入');history.back(-1);</script>";
            exit;
        }
        $sql ="select * from user where username='{$data['username']}'";
        //正则
        $reg = "/^[\w]+$/";
        // var_dump(preg_match($reg,$data['username']));die;
        if(!preg_match($reg,$data['username'])){
            echo "<script>alert('用户名错误，请重新输入');history.back(-1);</script>"; exit;
        }
        //查询数据库是否存在该用户
        $result = select_one($sql);
    if ($result){
        if($data['password'] == $result['password'])
         {
        $_SESSION['uname'] =$data['username'];//回话控制只有有这个才能进入 
        $_SESSION['nickname'] = $result['nickname'];//显示昵称
        echo "<script>alert('登录成功');window.location.href='index.php?m=admin&ctl=index&act=index';</script>";
        }else{
            echo "<script>alert('密码输入错误');history.back(-1)</script>";
        }
    }
    else{
    echo "<script>alert('用户信息错误，请重新输入');history.back(-1)</script>";
    }
}  



//验证码2

elseif($act=='vcode'){
    include "model/code.php";
    $code = new ValidateCode(); //实例化验证类
    $code->doimg();  //对外方法
    $_SESSION['code'] = $code->getCode();
}





/*解释:
history.back(-1) 当数据验证失败时，返回原页面
*/
//退出登录
elseif($act =='out'){
    session_destroy();//方法一：销毁 
   // $_SESSION['uname'] ='';//方法二
    //$_SESSION['uname'] =null;//方法三
    echo "<script>alert('退出成功');window.location.href='index.php?m=admin&ctl=index&act=index';</script>";
}

