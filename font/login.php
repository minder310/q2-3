<!-- 登陸頁面 -->
<fieldset>
    <legend>會員登入頁面</legend>
    <table>
        <tr>
            <td>帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td>密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
        <tr>
            <td><button onclick="login()">登入</button></td>
            <td><button onclick="reset()">清除</button></td>
            <td><a href="?do=forgetpw">忘記密碼</a></td>
            <td><a href="?do=newuser">尚未註冊</a></td>
        </tr>
    </table>
</fieldset>

<script>
    function reset() {
        $("#acc,#pw").val("");
    }

    function login() {
        let user = {
            "acc": $("#acc").val(),
            "pw": $("#pw").val()
        }
        $.post("./api/login.php", user, (e) => {
            console.log(e);
            if (parseInt(e) === 2) {
                alert("恭喜登入成功")
                if ($_SESSION["login"] == "admin") {
                    location.href = "back.php"
                } else {
                    location.href = "index.php";
                }
            } else if (parseInt(e) === 1) {
                alert("密碼錯誤")
            } else if (parseInt(e) === 0) {
                alert("無此帳號")
            }
        })
    }
</script>