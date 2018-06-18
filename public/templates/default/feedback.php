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
                <div class = "content">
                    <div class = "title"><?= $title ?></div>
                    <div class = "content-description">
                        <?php require_once WWW . "/inc/message.php" ?>
                        <form method = "POST">
                            <input type = "text" name = "surname" required 
                                   placeholder = "| Фамилия" autocomplete = "off">
                            <input type = "text" name = "name" required 
                                   placeholder = "| Имя" autocomplete = "off">
                            <input type = "text" name = "patronymic" 
                                   placeholder = "| Отчество" autocomplete = "off">
                            <input type = "email" name = "email" required 
                                   placeholder = "| Адрес электронной почты" autocomplete = "off">
                            <input type = "text" name = "subject" required 
                                   placeholder = "| Тема сообщения" autocomplete = "off">
                            <textarea type = "text" name = "message" required 
                                      placeholder = "| Текст сообщения" autocomplete = "off"></textarea>
                            <input type = "text" name = "captcha" required 
                                   placeholder = "| Контрольный вопрос: <?= $captcha["one"] . " + " . $captcha["two"]?>" autocomplete = "off">
                            <input type = "submit" name = "feedback" class = "styler" value = "Отправить сообщение">
                        </form>
                    </div>
                </div>
            </div>
            
            <div id = "sidebar-right">
                <?php require_once WWW . "/inc/yandex.php" ?>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>