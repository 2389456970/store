<?php
// echo "亲，你好";
$keys = array_keys($arr);
$values = array_values($arr);
$str1 = "`".implode('`,`', $keys)."`";
$str2 = "'".implode("','", $values)."'";
$sql = "insert into ad($str1) values($str2)";
echo $sql;
$result = add($sql);
echo "<pre>";
print_r($result);
echo "</pre>";