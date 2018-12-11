<?php
switch ($act) {
	case 'index':
		$result = tree();
		$total = "select count(id) from category";
		$total_value=select_list($total);
	    foreach ($result as $key => $value) {
	    	$sql = "select name from category where id={$value['cate_id']}";
	    	$name = select_one($sql);
	    	$result[$key]['cate_id'] = $name['name'];
	    	if(empty($value['cate_id'])){
	    		$result[$key]['cate_id'] = '顶级分类';
	    	}
	    	$result[$key]['is_show'] = $value['is_show']==1 ? '显示':'隐藏';
            $result[$key]['url_path'] = empty($value['url_path']) ? 'NULL':$value['url_path'];
	    }
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;

	case 'add':
	 $tree = getList();
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	case 'postadd':
		$data = $_POST;
        // echo $sql;
        $id = insertAdd('category',$data);

        if($id){
        	// echo "<script>alert('添加成功');window.location.href='index.php?m=admin&ctl=user&act=index';</script>";
        	echo "<script>alert('添加成功');window.parent.location.reload();</script>";
        }
        else{
        	echo "<script>alert('添加失败');</script>";
        }
		// print_r($data);
		break;
		
		case 'update':
			$id = $_GET['id'];
			if (!$id) {
				return false;
			}
			$sql = "select * from category where id=$id";
			$result = select_one($sql);
			// print_r($result);die;
			$tree = getList();
			include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
			break;
		//修改后提交的数据
		case 'updatepost':
			$arr = $_POST;
			// print_r($arr);
			$data = '';
			foreach ($arr as $key => $value) {
                $data .= "`".$key."`" ."='".$value."',";
            }
           // echo $data;
            $str = rtrim($data,',');
           // echo $str;
            $sql = "update category set $str where id={$arr['id']}";
            
            $result = update($sql);  //修改
            // 成功跳转与失败返回
            if($result){
                echo "<script>alert('修改成功');window.parent.location.reload();</script>";
            }else{
                echo "<script>alert('修改失败');history.back(-1);</script>";
            }
			break;
		case 'del':
			// print_r($_POST);
			$id = intval($_POST['id']);
			$sql = "delete from category where id=$id";
			$result = del($sql);
			if ($result) {
				$arr = ['code'=>2,'msg'=>'删除成功'];
				exit(json_encode($arr));
			}else{
				$arr = ['code'=>1,'msg'=>'删除失败'];
				exit(json_encode($arr));
			}
			break;

	default:
		# code...
		break;
}
