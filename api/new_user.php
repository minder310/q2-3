<?php
include_once "./base5.php";
$user=$_POST;
unset($user['pw2']);
$num=$User->find(["acc"=>$user["acc"]]);
if($num>0){
    echo 0;
}else{
    $a=$User->save(["acc"=>$user['acc'],"pw"=>$user['pw'],"email"=>$user['email']]);
    echo 1;
}