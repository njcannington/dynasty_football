<?php
include "autoload.php";

use lib\Bootstrap\Bootstrap;

$boostrap = new Bootstrap($_GET["q"]);
$action = $boostrap->request->action."Action";
$data = $boostrap->controller->$action();

require_once(ROOT."/app/views/layout.html");
