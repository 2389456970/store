<?php
function dump($data){
    if(is_array($data)){
    echo "<pre>";
    print_r($data);
    echo "</pre>";
  }else{
    echo "<pre>";
    echo $data;
    echo "</pre>";
  }
}


function upload($array,$upload = 'upload'){

    //数据已提交
    $arr = ['image/png','image/jpeg','image/gif'];
    $data =[];
    foreach($_FILES as $key =>$value){
        //判断图片
        if (!empty($value['name'])) {
                //in_array()判断数组是否存在当前变量
            if(!in_array($value['type'],$arr)){

                echo "<script>alert('请上传图片文件');history.back(-1);</script>";
                    exit();
            }
            //限制大小
            if ($value['size']>(1024*1024*2)) {
                echo "<script>alert('请上传图片文件');history.back(-1);</script>";
            }
            $upload = 'upload';
            if (!file_exists($upload)) {
                mkdir($upload,777); //777文件最高权限,可读可写
            }
            //发现新文件名
            $file_arr = explode('.',$value['name']);//文件拆分为数组
            // print_r($file_arr);
            $len = count($file_arr); //计算数组个数
            $ext = '.'.$file_arr[$len-1];  //取数组最后一个元素
            $file = date("Ymd",time()).rand(1000,9999).$ext;
            //上传图片到指定目录
            $res = move_uploaded_file($value['tmp_name'],$upload.'/'.$file);
            $data[$key] =$file;
        }
    }
    return $data;
}
function check_login(){ 
    //是否存在session  默认存24分钟
    if (empty($_SESSION['uname'])) {
        echo "<script>alert('请先登录');window.location.href='index.php?m=admin&ctl=login&act=index'</script>";
    }
}

