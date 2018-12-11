<?php


if ($act == 'index') { 


	$file =VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
   

}
else if($act =='add'){
    $sql = "select * from category where cate_id=2";
    $result = select_list($sql);
    $file =VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
}