<!-- 問卷管理 -->
<fieldset>
    <legend>新增問倦</legend>
    <form action="./api/new_que.php" method="post">
        <table class="top">
            <tr>
                <td style="background-color: #eee;">問卷名稱</td>
                <td><input type="text" name="title" id="title"></td>
            </tr>
            <tr>
                <td>選項</td>
                <td><input type="text" name="list[]" id="list"></td>
                <td><button type="button" onclick="newlist()">更多</button></td>
            </tr>
        </table>
        <button>新增</button><button type="reset">清空</button>
    </form>
</fieldset>
<script>
    function newlist(){
        let a=`<tr>
                <td>選項</td>
                <td><input type="text" name="list[]" id="list"></td>
                <td><button type="button" onclick="newlist()">更多</button></td>
            </tr>`
        $(".top").append(a);
    }
</script>

