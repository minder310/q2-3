<!-- 每日進站人數 -->
<?php

if(!isset($_SESSION['total'])){
    $today=$Total->find(['date'=>date("Y-m-d")]);
    if(empty($today)){
        // 如果沒有資料。存入今天資料。
        $Total->save(["date"=>date("Y-m-d"),"total"=>1]);
    }else{
        $today['total']++;
    }
    $Total->save($today);
    $_SESSION['total']=1;
}