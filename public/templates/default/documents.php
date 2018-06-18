<!DOCTYPE html>
<html>
    <?php require_once WWW . "/inc/head.php" ?>
    <body>
        <?php require_once WWW . "/inc/header.php" ?>
        <main id = "main">
            <div id = "sidebar-left">
                <?php require_once WWW ."/inc/sort.php" ?>
                
                <?php if ($categories): ?>
                    <div class = "widget">
                        <?php foreach ($categories AS $main): ?>
                            <div class = "title"><?= $main[1] ?></div>
                        <?php if ( isset($main["sub"]) ): ?>
                            <?php foreach ($main["sub"] AS $sub): ?>
                                <a href = "?param=<?= $sub[0] ?>"><?= $sub[1] ?></a>
                            <?php endforeach ?>
                        <?php endif ?>
                        <?php endforeach ?>
                    </div>
                <?php endif ?>
            </div>
            
            <div id = "content">
                <?php if ($documents == FALSE): ?>
                    <?php require_once WWW . "/inc/content.php" ?>
                <?php endif ?>
                
                <?php foreach ($documents AS $item): ?>
                <div class = "content">
                    <div class = "title"><?= $item[5] ?></div>
                    <div class = "content-panels">
                        <ul>
                            <li>Дата публикации документа: <?= $item[6] ?></li>
                            <li>Категория документа: <?= $item[1] ?></li>
                        </ul>
                    </div>
                    <div class = "content-description"><?= $item[7] ?></div>
                    <div class = "content-button">
                        <a href = "<?= $item[8] ?>" title = "Открыть в новой вкладке" target = "_blank">
                            Открыть документ в CloudDrive</a>
                    </div>
                </div>
                <?php endforeach ?>
                
                <?php require_once WWW . "/inc/pagination.php" ?>  
            </div>
            
            <div id = "sidebar-right">
                <?php require_once WWW . "/inc/yandex.php" ?>
                <?php require_once WWW . "/inc/menu.php" ?>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>