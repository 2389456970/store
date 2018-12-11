<?php

/*
验证码
1. 生成画布背景 宽 高  x y  imagecreatetruecolor(宽，高)
2.创建 颜色  imagecolorallocate(资源=背景，R，B，G)
3. 填充颜色 R,G,B  imagefilledrectangle(资源，宽，高，角度，颜色)
4. 生成随机码 指定验证码长度 随机取一段字符串，for循环做拼接
5.画干扰线、雪花 createLine()   imageline（） imagestring（）
6.字体写入背景 
  imagecolorallocate（）给字体创造颜色

  imagettftext(资源，字体大小，角度，字体宽，字体高，字体颜色，字体库，字符一个)

7.声明头部 输出类型 png jpeg   png
 


*/

//end class 


//验证码类  实例化对象  
class ValidateCode {

	 private $charset = 'abcdefghkmnprstuvwxyzABCDEFGHKMNPRSTUVWXYZ23456789';//随机因子
	 private $code;//验证码
	 private $codelen = 4;//验证码长度
	 private $width = 130;//宽度
	 private $height = 50;//高度
	 private $img;//图形资源句柄
	 private $font;//指定的字体
	 private $fontsize = 20;//指定字体大小
	 private $fontcolor;//指定字体颜色
	 //构造方法初始化
	 public function __construct() {
	 	// echo dirname(dirname(__FILE__));die;
	 	$array = ['BAUHS93.TTF','verdana.ttf','GOUDYSTO.TTF'];
	 	$len = count($array);
	 	$font_one = mt_rand(0,$len-1);
	  	$this->font = dirname(dirname(__FILE__)).'/font/'.$array[$font_one];//注意字体路径要写对，否则显示不了图片
	 }
	 //生成随机码
	 private function createCode() {
		$_len = strlen($this->charset)-1;
		for ($i=0;$i<$this->codelen;$i++) {
	   		$this->code .= $this->charset[mt_rand(0,$_len)];
	  	}
	 }
	 //生成背景
	 private function createBg() {
		$this->img = imagecreatetruecolor($this->width, $this->height);
		$color = imagecolorallocate($this->img, mt_rand(157,255), mt_rand(157,255), mt_rand(157,255));
	    imagefilledrectangle($this->img,0,$this->height,$this->width,0,$color);
	 }
	 //生成文字
	 private function createFont() {
	    $_x = $this->width / $this->codelen;
	    for ($i=0;$i<$this->codelen;$i++) {
		    $this->fontcolor = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
		    imagettftext($this->img,$this->fontsize,mt_rand(-30,30),$_x*$i+mt_rand(1,5),$this->height / 1.4,$this->fontcolor,$this->font,$this->code[$i]);
	    }
	 }
	 //生成线条、雪花
	 private function createLine() {
	  //线条
	    for ($i=0;$i<6;$i++) {
		   $color = imagecolorallocate($this->img,mt_rand(0,156),mt_rand(0,156),mt_rand(0,156));
		   imageline($this->img,mt_rand(0,$this->width),mt_rand(0,$this->height),mt_rand(0,$this->width),mt_rand(0,$this->height),$color);
	    }
	  //雪花
	    for ($i=0;$i<100;$i++) {
		   $color = imagecolorallocate($this->img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
		   imagestring($this->img,mt_rand(1,5),mt_rand(0,$this->width),mt_rand(0,$this->height),'*',$color);
	    }
	 }
	 //输出
	 private function outPut() {
		  header('Content-type:image/png');
		  imagepng($this->img);
		  imagedestroy($this->img);
	 }
	 //对外生成
	 public function doimg() {
		  $this->createBg();  //生成背景颜色
		  $this->createCode();
		  $this->createLine();
		  $this->createFont();
		  $this->outPut();
	 }
	 //获取验证码
	 public function getCode() {
	  	return strtolower($this->code);
	 }
}