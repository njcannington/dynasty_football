<?php
const ROOT = __DIR__;
const VIEWS = ROOT."/app/views";
const CONTROLLERS = ROOT."/app/controllers";
const MODELS = ROOT."/app/models";

require_once(ROOT."/lib/bootstrap/Bootstrap.php");

use Lib\Bootstrap\Bootstrap;

$boostrap = new Bootstrap($_GET["q"]);
$action = $boostrap->request->getAction()."Action";
$data = $boostrap->controller->$action();

require_once(ROOT."/app/views/layout.html");
