<?php
namespace Lib\Requests;

class RequestParser
{
    private $request;
    private $pieces;

    public function __construct($request)
    {
        $this->request = $request;
        $this->toArray();
        $this->removeEmptyElements();
        $this->extractPieces();
    }

    private function toArray()
    {
        $this->request = explode("/", $this->request);
    }

    private function removeEmptyElements()
    {
        $this->request = array_filter($this->request);
    }

    private function extractPieces()
    {
        switch (count($this->request)) {
            case '1':
                $this->pieces = $this->extractFromOneElement();
                break;
            case '2':
                $this->pieces = $this->extractFromTwoElements();
                break;
            default:
                $this->pieces = $this->extractFromManyElements();
                break;
        }
    }

    private function extractFromOneElement()
    {
        if (current($this->request) == "index.php") {
            $path = "/";
            $namespace = "\\";
        } else {
            $path = "/".ucfirst(current($this->request))."/";
            $namespace = "\\".ucfirst(current($this->request))."\\";
        }
        $controller = "Index";
        $action = "Index";

        return compact("path", "controller", "action", "namespace");
    }

    private function extractFromTwoElements()
    {
        $path = "/";
        $controller = ucfirst(current($this->request));
        $action = ucfirst(next($this->request));
        $namespace = "\\";

        return compact("path", "controller", "action", "namespace");
    }

    private function extractFromManyElements()
    {
        $action = ucfirst(end($this->request));
        $controller = ucfirst(prev($this->request));
        $path = null;
        $namespace = null;
        while (!is_null(key($this->request))) {
            $path_as_array[] = ucfirst(prev($this->request));
        }
        foreach (array_reverse($path_as_array) as $path_segment) {
            $path .= $path_segment."/";
            $namespace .= $path_segment."\\";
        }

        return compact("path", "controller", "action", "namespace");
    }

    public function getPieces()
    {
        return $this->pieces;
    }
}
