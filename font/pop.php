<!-- 人氣文章 -->
<!-- 先宣告隱藏div，hove時顯示。 -->
<style>
    .full {
        display: none;
        /* 這句是一定要的。 */
        position: absolute;
        width: 300px;
        height: 300px;
        overflow: auto;
        z-index: 99;
        background-color: rgb(100, 100, 100);
        color: white;
    }
</style>
<?php
// 分頁步驟。
// 1.先宣告這有多少
// 2.取出所有顯示文章數量。
// 3.1/2即可顯示頁數。
// 4.用$_get帶值，並且顯示頁數。
// 5.用all帶出要顯示的文章。
$div = 5;
$all = $News->count(["sh" => 1]);
$page = ceil($all / $div);
($_GET['p']) ?? $_GET['p'] = 1;
$news = ($_GET['p'] - 1) * $div;
$seenews = $News->all(" limit $news,$div");
?>
<fieldset>
    <legend>目前位置>首頁>人氣文章</legend>
    <table>

        <tr>
            <td width="30%">標題</td>
            <td width="30%">內容</td>
            <td width="30%">人氣</td>
        </tr>
        <?php
        foreach ($seenews as $key) {
        ?>
            <tr>
                <td><?= $key['title'] ?></td>
                <td>
                    <div class="a"><?= mb_substr($key['text'], 0, 20) ?>...</div>
                    <div class="full"><?= nl2br($key['text']) ?></div>
                </td>
                <!-- 顯示是否為讚的地方。 -->
                <?php
                $a = $Log->find(["user" => $_SESSION['login'], "news" => $key['id']])
                ?>
                <td>
                    <p><?= $key['good'] ?></p>有幾個
                    <img src="./icon/02B03.jpg" alt="" width="28px">
                    <a class="goods" href="#" data-user="<?= $_SESSION['login'] ?>" data-news="<?= $key['id'] ?>"><?= (empty($a)) ? "讚" : "收回讚" ?></a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</fieldset>
<?php
if ($_GET['p'] > 1) { ?>
    <a href="?do=pop&p=<?= ($_GET['p'] - 1) ?>">
        < </a>
        <?php } ?>
        <?php
        for ($i = 1; $i <= $page; $i++) {
            $size = ($i == $_GET['p']) ? "26px" : "16px";
        ?>
            <a href="?do=pop&p=<?= $i ?>" style="font-size:<?= $size ?> ;"> <?= $i ?> </a>
        <?php
        }
        ?>
        <?php
        if ($_GET['p'] < $page) { ?>
            <a href="?do=pop&p=<?= ($_GET['p'] + 1) ?>"> > </a>
        <?php } ?>
        <script>
            $(".a").hover(
                function() {
                    $(this).siblings(".full").show()
                },
                function() {
                    $(this).siblings(".full").hide()
                }
            )
            $(".full").hover(
                function(){
                    $(this).show()
                },
                function(){
                    $(this).hide()
                }
            )
        </script>