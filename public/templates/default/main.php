<!DOCTYPE html>
<html>
    <?php require_once WWW . "/inc/head.php" ?>
    <body>
        <?php require_once WWW . "/inc/header.php" ?>
        <main id = "main">
            <div id = "sidebar-left">
                <div class = "widget">
                    <div id = "profile-avatar">
                        <img src = "/upload/avatar.jpg" alt = "Изображение недоступно">
                    </div>
                    <div id = "profile-panels">
                        <ul>
                            <li>ФИО преподавателя: <?= $account[3] . " " . $account[4] . " " . $account[5] ?></li>
                            <li>E-mail - адрес преподавателя: <?= $account[1] ?></li>
                            <li>Место работы: <?= $account[6] ?></li>
                            <li>Год начала работы в ОУ: <?= $account[7] ?></li>
                            <li>Преподаваемые дисциплины: <?= $account[8] ?></li>
                            <li>Классное руководство: <?= $account[9] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div id = "content">
                <div id = "lite-information"> <p><?= $account[10] ?></p> </div>
                
                <?php if ($achievements == FALSE): ?>
                    <?php require_once WWW . "/inc/content.php" ?>
                <?php endif ?>
                
                <?php foreach ($achievements AS $item): ?>
                <div class = "content">
                    <div class = "title"><?= $item[1] ?></div>
                    <div class = "content-panels">
                        <ul>
                            <li>Год получения свидетельства: <?= $item[2] ?></li>
                        </ul>
                    </div>
                    <div class = "content-description"><?= $item[3] ?></div>
                    <div class = "content-button">
                        <a href = "<?= $item[4] ?>" title = "Открыть в новой вкладке" target = "_blank">
                            Открыть свидетельство в CloudDrive</a>
                    </div>
                </div>
                <?php endforeach ?>
                
                <?php require_once WWW . "/inc/pagination.php" ?>  
            </div>
            
            <div id = "sidebar-right">
                <?php require_once WWW . "/inc/yandex.php" ?>
                <?php require_once WWW . "/inc/menu.php" ?>
                <?php require_once WWW . "/inc/news.php" ?>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>