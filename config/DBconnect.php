<?php

class DBConnect
{
    public static string $host = 'localhost';
    public static string $dbname = 'tomtroc';
    public static string $user = 'root';
    public static string $pass = '';


    public static function getPDO()


    {
        try {
            return new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbname . ';charset=utf8', self::$user, self::$pass);
        } catch (Exception $e) {
            die('Erreur : ' . $e->getmessage());
        }
    }
}
