<?php
function dump($data){
    //判断是否是数组  2
    if(is_array($data)){
        echo "<pre>";
        //print_r($data);
        echo "</pre>";
    }//判断是否是字符串,是就直接输出
    else{
        echo "<pre>";
        echo $data;
        echo "</pre>";
    }
}