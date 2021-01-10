<?php

class FormFeedback
{
    private $mysql;

    public function __construct(mysqli $mysql)
    {
        $this->mysql = $mysql;
    }

    public function select()
    {
        $res = mysqli_query($this->mysql, "SELECT * FROM `feedback`");
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    public function add()
    {

//echo '<pre>';
//print_r($_POST);
//echo '</pre>';

        $date = date_create('now')->format('d.m.Y H:i:s');
        $sql = "INSERT INTO `feedback` SET `name` = '" . $_POST['name'] . "',`text` = '" . $_POST['text'] . "',`date` = '" . $date . "'";

        return $this->mysql->query($sql);
    }


}