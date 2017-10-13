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
            if (strtolower(substr($_SERVER["SERVER_NAME"], -3)) == "dev") {
                 self::$instance = parse_ini_file(ROOT."/config/app.dev.ini", true);
            } else {
                self::$instance = parse_ini_file(ROOT."/config/app.ini", true);
            }
        }
        return self::$instance;
    }
}
