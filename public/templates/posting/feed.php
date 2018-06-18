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
                <div class = "content">
                    <div class = "title"><?= $title ?></div>
                    <div class = "content-description">
                        <?php require_once WWW . "/inc/message.php"?>
                        <form method = "POST">
                            <input type = "text" name = "title" required 
                                   placeholder = "| Краткий заголовок">
                            <input type = "date" name = "date" required 
                                   placeholder = "| Дата проведения мероприятия" 
                                   data-lang = "ru" data-large-mode = "true" data-format = "Y-m-d">
                            <textarea type = "text" name = "description" required 
                                      placeholder = "| Краткое описание"></textarea>
                            <input type = "url" name = "url" required 
                                   placeholder = "| Адрес в CloudDrive">
                            <input type = "submit" name = "posting" class = "styler" value = "Сохранить изменения">
                        </form>
                    </div>
                </div>
            </div>
            
            <div id = "sidebar-right">
                <?php require_once WWW . "/inc/sections.php" ?>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>