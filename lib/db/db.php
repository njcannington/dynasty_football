<?php
namespace Lib\Db;

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
            $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            self::$instance = new PDO("INSERT PDO DATA", $pdo_options);
        }
        return self::$instance;
    }
}
