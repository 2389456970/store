
<?php


if($act=='index'){
    $sql = "select * from product";
	$result = select_list($sql);
	// print_r($result);die;
    // foreach ($result as $key => $value) {
    // 	//反转义标签
    // 	$result[$key]['content'] = htmlspecialchars_decode($value['content']) ;
    // 	// 查出上级分类名，替换product cate_id 
    // 	$sql = "select name from category where id= {$value['cate_id']}";
    // 	$name = select_one($sql);
    
    // 	$result[$key]['cate_id'] = $name['name']; 
    // 	$result[$key]['time']  = date('Y-m-d',$value['time']);
	// } 
	foreach ($result as $key => $value) {
        $result[$key]['time'] = date('Y-m-d H:i:s',$value['time']);
     }
    $file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
}

else if($act=='add'){

    $sql = "select * from category where cate_id=16";
    $result = select_list($sql);

	$file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
}
else if($act =='postadd'){  //unlink('upload/34503450.jpg')
	// var_dump($_POST);
	$data = $_POST;
	$data['time'] = time();
	$file = upload($_FILES);
	$data = array_merge($file,$_POST);//可以传图片
	$keys = array_keys($data);
	$values = array_values($data);
	$str1 = "`".implode('`,`',$keys)."`";
	$str2 = "'".implode("','", $values)."'";
	$sql = "insert into product($str1) values($str2)";
	// echo $sql;
	$id = add($sql);
	if($id){
		
		echo "<script>alert('添加成功');window.location.href='index.php?m=admin&ctl=news&act=index';</script>";
	}else{
		echo "<script>alert('添加失败');</script>";
	}
	
}