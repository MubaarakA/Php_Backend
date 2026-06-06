<?php

date_default_timezone_set("Africa/Mogadishu");

class Database
{
    public static function connect()
    {

        $host="localhost";
        $db="radius";
        $user="radius";
        $pass="radiuspass";


        return new PDO(
            "mysql:host=$host;dbname=$db;charset=utf8",
            $user,
            $pass,
            [
                PDO::ATTR_ERRMODE =>
                PDO::ERRMODE_EXCEPTION
            ]
        );

    }
}