<?php

/*
 $host 域名或地址
 $user 帐号
 $password 密码
 $dbname 数据库名
 $charset 编码

*/



// function db($dbname,$user,$password,$host,$cahrset='utf8'){
// 	// echo HOST;echo USER;
// 	global $mysqli;
// 	$mysqli = mysqli_connect($host,$user,$password,$dbname) or die("数据库连接不成功");

// 	mysqli_set_charset($mysqli,$cahrset);
// }
// db('php','root','root','127.0.0.1');
 /*
 连接数据库  mysqli pdo  不存在mysql
 */
function db(){
	// echo HOST;echo USER;
	global $mysqli;
	$mysqli = mysqli_connect(HOST,USER,PASSWORD,DBNAME) or die("数据库连接不成功");
	// $mysqli = new Mysqli(HOST,USER,PASSWORD,DBNAME);

	mysqli_set_charset($mysqli,CHARSET);
	// return $mysqli;
}

/*
 单个查询
 查询
 select  *或者 id,name,title from 表名 where id = 条件


*/

function select_one($sql){
	global $mysqli;
	$row = mysqli_query($mysqli,$sql);//sql语句执行

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

	global $mysqli;

	$row = mysqli_query($mysqli,$sql);

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

添加 

insert into 表名（字段1，字段2） values(数据1，数据2)

$arr = ['name'=>"李雷",'age'=>40,'sex'=>'男'];
*/

function add($sql){

    global $mysqli;

	$row = mysqli_query($mysqli,$sql);

	if(!$row){
        return false;
	}
    $result = mysqli_insert_id($mysqli); //返回自增ID

    return $result;
}

/*
修改数据

update 表名 set 字段="数据"，字段2=“数据2",... where id=2

*/
function update($sql){
	global $mysqli;
    $row = mysqli_query($mysqli,$sql);//sql语句执行

	if(!$row){
        return false;
	}
	return $row;
}

/*
删除数据

*/

function del($sql){

	global $mysqli;

	$row = mysqli_query($mysqli,$sql);
	if(!$row){
		return false;
	}

	return $row;
}

function getList($pid=0,&$result=array(),$space=0){
    global $mysqli;
	//当前Id  分类名name　上一级分类cate_id
	$sql="SELECT id,name,cate_id FROM category WHERE cate_id = $pid";
	$res = mysqli_query($mysqli,$sql);
	
	$space=$space+2;
	while ($row = mysqli_fetch_assoc($res)){
		$row['name']=str_repeat(' ',$space).'┖┖'.$row['name'];
		$result[]=$row;
	// var_dump($result);die;
	getList($row['id'],$result,$space);
 }
 return $result;
}
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
