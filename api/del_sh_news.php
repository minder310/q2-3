<?php
include_once "./base5.php";

if (isset($_POST['id'])) {
    if (isset($_POST['del'])) {
        foreach ($_POST['del'] as $key => $val) {
            $News->del(["id" => $val]);
        }
    }
    foreach ($_POST['id'] as $key => $val) {
        if(in_array($val,$_POST['sh'])){
            $News->save(['id'=>$val,'sh'=>1]);
        }else{
            $News->save(['id'=>$val,'sh'=>0]);
        }
    }
}
to("../back.php?do=pop");
