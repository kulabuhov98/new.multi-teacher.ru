<!DOCTYPE html>
<html>
    <?php require_once WWW . "/inc/head.php" ?>
    <body>
        <?php require_once WWW . "/inc/header.php" ?>
        <main id = "main">
            <div id = "sidebar-left">
                <?php require_once WWW . "/inc/menu.php" ?>
            </div>

            <div id = "content">
                <?php if ($messages == FALSE): ?>
                    <?php require_once WWW . "/inc/content.php" ?>
                <?php endif ?>
                
                <?php foreach ($messages AS $item): ?>
                <div class = "content">
                    <div class = "title"><?= $item[1] . " " . $item[2] . " " . $item[3] ?></div>
                    <div class = "content-panels">
                        <ul>
                            <li>Дата публикации: <?= $item[4] ?></li>
                        </ul>
                    </div>
                    <div class = "content-description"><?= $item[6] ?></div>
                </div>
                <?php endforeach ?>
                
                <?php require_once WWW . "/inc/pagination.php" ?>  
            </div>
            
            <div id = "sidebar-right">
                <?php require_once WWW . "/inc/yandex.php" ?>
                <?php require_once WWW . "/inc/news.php" ?>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>