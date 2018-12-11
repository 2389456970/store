<?php
if($act == 'index'){
    //加载页面之前，先处理业务逻辑  1
    $sql = "select * from user order by user_id desc";
    $data = select_list($sql);
    //设置时间格式
    foreach ($data as $key => $value) {
        $data[$key]['create_time'] = date('Y-m-d H:i:s',$value['create_time']);
        //状态
        $data[$key]['static'] = $value['static'] == 0 ? '正常':'不正常';
	}
   dump($data);//引用fun.php中的函数 
    require_once(VIEW.DS.$mol.DS.$ctl.DS.$act.HTL);
}

//user列表中添加用户的add.html页面路径
else if ($act == 'add') {
    require_once(VIEW.DS.$mol.DS.$ctl.DS.$act.HTL);
}
//user列表中添加用户的add.html页面提交的信息
else if ($act =='addpost') {
    $data = $_POST;//用变量接收数组
    //添加到数据库
    $data['create_time'] =time();//时间戳
    $keys = array_keys($data);
    $values = array_values($data);
    //用字符串拼接
    $str1 = "`".implode('`,`',$keys)."`";
     $str2 ="'".implode("','",$values)."'";
     $sql = "insert into user($str1) values($str2)";
    $id = add($sql);
        if ($id) {
            echo "<script>alert('添加成功');window.location.href='index.php?m=admin&ctl=user&act=index';</script>";
    } else{
        echo "<script>alert('添加失败'); </script>";
    }
}

//删除用户
elseif($act=="del"){
	// print_r($_POST);
	$id =intval($_POST['id']);
	$sql = "delete from user where user_id=$id";
	// echo $sql;
	$result =del($sql);
	// var_dump($result);
	if($result){
        //如果存在就删除
		$arr = ['code'=>2,'mgs'=>'删除成功'];
		exit(json_encode($arr));
	}else{
		$arr = ['code'=>1,'mgs'=>'删除失败'];
		exit(json_encode($arr));
	}
}
//修改用户内容
switch ($act) {
    //修改页面
    case 'update':
    // print_r($_GET);die;
    $id = $_GET['id'];//获取index.php中编辑的id。路由传过来的。
    if (!$id) {
        //如果不存在$id的话就不再往下执行
       return false;
    }
       $sql = "select * from user where user_id=$id";
       $result = select_one($sql);
    //    print_r($result);die;
       include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
        break;
        //修改后提交的数据
    case "updatepost":
        $arr = $_POST; // id input hidden 传过来的
        // print_r($data);
        $data ='';
        foreach($arr as $key => $value){
            $data .= "`".$key."`"."='".$value."',";
        }
        $str = rtrim($data,',');
       $sql = "update user set $str where user_id={$arr['user_id']}";
       $result = update($sql);//修改数据
    //    var_dump($result);die;
    //成功跳转与失败返回
    if ($result) {
        echo " <script>alert('修改成功');window.location.href='index.php?m=admin&ctl=user&act=index';  </script>";
    }else{
       echo " <script>alert('修改失败');history.back(-1);</script>";
    }




}
