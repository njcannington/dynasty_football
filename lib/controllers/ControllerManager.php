<?php
namespace Lib\Controllers;

class ControllerManager
{

    public static function getController(\Lib\Requests\Request $request)
    {
        $path = strtolower($request->getPath());
        $controller_name = $request->getControllerName();
        $namespace = "App\Controllers".$request->getNamespace();

        require_once(CONTROLLERS.$path.$controller_name."Controller.php");
        $class = $namespace.$controller_name."Controller";
        return new $class();
    }
}
