<!-- 忘記密碼頁面 -->
<fieldset>
    <p>請輸入信箱已找回密碼</p>
    <input type="email" name="email" id="email">
    <p id="pw"></p>
    <button onclick="FindPw()">尋找</button>
</fieldset>
<script>
    function FindPw(){
        email=$("#email").val();
        $.post("./api/find_pw.php",{email},(e)=>{
            console.log("回傳值",e);
            $("#pw").text(e);
        })
    }
</script>