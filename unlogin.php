<!-- 登出頁面。 -->
<?php
 include_once "./api/base5.php";
 unset($_SESSION['login']);
 to("./index.php");