<fieldset>
    <legend>目前位置>首頁>問卷調查><span><?= $Que->find(["id" => $_GET['id']])['text']; ?></span></legend>
    <h3><?= $Que->find(["id" => $_GET['id']])['text']; ?></h1>
    <table>

        <?php
        // 1.先用id取出取出題目。
        // 2.再用id取出相關問題。
        // 3.計算票數相除並顯示為長條。
        
        //取出想相關題目。 
        $all_q=$Que->all(["parent"=>$_GET['id']]);
        // 取出總得票數。
        $all_vote=$Que->sum("count",["parent"=>$_GET['id']]);
        foreach($all_q as $key){
        ?>
        <tr>
            <td><?=$key['text']?></td>
            <td><?php
            if($key['count']>0){
                echo $key['count']/$all_vote;
            }else{
                echo 0;
            }
            ?></td>
        </tr>
        <?php 
        }
        ?>
    </table>
</fieldset>