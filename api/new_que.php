<?php
include_once "./base5.php";
dd($_POST);
// 先存入題目題取出
// 提取出，題目id並且，塞進問題的parent中。
$Que->save(['text'=>$_POST['title']]);
$id=$Que->find(['text'=>$_POST['title']]);
foreach($_POST['list'] as $key => $val){
    $Que->save(["text"=>$val,"parent"=>$id['id']]);
}
