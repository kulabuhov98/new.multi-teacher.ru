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
                                <th>Название мероприятия</th>
                                <th>Дата проведения</th>
                                <th></th>
                            </tr>
                            <?php foreach ($feed AS $item): ?>
                            <tr>
                                <td><?= $item[0] ?></td>
                                <td><?= dataReplace($item[1]) ?></td>
                                <td><?= $item[2] ?></td>
                                <td><a onclick = "return confirmDelete()" href = "/delete/feed/<?= $item[0] ?>">Удалить</a> | 
                                    <a href = "/update/feed/<?= $item[0] ?>">Редактировать</a></td>
                            </tr>
                            <?php endforeach ?>
                        </table>
                        <input type = "submit" class = "styler" value = "Новая публикация" onclick = "redirectToPage('/posting/feed')">
                    </div>
                </div>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>