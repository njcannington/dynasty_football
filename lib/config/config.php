<?php
namespace Lib\Config;

class Config
{
    private static $instance = null;

    //empty private construct to prevent new object istance;
    private function __construct()
    {
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            $config = self::getConfig();
            self::$instance = parse_ini_file($config, true);
        }
        return self::$instance;
    }

    private static function getConfig()
    {
        if ($_SESSION["env"] == "dev") {
            return ROOT."/config/app.dev.ini";
        }
        if (isset($_SERVER["SERVER_NAME"]) && strtolower(substr($_SERVER["SERVER_NAME"], -3)) == "dev") {
            return ROOT."/config/app.dev.ini";
        } else {
            return ROOT."/config/app.ini";
        }
    }
}
