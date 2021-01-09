<?php


class FormFeedback
{
    public static function addFeedback($mysql, $name, $text)
    {
        $date = date_create('now')->format('d.m.Y H:i:s');
        $sql = "INSERT INTO `feedback` SET `name` = '" . $name . "', `text` = '" . $text . "', `date` = '" . $date . "'";
        return $mysql->query($sql);
    }
}