<?php
// $file = "view/rbm/output00001.html"; 
// if(file_exists($file)){
// 	// echo 123;
// 	// $result = file_get_contents('view/rbm/output00001.html');
// 	// echo $result;
// 	require_once("view/rbm/output00001.html");  //缓存文件
// 	exit();
// }
// ob_start();//开启缓存

$pid = empty($_GET['cate_id']) ? '18' :$_GET['cate_id'];
// echo $pid;
//新闻分类菜单 表category

//分类标题 class="tittle"
$sql = "select name from category where id = $pid";
$cate_tit = select_one($sql);

$sql = "select * from category where cate_id=25";
$new_menu = select_list($sql);

// 分页
$page = empty($_GET['page'])? 1 : $_GET['page'];
$num = 4;
$start_page = $num*($page-1);
//总条数
$sql = "select * from news where cate_id={$pid} order by id desc limit $start_page,$num";
$news = select_list($sql);
foreach ($news as $key => $value) {
	$str = strip_tags(htmlspecialchars_decode($value['content']));
	$len =mb_strlen($str,'utf-8');
	if ($len >200) {
		$news[$key]['content']=mb_substr($str,0,220,'utf-8').'......';
	}
}
//上一页
$prev = $page>1 ?$page-1 : 1;
//总条数
$sql = "select count(id) as count from news where cate_id={$pid}";
$total = select_one($sql);
//总页数
$page_total = ceil($total['count']/$num);
//下一页
$next = ($page < $page_total and $page > 0)? $page + 1 : $page_total;


require_once "common.php";

$content = ob_get_contents();//取得php页面输出的全部内容 
$fp = fopen("view/rbm/output00001.html", "w"); //I/O 创建一个文件，并打开，准备写入  如果文件不存在会生成新文件 w 写入读取 r 读取
fwrite($fp, $content); //把php页面的内容全部写入output00001.html，然后…… 
fclose($fp); //关闭文件