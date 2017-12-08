<?php
namespace App\Lib\Db;

use App\Lib\Config\Config;
use \PDO;

class Db
{
    private static $instance = null;

    //empty private construct to prevent new object istance;
    private function __construct()
    {
    }

    //empty clone to prevent from new object instance.
    private function __clone()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            try {
                $config = Config::getInstance();
                $db = $config["database"];
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                $db_settings = "mysql:host={$db["host"]};dbname={$db["db"]}";
                self::$instance = new PDO($db_settings, $db["username"], $db["password"], $pdo_options);
            } catch (PDOException $e) {
                //insert log here
            }
        }
        return self::$instance;
    }
}
