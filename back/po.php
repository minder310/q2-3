<!-- 帳號管理 -->
<?php
$all = $User->all();
?>
<fieldset>
    <legend>帳號管理</legend>
    <!-- 
        1.顯示所有帳號與密碼。
        2.密碼要呈現星號。
        3.可以刪除。傳送id刪除。
    -->
    <form action="./api/deluser.php" method="post">
        <table>
            <tr>
                <td style="background-color: #eee;">帳號</td>
                <td style="background-color: #eee;">密碼</td>
                <td style="background-color: #eee;">刪除</td>
            </tr>
            <?php
            foreach ($all as $key) {
            ?>
                <tr>
                    <td><?= $key['acc'] ?></td>
                    <td><input type="password" name="pw" id="pw" value="<?= $key['pw'] ?>" readonly="true"></td>
                    <td><input type="checkbox" name="id" id="id" value="<?= $key['id'] ?>"></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <button>確定刪除</button>
        <button type="reset">清空選取</button>
    </form>
    <!-- 
        1.新增會員
     -->
    <h1>新增會員</h1>
    <table>
        <p style="color: red;">*請設定您要註冊的帳號及密碼(最長12個字元)</p>
        <tr>
            <td style="background-color: #eee;">step1:登入帳號</td>
            <td><input type="text" id="acc" name="acc"></td>
        </tr>
        <tr>
            <td style="background-color: #eee;">step2:登入密碼</td>
            <td><input type="password" id="pw" name="pw"></td>
        </tr>
        <tr>
            <td style="background-color: #eee;">step3:再次確認密碼</td>
            <td><input type="password" id="pw2" name="pw2"></td>
        </tr>
        <tr>
            <td style="background-color: #eee;">step4:信箱(忘記密碼時使用)</td>
            <td><input type="email" id="email" name="email"></td>
        </tr>
    </table>
    <button onclick="setin()">註冊</button>
    <button onclick="rest()">清除</button>
</fieldset>
<script>
    function rest() {
        $("#acc").val("");
        $("#pw").val("");
        $("#pw2").val("");
        $("#email").val("");
    }

    function setin() {
        let user = {
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            pw2: $("#pw2").val(),
            email: $("#email").val(),
        }
        if (user.acc == "" || user.pw == "" || user.pw2 == "" || user.email == "") {
            alert("不可以空白")
        } else if (user.pw != user.pw2) {
            alert("密碼錯誤")
        } else {
            $.post("./api/new_user.php", user, (e) => {
                if (e == 0) {
                    alert("帳號重複")
                } else {
                    alert("恭喜註冊成功。")
                }
            })
        }
    }
</script>