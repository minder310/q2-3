<?php
include_once "./base5.php";
// 先接收資料
$user=$_POST['user'];
$news=$_POST['news'];
// 確認資料庫log內有沒有資料。
$a=$Log->find(["user"=>$user,"news"=>$news]);
// 取出news內的資料庫。
$b=$News->find(["id"=>$news]);
if(empty($a)){
    // 增加按讚數，與紀錄哪篇文章被案讚。
    $Log->save(["user"=>$user,"news"=>$news]);
    $b['good']=$b['good']+1;
    $News->save($b);
    echo 0;
}else{
    // 刪除案讚數，與減少哪篇文章被按讚。
    $Log->del(["user"=>$user,"news"=>$news]);
    $b['good']=$b['good']-1;
    $News->save($b);
    echo 1;
}