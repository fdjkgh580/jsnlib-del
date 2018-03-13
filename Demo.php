<?
require_once 'vendor/autoload.php';

$del = new Jsnlib\Del;

$result = $del->get("D");
if ($result === false) die("指定的路徑不存在!");
print_r($result);

//一、刪除包含自己
// $result = $del->all();
// if ($result) echo "清除資料夾完畢!";


//二、刪除自己之下
$result = $del->under();
if ($result) echo "清除資料夾完畢!";