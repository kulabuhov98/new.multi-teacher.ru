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
                            <input type = "email" name = "email" required 
                                   placeholder = "| Адрес электронной почты" value = "<?= $account[1] ?>" autocomplete = "off">
                            <input type = "text" name = "surname" required 
                                   placeholder = "| Фамилия" value = "<?= $account[3] ?>">
                            <input type = "text" name = "name" required 
                                   placeholder = "| Имя" value = "<?= $account[4] ?>">
                            <input type = "text" name = "patronymic" required 
                                   placeholder = "| Отчество" value = "<?= $account[5] ?>">
                            <input type = "text" name = "job" required 
                                   placeholder = "| Место работы" value = "<?= $account[6] ?>">
                            <input type = "text" name = "year" required 
                                   placeholder = "| Год начала работы в ОУ" value = "<?= $account[7] ?>">
                            <textarea type = "text" name = "lessons" required 
                                      placeholder = "| Список преподаваемых дисциплин"><?= $account[8] ?></textarea>
                            <textarea type = "text" name = "information" required 
                                      placeholder = "| Дополнительная информация"><?= $account[10] ?></textarea>
                            <input type = "text" name = "manager" required 
                                   placeholder = "| Классное руководство" value = "<?= $account[9] ?>">
                            <input type = "submit" name = "profile" class = "styler" value = "Сохранить изменения">
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