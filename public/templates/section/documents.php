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
                <?php if ($categories): ?>
                <div class = "content">
                    <div class = "title"><?= $title ?></div>
                    <div class = "content-description">
                        <?php require_once WWW . "/inc/message.php"?>
                        <table>
                            <tr>
                                <th>ID</th>
                                <th>Название документа</th>
                                <th>Дата публикации</th>
                                <th></th>
                            </tr>
                            <?php foreach ($documents AS $item): ?>
                            <tr>
                                <td><?= $item[0] ?></td>
                                <td><?= dataReplace($item[2]) ?></td>
                                <td><?= $item[3] ?></td>
                                <td><a onclick = "return confirmDelete()" href = "/delete/documents/<?= $item[0] ?>">Удалить</a> | 
                                    <a href = "/update/documents/<?= $item[0] ?>">Редактировать</a></td>
                            </tr>
                            <?php endforeach ?>
                        </table>
                        <input type = "submit" class = "styler" value = "Новая публикация" onclick = "redirectToPage('/posting/documents')">
                    </div>
                </div>
                <?php else: ?>
                    <div class = "content">
                    <div class = "title">#412 - Категории документов не найдены</div>
                    <div class = "content-description">
                        1. Доступ к управлению документам временно запрещен. <br>
                        2. Пожалуйста, убедитесь, что Вы опубликовали хотя бы одну категорию документов. <br>
                        </div>
                    </div>
                <?php endif ?>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>