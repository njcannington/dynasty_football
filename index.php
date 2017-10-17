<?php
spl_autoload_register();

const ROOT = __DIR__;
const VIEWS = ROOT."/app/views";
const CONTROLLERS = ROOT."/app/controllers";
const MODELS = ROOT."/app/models";

use lib\Bootstrap\Bootstrap;

$boostrap = new Bootstrap($_GET["q"]);
$action = $boostrap->request->action."Action";
$data = $boostrap->controller->$action();

require_once(ROOT."/app/views/layout.html");
