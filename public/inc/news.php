<?php defined("ACCESS") or exit("Access is deniend!") ?>

<div class = "widget">
    <div class = "title">Информационная лента</div>
    
    <?php foreach ($news AS $item): ?>
    <div class = "news-slide">
        <div class = "news-date">Дата публикации: <?= $item[1] ?></div>
        <div class = "widget-description"><?= $item[2] ?></div>
     </div>
    <?php endforeach ?> 
                    
    <div id = "news-button">
        <input type = "submit" class = "styler" id = "prev" onclick = "swypeSlides(1)" value = "Предыдущая">
        <input type = "submit" class = "styler" id = "next" onclick = "swypeSlides(-1)" value = "Следующая">
    </div>
</div>