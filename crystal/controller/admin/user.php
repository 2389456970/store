<?php
switch ($act) {
	case 'index':
        //加载静态页面处理业务逻辑
        $sql = "select * from user order by user_id desc"; //倒斜查询
        $result = select_list($sql);
        $total = "select count(user_id) from user";
        $total_value = select_list($total);
        // print_r($result);
        foreach ($result as $key => $value) {
		$result[$key]['create_time'] = date('Y-m-d',$value['create_time']);
		$result[$key]['static'] = $value['static'] == 0 ? '正常':'不正常';
	}

		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	case 'add':
        //加载静态页面处理业务逻辑
		$sql = "select * from user where user_id";
		$result = select_one($sql);
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	case 'addpost';
        //加载静态页面处理业务逻辑
        $data = $_POST;
        $reg = "/^[\w-]{6,18}$/";
        if (!preg_match($reg, $data['username'])) {
        	echo "<script>alert('用户名请输入英文或数字、下划线，长度为6-18个字符');history.back(-1);</script>";
        	exit();
        }
        $pass = "/^[a-zA-Z]\w{5,17}$/";
        if (!preg_match($pass,$data['password'])){
        	echo "<script>alert('密码必须以字母开头、下划线，长度为5-17个字符');history.back(-1);</script>";
        	exit();
        }
        $nick = "/^[\x7f-\xff]+$/";
        if (!preg_match($nick,$data['nickname'])) {
        	echo "<script>alert('昵称只能输入中文');history.back(-1);</script>";
        	exit();
        }
        $number ="/^1[3-9][0-46-9]{9}/";
        if (!preg_match($number,$data['mobile'])) {
        	echo "<script>alert('请输入正确的手机号码');history.back(-1);</script>";
        	exit();
        }
        $mail = "/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/";
        if (!preg_match($mail,$data['email'])) {
        	echo "<script>alert('请输入正确的邮箱地址');history.back(-1);</script>";
        	exit();
        }
		$name=$data['username'];
		$sql = "select username from user where username='$name'";
		$query = select_one($sql);
		if ($query or empty($name)) {
		   echo "<script>alert('用户名已存在或不能为空');history.back(-1);</script>";
		   exit;
		}
        $data['password'] = md5($data['password']);
        $data['create_time'] = time(); //时间戳 int
        $keys = array_keys($data);
        $values= array_values($data);
        $str1 = "`".implode('`,`', $keys)."`";
        $str2 = "'".implode("','", $values)."'";
        $sql = "insert into user($str1) values($str2)";
        $id = add($sql);   
        if($id){
        	echo "<script>alert('添加成功');window.parent.location.reload();</script>";
        }
        else{
        	echo "<script>alert('添加失败');history.back(-1);</script>";
        }
		break;
		//修改页面
	case 'update':
			$id = $_GET['id'];
			if (!$id) {
				return false;
			}
			$sql = "select * from user where user_id=$id";
			$result = select_one($sql);
			// print_r($result);die;
			include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
			break;
		//修改后提交的数据
		case 'updatepost':
			$arr = $_POST;
			// print_r($arr);
			$data = ''; 
			$arr['password'] = md5($arr['password']);
			foreach ($arr as $key => $value) {
                $data .= "`".$key."`" ."='".$value."',";
              
            }
           // echo $data;
           
            $str = rtrim($data,',');
           // echo $str;
            $sql = "update user set $str where user_id={$arr['user_id']}";
            
            $result = update($sql); //修改
            // var_dump($result);
            // 成功跳转与失败返回
            if($result){
                echo "<script>alert('修改成功');window.parent.location.reload();</script>";
            }else{
                echo "<script>alert('修改失败');history.back(-1);</script>";
            }
			break;
        case 'del':
            // print_r($_POST);
            $user_id = intval($_POST['id']);
            $sql = "delete from user where user_id=$user_id";
            $result = del($sql);
            if ($result) {
                $arr = ['code'=>2,'msg'=>'删除成功'];
                exit(json_encode($arr));
            }else{
                $arr = ['code'=>1,'msg'=>'删除失败'];
                exit(json_encode($arr));
            }
            break;
    case 'alldel':
        $id = $_POST['ids'];
        // var_dump($id);die;
        $sql = "delete from user where user_id in ({$id})";
        $result = del($sql);
        if ($result) {
            $arr = ['code'=>2,'msg'=>'删除成功'];
            exit(json_encode($arr));
        }else{
            $arr = ['code'=>1,'msg'=>'删除失败'];
            exit(json_encode($arr));
        }
}