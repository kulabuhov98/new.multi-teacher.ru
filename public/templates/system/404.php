<?php define("ACCESS", TRUE) ?>

<!DOCTYPE html>
<html>
    <head>
        <title>#404 - Страница не найдена</title>

        <meta charset = "UTF-8">
        <meta name = "description" content = "">

        <meta name = "viewport" content = "width = device-width, intial-scale = 1.0">
        <link rel = "shortcut icon" href = "/img/favicon.png" type = "image/png">

        <link rel = "stylesheet" href = "/css/libs/formstyler.css">

        <link rel = "stylesheet" href = "/css/base.css">
        <link rel = "stylesheet" href = "/css/media.css">
    </head>
    <body>
        <?php require_once WWW . "/inc/header.php" ?>
        <main id = "main">
            <div id = "sidebar-left">
                <?php require_once WWW . "/inc/menu.php" ?>
            </div>

            <div id = "content">
                <div class = "content">
                    <div class = "title">#404 - Страница не найдена</div>
                    <div class = "content-description">
                        Невозможно обработать текущий URL - адрес. <br>
                        Пожалуйста, убедитесь, что Вы указали правильный адрес страницы. <br>
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