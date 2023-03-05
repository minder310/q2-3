<!-- 最新文章管理 -->
<fieldset>
    <legend>最新文章管理</legend>
    <form action="./api/del_sh_news.php" method="post">
        <table>

            <tr>
                <td>編號</td>
                <td>標題</td>
                <td>顯示</td>
                <td>刪除</td>
            </tr>
            <!-- 
                1.取出所有文章ok
                2.設定有sh=1的顯示ok
                3.一頁3篇文章。
                4.可以刪除文章 
            -->
            <?php
            $div=3;
            $allnews=$News->count("id");
            $p=ceil($allnews/$div);
            ($_GET['p'])??$_GET['p']=1;
            $nownews=($_GET['p']-1)*$div;
            $news = $News->all(" limit $nownews,$div");
            foreach ($news as $key) {
            ?>
                <tr>
                    <td><?= $key['id'] ?></td>
                    <td><?= $key['title'] ?></td>
                    <td><input type="checkbox" name="sh[]" id="sh" value="<?=$key['id']?>" 
                    <?= ($key['sh']==1)?"checked":""?>></td>
                    <td><input type="checkbox" name="del[]" id="del" value="<?=$key['id']?>"></td>
                    <input type="hidden" name="id[]" value="<?=$key['id']?>">
                </tr>
            <?php
            }
            ?>
        </table>
        <button>確定修改</button>
    </form>
</fieldset>
    <!-- 增加 -->
    <?php 
    if($_GET["p"]>1){
    ?>
    <a href="back.php?do=pop&p=<?=($_GET['p']-1)?>"><</a>
    <?php
    }
    ?>
    <?php for($i=1;$i<=$p;$i++){
        $size=($i==$_GET['p'])?"26px":"16px"?>
        <a href="back.php?do=pop&p=<?=$i?>" style="font-size: <?=$size?>;"><?=$i?></a>        
    <?php 
    }
    if($_GET["p"]<$p){
    ?>
    <a href="back.php?do=pop&p=<?=($_GET['p']+1)?>">></a>
    <?php
    }
    ?>