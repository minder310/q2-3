<?php
// 1.取出標題
// 2.取出選項
$list=$Que->all(["parent"=>$_GET['id']]);
// 3.建立表單
// 4.送出資料
// 建立api
?>
<fieldset>
    <legend>目前位置>首頁>問卷調查><span><?= $Que->find(["id"=>$_GET['id']])['text']?></span></legend>
    <table>

        <form action="./api/que_in_sql.php" method="post">
            <table>
                <?php
                foreach($list as $key){
                ?>
                <tr>
                    <td><input type="radio" name="id" id="id" value="<?=$key['id']?>"><?=$key['text']?></td>
                </tr>
                <?php    
                }
                ?>
            </table>
            <button>我要投票</button>
        </form>
    </table>
</fieldset>