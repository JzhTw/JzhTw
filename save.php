<?php


// echo '<pre>',print_r($_POST),'</pre>';

$connection = require_once './Connection.php';

$id = $_POST['id'] ?? "";
// $id = isset($_POST['id']) ? $_POST['id'] : ""; 等同以上
// $id = $_POST['id'] ? $_POST['id'] : "";
// 沒有宣告變數之前仍然會出現錯誤訊息。而 PHP 7.0 開始支援兩個問號 (??) 判斷並賦值，而且不用事先使用 isset() 判斷變數是否存在：

if($id){
    $connection->updateNote($id,$_POST);
}else{
    $connection->addNote($_POST);
}

header('Location: index.php');