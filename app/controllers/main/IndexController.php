<?php
namespace App\Controllers\Main;

class IndexController
{
    public function indexAction()
    {
        return ["main", "index"];
    }

    public function updateAction()
    {
        return ["main", "update"];
    }
}
