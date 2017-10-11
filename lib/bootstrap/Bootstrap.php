<?php
namespace Lib\Bootstrap;

require_once(ROOT."/lib/requests/Request.php");
require_once(ROOT."/lib/controllers/ControllerManager.php");

use Lib\Requests\Request;
use Lib\Controllers\ControllerManager;

class Bootstrap
{
    private $request;
    private $controller;

    public function __construct($request)
    {
        $this->request = new Request($request);
        $this->controller = ControllerManager::getController($this->request);
    }

    public function __get($property)
    {
        $method = "get".ucfirst($property);
        return $this->$method();
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getController()
    {
        return $this->controller;
    }
}
