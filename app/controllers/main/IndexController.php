<?php
namespace App\Controllers\Main;

require_once(ROOT."/app/controllers/Controllers.php");

class IndexController extends \App\Controllers\Controllers
{
    public function indexAction()
    {
        return ["main", "index"];
    }
}
