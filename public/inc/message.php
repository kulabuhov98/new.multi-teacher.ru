<?php defined("ACCESS") or exit("Access is deniend!") ?>

<?php if ( isset($_SESSION["success"]) ): ?>
    <div id = "message-success"><?= $_SESSION["success"] ?></div>
    <?php unset($_SESSION["success"]) ?>
<?php elseif ( isset($_SESSION["danger"]) ) : ?>
    <div id = "message-danger"><?= $_SESSION["danger"] ?></div>
    <?php unset($_SESSION["danger"]) ?>
<?php endif ?>