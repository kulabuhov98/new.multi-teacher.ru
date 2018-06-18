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
                <?php if ($news == TRUE): ?>
                    <div class = "content">
                        <div class = "title"><?= $title ?></div>
                        <div class = "content-description">
                            <?php require_once WWW . "/inc/message.php"?>
                            <form method = "POST">
                                <textarea type = "text" name = "description" required 
                                          placeholder = "| Краткое описание"><?= $news[2] ?></textarea>
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