<!-- 最新文章 -->
<style>
    .full {
        display: none;
    }

    .news-title {
        cursor: pointer;
    }
</style>
<fieldset>
    <legend>目前位置:首頁>最新文章區</legend>
    <table>
        <tr>
            <td width="30%" style="background-color: #eee;">標題</td>
            <td width="50%">內容</td>
        </tr>
        <?php
        // 一頁有幾篇文章。
        $div = 5;
        // 總共可以顯示的文章有幾篇。
        $all = $News->count(['sh' => 1]);
        // 總共有幾頁。
        $page = ceil($all / $div);
        // 宣告page現在第幾頁。
        $now = (!isset($_GET['p'])) ? $_GET['p'] = 1 : $_GET['p'];
        // 顯示的的文章，部分。
        $nownews = ($now - 1) * $div;
        // sql輸出
        $nowpagenews = $News->all(" limit $nownews , $div");
        foreach ($nowpagenews as $key) {
        ?>
            <tr>
                <td class="news-title"><?= $key['title'] ?></td>
                <td>
                    <div class="short" id="text"><?= mb_substr($key["text"], 0, 20) ?>...</div>
                    <div class="full" id="text-all"><?= nl2br($key["text"]) ?></div>
                </td>
                <td>
                    <?php
                    // 要是使用者有登錄，顯示讚，要是沒有不顯示讚。
                    if (isset($_SESSION['login'])) {
                        if ($Log->find(['user' => $_SESSION['login'], "news" => $key['id']]) > 0) {
                            // 收回讚區
                            ?><a href="#" class="goods" data-news="<?=$key['id']?>" data-user="<?=$_SESSION['login']?>">收回讚</a><?php
                        } else {
                            // 點擊讚區
                            ?><a href="#" class="goods" data-news="<?=$key['id']?>" data-user="<?=$_SESSION['login']?>">讚</a><?php
                        }
                    }
                    ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</fieldset>
<?php
// 向左滑動選項。
if ($now > 1) { ?>
    <a href="?do=news&p=<?= ($now - 1) ?>">
        < </a>
        <?php } ?>
        <?php
        // 顯示目前滑動選項。
        for ($i = 1; $i <= $page; $i++) {
            $size = ($i == $_GET['p']) ? "26px" : "16px"; ?>
            <a href="?do=news&p=<?= $i ?>" style="font-size:<?= $size ?>;"> <?= $i ?> </a>
        <?php } ?>
        <?php
        // 向右滑動選項。
        if ($now < $page) { ?>
            <a href="?do=news&p=<?= ($now + 1) ?>"> > </a>
        <?php } ?>
        <script>
            // 當news-title被點擊時，啟動function，點擊的這個的下一個，小孩交替顯示。
            $(".news-title").on("click", function() {
                // 點擊的這個，的下一個，的小孩，重複顯示。
                // $(this).next().children('.short,.full').toggle()
                $(this).next().children('.short,.full').toggle();
            })
        </script>