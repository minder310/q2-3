<?php
include_once "./base5.php";
// 1.查詢資料庫內type的資料。
$a = $_POST["type"];
$list = $News->all(["type" => $a, "sh" => 1]);
foreach ($list as $key) { ?>
    <a href="" style="display: block;" onclick="getNews(<?= $key['id'] ?>)">
        <?= $key["title"] ?>
    </a>
<?php } ?>