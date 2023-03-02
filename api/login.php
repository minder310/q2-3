<?php
include_once "./base5.php";
$user=$User->find(["acc"=>$_POST['acc']]);
if(!empty($user)){
    if($user["pw"]==$_POST["pw"]){
        echo 2;
        $_SESSION['login']=$user['acc'];
    }else{
        echo 1;
    }
}else{
    echo 0;
};