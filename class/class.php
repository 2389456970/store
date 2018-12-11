<?php
/* 
class ClassName//类名
{
    //属性
    //var $属性名 = 属性值

}
//实例化类 变成对象 对象 =new 类名
//调用属性 js：对象.属性名 PHP：对象 ->属性名
*/
class ZhiJie{
    var $name = 'mimi';
    var $height = '180';
    var $weight = '56';
    function eat($foot='鸡腿'){
        echo ('我要吃'.$foot);

    }
}

$li = new ZhiJie;
// var_dump($li);

// var_dump($li->name);

// $name = $li ->name;
// var_dump($name);
$li ->eat('烤鸭,烤鸡,烤鹅');

?>