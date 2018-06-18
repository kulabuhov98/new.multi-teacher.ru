<!DOCTYPE html>
<html>
    <?php require_once WWW . "/inc/head.php" ?>
    <body>
        <?php require_once WWW . "/inc/header.php" ?>
        <main id = "main">
            <div id = "sidebar-left">
                <?php require_once WWW . "/inc/account.php" ?>
                <?php require_once WWW . "/inc/sections.php" ?>
            </div>

            <div id = "content-table">
                <div class = "content">
                    <div class = "title"><?= $title ?></div>
                    <div class = "content-description">
                        <?php require_once WWW . "/inc/message.php"?>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Описание новости</th>
                                <th>Дата публикации</th>
                                <th></th>
                            </tr>
                            <?php foreach ($news AS $item): ?>
                            <tr>
                                <td><?= $item[0] ?></td>
                                <td><?= dataReplace($item[2]) ?></td>
                                <td><?= $item[1] ?></td>
                                <td><a onclick = "return confirmDelete()" href = "/delete/news/<?= $item[0] ?>">Удалить</a> | 
                                    <a href = "/update/news/<?= $item[0] ?>">Редактировать</a></td>
                            </tr>
                            <?php endforeach ?>
                        </table>
                        <input type = "submit" class = "styler" value = "Новая публикация" onclick = "redirectToPage('/posting/news')">
                    </div>
                </div>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>