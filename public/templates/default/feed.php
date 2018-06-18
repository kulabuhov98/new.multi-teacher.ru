<!DOCTYPE html>
<html>
    <?php require_once WWW . "/inc/head.php" ?>
    <body>
        <?php require_once WWW . "/inc/header.php" ?>
        <main id = "main">
            <div id = "sidebar-left">
                <?php require_once WWW ."/inc/sort.php" ?>

                <div class = "widget">
                    <div class = "title">Календарь мероприятий</div>
                    <?php foreach ($calendar AS $item): ?>
                    <a href = "?param=<?= $item[0] ?>"><?= $item[0] ?></a>
                    <?php endforeach ?>
                </div>
            </div>

            <div id = "content">
                <?php if ($feed == FALSE): ?>
                    <?php require_once WWW . "/inc/content.php" ?>
                <?php endif ?>
                
                <?php foreach ($feed AS $item): ?>
                <div class = "content">
                    <div class = "title"><?= $item[1] ?></div>
                    <div class = "content-panels">
                        <ul>
                            <li>Дата проведения мероприятия: <?= $item[2] ?></li>
                        </ul>
                    </div>
                    <div class = "content-description"><?= $item[3] ?></div>
                    <div class = "content-button">
                        <a href = "<?= $item[4] ?>" title = "Открыть в новой вкладке" target = "_blank">
                            Открыть отчет о мероприятии в CloudDrive</a>
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