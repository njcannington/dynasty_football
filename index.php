<?php
const ROOT = __DIR__;
require_once(ROOT."/lib/bootstrap/Bootstrap.php");

use Lib\Bootstrap\Bootstrap;

$boostrap = new Bootstrap($_GET["q"]);
$action = $boostrap->request->getAction()."Action";
$data = $boostrap->controller->$action();
