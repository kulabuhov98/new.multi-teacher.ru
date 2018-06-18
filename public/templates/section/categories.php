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
                                <th>Название категории</th>
                                <th></th>
                            </tr>
                            <?php foreach ($categories AS $main): ?>
                                <tr class = "content-section">
                                    <td><?= $main[0] ?></td>
                                    <td><?= $main[1] ?></td>
                                    <td><a onclick = "return confirmDelete()" href = "/delete/categories/<?= $main[0] ?>">Удалить</a> | 
                                        <a href = "/update/categories/<?= $main[0] ?>">Редактировать</a></td>
                                </tr>
                                
                                <?php if ( isset($main["sub"]) ): ?>
                                    <?php foreach ($main["sub"] AS $sub): ?>
                                        <tr>
                                            <td><?= $sub[0] ?></td>
                                            <td><?= $sub[1] ?></td>
                                            <td><a onclick = "return confirmDelete()" href = "/delete/categories/<?= $sub[0] ?>">Удалить</a> | 
                                                <a href = "/details/categories/<?= $sub[0] ?>">Редактировать</a></td>
                                        </tr>
                                    <?php endforeach ?>
                                <?php endif ?>
                            <?php endforeach ?>
                        </table>
                        <input type = "submit" class = "styler" value = "Новая публикация" onclick = "redirectToPage('/posting/categories')">
                    </div>
                </div>
            </div>
        </main>
        <?php require_once WWW . "/inc/footer.php" ?>
    </body>
</html>