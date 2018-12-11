<?php
function db(){
	global $con;
	$con = mysqli_connect(HOST,USER,PASSWORD,DBNAME) or die('数据库连接不成功');
	mysqli_set_charset($con,CHARSET);
	
}
//添加

function add($sql){
	global $con;
	$result = mysqli_query($con,$sql);

	if(!$result){
		return false;
	}

	return mysqli_insert_id($con);
}/*
 单个查询
 查询
 select  *或者 id,name,title from 表名 where id = 条件


*/

function select_one($sql){
	global $con;
	$row = mysqli_query($con,$sql);//sql语句执行

	if(!$row){
        return false;
	}
    $result = mysqli_fetch_assoc($row); //取一条数据
    return $result; //返回结果
}

/*
查询多条

*/
function select_list($sql){

	global $con;

	$row = mysqli_query($con,$sql);

	if(!$row){
        return false;
	}
	$arr = [];
	while($result = mysqli_fetch_assoc($row)){
 		$arr[] = $result;
	}
   
    return $arr;
}

/*
修改数据

update 表名 set 字段="数据"，字段2=“数据2",... where id=2

*/
function update($sql){
	global $con;
    $row = mysqli_query($con,$sql);//sql语句执行

	if(!$row){
        return false;
	}
	return $row;
}

/*
删除数据

*/

function del($sql){

	global $con;

	$row = mysqli_query($con,$sql);
	if(!$row){
		return false;
	}

	return $row;
}
/*
无限级分类

递归 函数内调用本身函数
$pid 上一级分类 0 顶级分类
$result 查询结果 &引用 上一个结果 
*/

function getList($pid=0,&$result=array(),$space=0){
    global $con;

	//当前Id  分类名name　上一级分类cate_id
	$sql="SELECT id,name,cate_id FROM category WHERE cate_id = $pid";
	$res = mysqli_query($con,$sql);
	
	$space=$space+2;
	while ($row = mysqli_fetch_assoc($res)){
		$row['name']=str_repeat('&nbsp;&nbsp;',$space).'┖┖'.$row['name'];
		$result[]=$row;
	// var_dump($result);die;
		getList($row['id'],$result,$space);
 	}
 	return $result;
}

function tree($pid=0,&$result=array(),$space=0){
    global $con;

	//当前Id  分类名name　上一级分类cate_id
	$sql="SELECT * FROM category WHERE cate_id = $pid";
	$res = mysqli_query($con,$sql);
	
	$space=$space+2;
	while ($row = mysqli_fetch_assoc($res)){
		$row['name']=str_repeat('&nbsp;&nbsp;',$space-2).'--'.$row['name'];
		$result[]=$row;
		tree($row['id'],$result,$space);
    }
 	return $result;
}

//添加数据函数
function insertAdd($table,$data){
	$keys = array_keys($data);
    $values= array_values($data);
    $str1 = "`".implode('`,`', $keys)."`";
    $str2 = "'".implode("','", $values)."'";
    $sql = "insert into $table($str1) values($str2)";
    // echo $sql;die;
    $id = add($sql);
    if($id){
    	return $id;
    }else{
    	return false;
    }
}

