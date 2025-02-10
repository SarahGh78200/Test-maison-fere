<?php

namespace Config;
error_reporting(E_ALL);
ini_set("display_errors", 1);
use PDO;
use Exception;

class DataBase
{
    static function getConnection()
    {
        try {
            $pdo = new PDO('mysql:host=localhost;dbname=free_moove_driver;charset=utf8', 'root');
        } catch (Exception $e) {
            die('Erreur :' . $e->getMessage());
        }
        return $pdo;
    }
}
