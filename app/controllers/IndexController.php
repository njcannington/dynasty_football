<?php
namespace App\Controllers;

require_once(ROOT."/app/controllers/Controllers.php");

class IndexController extends Controllers
{
    public function indexAction()
    {
        return ["index", "index"];
    }
}
