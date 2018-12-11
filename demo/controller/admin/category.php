<?php


switch ($act) {
	case 'index':
	    $sql = "select * from category order by id desc";
		$resulte = select_list($sql);

		foreach ($resulte as $key => $value) {
			$sql ="select name from category where id={$value['cate_id']}";
			$name = select_one($sql);
			$resulte[$key]['cate_id'] = $name['name'];

			if (empty($value['cate_id'])) {
				$resulte[$key]['cate_id'] ='顶级分类';
			}
			$resulte[$key]['is_show'] = $value['is_show']==1 ? '显示':'隐藏';
			$resulte[$key]['url_path'] = empty($value['url_path']) ? 'NULL':$value['url_path'];
		}
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	
	case 'add':

	    // print_r(getList());die;
	    $tree = getList();
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	case 'postadd':
	    $resulte = $_POST;

		$keys = array_keys($resulte);
        $values= array_values($resulte);
        $str1 = "`".implode('`,`', $keys)."`";
        $str2 = "'".implode("','", $values)."'";
        $sql = "insert into category($str1) values($str2)";
		$id = add($sql);
		// print_r($id);die;

        if($id){
        
                echo "<script>alert('添加成功');window.parent.location.reload();</script>";
                
        }
        else{
        	echo "<script>alert('添加失败');</script>";
		}
		break;
	   
		case 'update':
		//当前ID数据
		$id =$_GET['id'];
		$sql = "select * from category where id ={$id}";
		$resulte = select_one($sql);
		//无限极分类
		$tree =getList();
		include VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
		break;
	
	case 'add':	
	case 'updatepost':	
}
