<!-- 刪除使用者 -->
<?php 
include_once "./base5.php";
dd($_POST);
$User->del(["id"=>$_POST['id']]);
to("../back.php?do=po");