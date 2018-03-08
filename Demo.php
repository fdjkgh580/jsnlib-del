<?
require_once 'vendor/autoload.php';


$Del = new Jsnlib\Del;

$result = $Del->get("D");
if ($result == 0) die("指定的路徑不存在!");
print_r($result);

//一、刪除包含自己
// $result = $Del->all();
// if ($result) echo "清除資料夾完畢!";


//二、刪除自己之下
$result = $Del->under();
if ($result) echo "清除資料夾完畢!";


?>