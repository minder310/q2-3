<!-- 分類文章 -->
<!-- 取出相對應的資料位置 -->
<div>
    目前位置:首頁>分類網誌><span id="type">健康新知</span>
</div>
<fieldset style="display: inline-block;">
    <legend>分類網誌</legend>
    <?php
    foreach($News->type as $key => $type){ 
    ?>
    <a href="#" class="type" data-type="<?=$key?>" style="display: block;">
    <?=$type?>
    </a>
    <?php
    }
    ?>
</fieldset>
<fieldset style="display: inline-block;width:75%">
    <legend>文章列表</legend>
    <div id="content">

    </div>
</fieldset>
<script>
    // 先寫下步驟，
    // 1.當點擊列表時，上面的id=type也會跟著改變。
    $(".type").on("click",function(){
        // id=type的text內容，更改成點擊物品的text內容。
        $("#type").text($(this).text());
        getlist($(this).data("type"));
    })
    // 2.傳送type值給後臺進行資料提取。
    function getlist(type){
        $.post("./api/get_list.php",{type},(e)=>{
            // console.log ("回傳資料",e);
            list=e;
            $("#content").html(list);
        })
    }
    // 取出文章，利用id取出文章值。
    function getNews(id){
        $.post("./api/get_news.php",{id},(e)=>{
            $("#content").html(e);
        })
    }
    
</script>