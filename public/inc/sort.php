<?php defined("ACCESS") or exit("Access is deniend!") ?>

<div class = "widget">
    <div class = "title">Параметры сортировки</div>
    <a href = "<?= $uriSort ?>sort=1">Сортировка по дате: по возрастанию</a>
    <a href = "<?= $uriSort ?>sort=2">Сортировка по дате: по убыванию</a>
    <a href = "<?= $uriSort ?>sort=3">Сортировка по алфавиту: от А до Я</a>
    <a href = "<?= $uriSort ?>sort=4">Сортировка по алфавиту: от Я до А</a>
</div>