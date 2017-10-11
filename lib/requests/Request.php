<?php
namespace Lib\Requests;

require_once(ROOT."/lib/requests/RequestParser.php");

use Lib\Requests\RequestParser;

class Request
{
    private $path;
    private $namespace;
    private $controller_name;
    private $action;
    private $view;

    public function __construct($request)
    {
        $parsed_request = new RequestParser($request);
        $pieces = $parsed_request->getPieces();
        $this->path = $pieces["path"];
        $this->controller_name = $pieces["controller"];
        $this->action = $pieces["action"];
        $this->namespace = $pieces["namespace"];
        $this->view = $pieces["view"];
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getNamespace()
    {
        return $this->namespace;
    }

    public function getControllerName()
    {
        return $this->controller_name;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getView()
    {
        return $this->view;
    }
}
