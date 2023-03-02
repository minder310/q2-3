<?php
include_once "./base5.php";
// 1.查詢資料庫內type的資料。
$a = $_POST["id"];
$list = $News->find(["id" => $a, "sh" => 1]);
?>
<pre>
    <?=$list['text']?>
</pre>