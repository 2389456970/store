 <?php
//echo "你好，我是小黑。我来看看世界。";
// $arr = ['title'=>'联系我们图','ad_width'=>1920,'ad_height'=>700,'desc'=>'这是联系我们页面的图','is_show'=>1];


if ($act == 'index') { 
	$sql = "select * from news order by id desc";
    $data = select_list($sql);
    //时间处理
    foreach($data as $key => $value){
		$data [$key]['time'] =date('Y-m-d H:i:s',$value['time']);
		$data[$key]['conten'] = htmlspecialchars_decode($value['content']);
        $str =strip_tags(htmlspecialchars_decode($value['content']));//反转义，去掉标签
        $len = mb_strlen($str,'utf8');
        if($len>50){
            $data[$key]['content'] = mb_substr($str,0,50,'utf8');
        }
    }
	$file =VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
   

}
else if($act =='add'){

	$sql = "select * from category where cate_id=33";
    $result = select_list($sql);
 
    $file =VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
}

else if($act == 'postadd'){
	// for($i=0;$i<50;$i++){ 
	$file = upload($_FILES);
	// print_r($file);
	// print_r($_POST);
	$data = array_merge($file,$_POST);
	
	$data['time'] = time();//
	if(!empty($data['content'])){
		$data['content'] = htmlspecialchars($data['content']);//转义 htmlspecialchars_decode() 反转 字符串变回标签 
	} 
//  print_r($data);  die;
	$id = insertAdd('news',$data);
	// }
	 
	 if($id){
		 // echo "<script>alert('添加成功');window.location.href='index.php?m=admin&ctl=user&act=index';</script>";
			 echo "<script>alert('添加成功');window.parent.location.reload();</script>";
			 
	 }
	 else{
		 echo "<script>alert('添加失败');</script>";
	 }	 
 }
 elseif($act=="del"){
	// print_r($_POST);
	$id =intval($_POST['id']);
	$sql = "delete from news where id=$id";
	// echo $sql;
	$result =del($sql);
	// var_dump($result);
	if($result){
		$arr = ['code'=>2,'mgs'=>'删除成功'];
		exit(json_encode($arr));
	}else{
		$arr = ['code'=>1,'mgs'=>'删除失败'];
		exit(json_encode($arr));
	}
}

// //修改页面
elseif($act=="update"){
	$id = $_GET['id'];
	if(!$id){
		return false;

	}
	$sql = "select * from news where id=$id";
	$result = select_one($sql);
	include	VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
}	
//修改后提交的数据
elseif($act=="updatepost"){
	$arr =$_POST;
	
	$data ='';
	foreach ($arr as $key => $value) {
		$data .= "`".$key."`" ."='".$value."',";
	}
 
	$str = rtrim($data,',');
   
	$sql = "update news set $str where id={$arr['id']}";
	$result = update($sql); 
	//var_dump($result);
	//成功跳转与失败返回
	if($result){
		echo "<script>alert('修改成功');window.location.href='index.php?m=admin&ctl=user&act=index';</script>";
	}else{
		echo "<script>alert('修改失败');history.back(-1);</script>";
	}
	
}
