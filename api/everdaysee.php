<!-- 每日進站人數 -->
<?php
include_once "../api/base5.php";

$today=$Total->find(["date"=>date("Y-m-d")]);
if(isset($today)){
    $today['total']=$today['total']+1;
    $Total
}else{
    $Total->save(["total"=>1]);
}