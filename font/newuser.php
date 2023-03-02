<fieldset>
    <legend>會員註冊</legend>
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
    function rest(){
        $("#acc").val("");
        $("#pw").val("");
        $("#pw2").val("");
        $("#email").val("");
    }
    function setin(){
        let user={
            acc:$("#acc").val(),
            pw:$("#pw").val(),
            pw2:$("#pw2").val(),
            email:$("#email").val(),
        }
        if(user.acc==""||user.pw==""||user.pw2==""||user.email==""){
            alert("不可以空白")
        }else if(user.pw!=user.pw2){
            alert("密碼錯誤")
        }else{
            $.post("./api/new_user.php",user,(e)=>{
                if(e==0){
                    alert("帳號重複")
                }else{
                    alert("恭喜註冊成功。")
                }
            })
        }
    }
</script>