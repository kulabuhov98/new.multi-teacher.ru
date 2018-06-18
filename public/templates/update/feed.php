<!DOCTYPE html>
<html>
    <?php require_once WWW . "/inc/head.php" ?>
    <body>
        <?php require_once WWW . "/inc/header.php" ?>
        <main id = "main">
            <div id = "sidebar-left">
                <?php require_once WWW . "/inc/account.php" ?>
            </div>
            
            <div id = "content">
                <?php if ($feed == TRUE): ?>
                    <div class = "content">
                        <div class = "title"><?= $title ?></div>
                        <div class = "content-description">
                            <?php require_once WWW . "/inc/message.php"?>
                            <form method = "POST">
                                <input type = "text" name = "title" required 
                                       placeholder = "| Краткий заголовок" value = "<?= $feed[1] ?>">
                                <input type = "date" name = "date" required 
                                       placeholder = "| Дата проведения мероприятия" value = "<?= $feed[2] ?>" 
                                       data-lang = "ru" data-large-mode = "true" data-format = "Y-m-d">
                                <textarea type = "text" name = "description" required 
                                          placeholder = "| Краткое описание"><?= $feed[3] ?></textarea>
                                <input type = "url" name = "url" required 
                                       placeholder = "| Адрес в CloudDrive" value = "<?= $feed[4] ?>">
                                <input type = "submit" name = "details" class = "styler" value = "Сохранить изменения">
                            </form>
                        </div>
                    </div>
                <?php else: ?>
                    <?php require_once WWW . "/inc/content.php" ?>
                <?php endif ?>
            </div>
            
            <div id = "sidebar-right">
                <?php require_once WWW . "/inc/sections.php" ?>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>