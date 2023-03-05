<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0039) -->
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<title>健康促進網</title>
	<link href="./css/css.css" rel="stylesheet" type="text/css">
	<script src="./js/jquery-1.9.1.min.js"></script>
	<script src="./js/js.js"></script>
</head>

<body>
	<?php include_once "./api/base5.php"; ?>
	<div id="alerr" style="background:rgba(51,51,51,0.8); color:#FFF; min-height:100px; width:300px; position:fixed; display:none; z-index:9999; overflow:auto;">
		<pre id="ssaa"></pre>
	</div>
	<iframe name="back" style="display:none;"></iframe>
	<div id="all">
		<div id="title">
			<?= date("m月d號 l") ?>|今日導覽:<?= $Total->find(['date' => date("Y-m-d")])['total']; ?>|累積導覽:<?= $Total->sum('total') ?>

			<a href="./index.php" style="float: right;">回首頁</a>
		</div>
		<div id="title2">
			<img src="./icon/02B01.jpg" alt="健康促進網-回首頁">
		</div>
		<div id="mm">
			<div class="hal" id="lef">
				<a class="blo" href="?do=po">帳號管理</a>
				<a class="blo" href="?do=news">分類網誌</a>
				<a class="blo" href="?do=pop">最新文章管理</a>
				<a class="blo" href="?do=know">講座管理</a>
				<a class="blo" href="?do=que">問卷管理</a>
			</div>
			<div class="hal" id="main">
				<div>
					<marquee behavior="" direction="" style="width: 78%;">123456789</marquee>
					<span style="width:18%; display:inline-block;">
						<?php
						if (isset($_SESSION['login'])) {
							if ($_SESSION['login'] == "admin") { ?>
								<a href="back.php">管理</a>|<a href="./unlogin.php">登出</a>
							<?php } else if (isset($_SESSION['login'])) { ?>
								<a href="./unlogin.php">登出</a>
							<?php }
						} else { ?>
							<a href="?do=login">會員登入</a>
						<?php  } ?>
					</span>
					<div class="">
						<!-- 如果do有東西的話就沒有東西的話就$_GET['do']="home" -->
						<?php ($_GET['do'])??$_GET['do']="home";
								// 將資料塞進資料夾中。
								$file="./back/".$_GET['do'].".php";
								// 驗證資料夾是否有這個資料。
								if(file_exists($file)){
									// 載入相對應的檔案。
									include "$file";
								}else{
									include "$file";
								}
						?>
					</div>
				</div>
			</div>
		</div>
		<div id="bottom">
			本網站建議使用：IE9.0以上版本，1024 x 768 pixels 以上觀賞瀏覽 ， Copyright © 2023健康促進網社群平台 All Right Reserved
			<br>
			服務信箱：health@test.labor.gov.tw<img src="./home_files/02B02.jpg" width="45">
		</div>
	</div>

</body>

</html>