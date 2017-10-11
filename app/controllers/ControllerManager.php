<?php
namespace App\Controllers;

class ControllerManager
{

    public static function getController(\Lib\Requests\Request $request)
    {
        $path = strtolower($request->getPath());
        $controller_name = $request->getControllerName();
        $namespace = __NAMESPACE__.$request->getNamespace();

        require_once(ROOT."/app/controllers".$path.$controller_name."Controller.php");
        $class = $namespace.$controller_name."Controller";
        return new $class();
    }
}
