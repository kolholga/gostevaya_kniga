<?php

//создали подключение к БД
$mysql = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_BASE);

if ($mysql === false) {

    echo 'Произошла ошибка!' . PHP_EOL; //PHP_EOL -перенос строки
    echo 'Код ошибки ' . mysqli_connect_errno() . PHP_EOL; //mysqli_connect_errno - выводит номер ошибки
    echo 'Текст ошибки' . mysqli_connect_error() . PHP_EOL; //mysqli_connect_error() - выводит ошибку
    die(); //убиваем скрипт

}

mysqli_set_charset($mysql, "utf8");

$res = mysqli_query($mysql, "SELECT * FROM `feedback`");
$arFeedback = mysqli_fetch_all($res, MYSQLI_ASSOC);