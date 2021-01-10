<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php'; //подключаем настройки
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php'; //подключаем соединение с базой
require_once 'FormFeedback.php'; //подключили класс FormFeedback
/*
echo '<pre>';
print_r($arFeedback);
echo '</pre>';
*/
$formObject = new FormFeedback($mysql);
$arFeedback = $formObject->select();
$formObject->add();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Гостевая книга</title>
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div id="wrapper">
    <h1>Гостевая книга</h1>
    <? if (!empty($arFeedback)): ?>

        <? foreach ($arFeedback as $item): ?>

            <div class="note">
                <p>
                    <span class="date"><?= $item['date']; ?></span>
                    <span class="name"><?= $item['name']; ?></span>
                </p>
                <p><?= $item['text']; ?></p>
            </div>

        <? endforeach; ?>

    <? else: ?>
        <p>Отзывов пока нет :)</p>
    <? endif; ?>

    <div class="info alert alert-info">
        Запись успешно сохранена!
    </div>
    <div id="form">
        <form action="/" method="POST">
            <p><input id="inp" class="form-control" placeholder="Ваше имя"></p>
            <p><textarea class="form-control" placeholder="Ваш отзыв"></textarea></p>
            <p><input type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
        </form>
    </div>
</div>
</body>
</html>

