<?php 
switch ($act) {
	case 'index':
		$sql = "select * from about order by id desc"; //倒斜查询
	    $result = select_list($sql);
	    $total = "select count(id) from about";
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
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;

	case 'add':
		$sql ="select * from category where cate_id=24";
		$result = select_list($sql);
		// print_r($result);
		$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		include $file;
		break;

	case 'postadd':
		// print_r($_FILES);die;
		$files = upload($_FILES);
		$data = array_merge($files,$_POST);
		if (!empty($data['content'])) {
			$data['content'] = htmlspecialchars($data['content']);
		}
		$data['time'] = time();
		// var_dump($data);die;
		$id = insertAdd('about',$data);
		if($id){
			echo "<script>alert('添加成功');window.parent.location.reload();</script>";
		}else{
			echo "<script>alert('添加失败');</script>";
		}
	break;
	case 'show':
		$id = $_GET['id'];
		if (!$id) {
			return false;
		}
		$sql = "select * from about where id=$id";
		$result = select_one($sql);
		$result['content'] = htmlspecialchars_decode($result['content']);
		$sql2 = "select * from about order by id desc";
	    $result2 = select_list($sql);
		$sql = "select name from category where id= {$result2[0]['cate_id']}";
		$name = select_one($sql);
		$result2[0]['cate_id'] = $name['name']; 
		$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		include $file;
		break;
	case 'update':
		$id = $_GET['id'];
		if (!$id) {
			return false;
		}
		$sql = "select * from about where id=$id";
		$result = select_one($sql);
		$result['content'] = htmlspecialchars_decode($result['content']);
		$sql2 = "select * from category where cate_id=24";
		$result2 = select_list($sql2);
		$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		include $file;
		break;
	case 'updatepost':
		$arr = $_POST;
		if(!empty($arr['content'])){
		$arr['content'] = htmlspecialchars($arr['content']);
		}
		$files = upload($_FILES);
		$arr = array_merge($files,$arr);
		$img = "select image1,image2 from about where id={$arr['id']}";
		$imgall=select_one($img);
		$data = '';
		foreach ($arr as $key => $value) {
	        $data .= "`".$key."`" ."='".$value."',";
	    }
	    $str = rtrim($data,',');
	    $sql = "update about set $str where id={$arr['id']}";
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
		break;
	case 'del':
	$id = intval($_POST['id']);
	$img = "select image1,image2 from about where id=$id";
	$imgall=select_one($img);
	$sql = "delete from about where id=$id";
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
	break;
}