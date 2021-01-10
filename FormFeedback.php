<?php

class FormFeedback
{
    private $mysql; // свойство

    public function __construct(mysqli $mysql) // передаем объект класса mysqli
    {
        $this->mysql = $mysql; //устанавливаем значение свойства класса $mysql
    }

    /**
     * функция (метод) для получения отзывов из БД
     * @return array (ассоциативный)
     */
    public function select()
    {
        $res = mysqli_query($this->mysql, "SELECT * FROM `feedback`"); // запрос для получения отзывов из БД
        return mysqli_fetch_all($res, MYSQLI_ASSOC); //возвращает ассоциативный массив для последующего перебора его в цикле
    }

    /**
     * функция (метод) для добавления отзыва в БД
     * @return bool|mysqli_result
     */
    public function add()
    {
        $date = date_create('now')->format('d.m.Y H:i:s'); //получаем и форматируем текущую дату
        $sql = "INSERT INTO `feedback` SET `name` = '" . $_POST['name'] . "',`text` = '" . $_POST['text'] . "',`date` = '" . $date . "'"; // запрос для добавления отзыва в БД (получаем текущую дату при помощи функции PHP - date_create('now')->format('d.m.Y H:i:s'))
        //$sql = "INSERT INTO `feedback` SET `name` = '" . $_POST['name'] . "',`text` = '" . $_POST['text'] . "',`date` = DATE_FORMAT(NOW(),'%d%m.%Y %H:%i:%s') "; // запрос для добавления отзыва в БД (получаем текущую дату при помощи встроенной функции mysql - DATE_FORMAT(NOW(),'%d%m.%Y %H:%i:%s'))
        return $this->mysql->query($sql); // функция возвращает результат запроса
    }
}