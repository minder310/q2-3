<!-- 分類文章 -->
<!-- 取出相對應的資料位置 -->
<div>
    目前位置:首頁>分類網誌><span id="type">健康新知</span>
</div>
<fieldset>
    <legend>分類網誌</legend>
    <?php
    foreach($News->type as $key => $type){ ?>
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