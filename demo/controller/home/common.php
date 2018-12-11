<?php
 $sql = "select * from category where cate_id=2";
 $menu = select_list($sql);
 require_once('view/home/header.html');
 require_once('view/home/'.$ctl.'.html');
 require_once('view/home/footer.html');

