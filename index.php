<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/config.php'; //подключаем настройки
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/db.php'; //подключаем соединение с базой
require_once 'FormFeedback.php'; //подключили класс FormFeedback

$formObject = new FormFeedback($mysql); // создаем объект класса FormFeedback ($mysql - подключение к БД)
$arFeedback = $formObject->select(); //вызываем метод select() класса FormFeedback для получения отзывов из БД

if (isset($_POST['sub'])) { //если данные отправлены, т.е. нажата кнопка submit (отлавливаем клик по кнопке при помощи атрибута name="sub", значение которого прилетает в супер-глобальный массив POST)
    if (!empty($_POST['name']) && !empty($_POST['text'])) { // то проверяем, не пустые ли поля формы
        $formObject->add(); // вызываем метод add() класса FormFeedback для вставки отзыва в БД
        header("location: /?add=ok"); // прописывает в адресную строку /?add=ok, (?add=ok - в адресную строку прописали GET-параметр для его использования в необходимых нам проверках)
    } else {
        header("location: /?add=no");
    }
}
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

    <? if ($_GET['add'] == 'ok'): ?>
        <div class="info alert alert-info">
            Запись успешно сохранена!
        </div>
    <? endif; ?>

    <? if ($_GET['add'] == 'no'): ?>
        <div class="alert alert-danger">
            Заполните необходимые поля!
        </div>
    <? endif; ?>

    <div id="form">
        <form action="" method="POST">
            <p><input name="name" class="form-control" placeholder="Ваше имя*"></p>
            <p><textarea name="text" class="form-control" placeholder="Ваш отзыв*"></textarea></p>
            <p><input name="sub" type="submit" class="btn btn-info btn-block" value="Сохранить"></p>
        </form>
    </div>
</div>
</body>
</html>