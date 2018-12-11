<?php
if ($act == 'index') {
    $file = VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    // echo $file;
    include $file;
 
}elseif($act == 'welcome'){
    $file =VIEW.DS.$mol.DS.$ctl.DS.$act.HTL;
    include $file;
}
