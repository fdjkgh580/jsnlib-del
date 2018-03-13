# jsnlib-del
聰明的刪除檔案與路徑。

## 初始化
````php
require_once 'vendor/autoload.php';
$del = new Jsnlib\Del;
````
## 取得檔案與路徑的分佈
若要取得路徑 D 底下的所有路徑與檔案，得到的結果分成了 dir 與 file 兩個區塊列表。
````php 
$del->get("D");
````

## 刪除包含自己
路徑 D 會一併刪除。
````php
$del->all();
````

## 刪除自己之下
僅刪除路徑 D 之後的檔案，路徑 D 並不會刪除。
````php
$del->under();
````
