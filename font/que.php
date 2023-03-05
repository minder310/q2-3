<!-- 問卷調查 -->
<fieldset>
    <legend>目前位置>首頁>問卷調查</legend>
    <table>
        <tr>
            <td>編號</td>
            <td>問卷題目</td>
            <td>投票總數</td>
            <td>結果</td>
            <td>狀態</td>
        </tr>
        <?php
        // 步驟解析
        // 1.提取出標題
        // 2.提取出所有票數加總
        // 3.要將id傳至後台投票系統，與結果。
        $q = $Que->all(["parent" => 0]);
        foreach ($q as $key) {
            // 所有票數假總區。
            $vote_sum=$Que->sum("count",["parent"=>$key['id']]);
            ?>
            <tr>
                <td></td>
                <td><?= $key['text'] ?></td>
                <td><?= $vote_sum ?></td>
                <td><a href="?do=que_result&id=<?=$key['id']?>">結果</a></td>
                <td>
                    <?php
                    if (empty($_SESSION['login'])) {
                    ?>
                        <a href="?do=login">請先登錄</a>
                    <?php
                    } else {
                    ?>
                        <a href="?do=que_vote&id=<?=$key['id']?>">參與投票</a>
                    <?php
                    }
                    ?>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</fieldset>