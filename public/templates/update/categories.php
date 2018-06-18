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
                            <input type = "text" name = "caption" required 
                                   placeholder = "| Заголовок категории" value = "<?= $category[1] ?>">
                            <select name = "category" size = "10" required
                                <?php if ($category[2] == 0): ?> disabled <?php endif ?>>
                                <option value = "0">Заголовок подкатегорий</option>
        			<?php foreach ($categories AS $item): ?>
                                    <option value = "<?= $item[0] ?>" 
                                        <?php if ($category[2] == $item[0]): ?> selected <?php endif ?>>
                                        <?= $item[1] ?>
                                    </option>
        			<?php endforeach ?>
                            </select>
                            <input type = "submit" name = "details" class = "styler" value = "Сохранить изменения">
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