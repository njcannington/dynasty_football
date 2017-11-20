<?php

require "../autoload.php";

use \Lib\Bootstrap\Bootstrap;

$bootstrap = new Bootstrap($_GET["q"]);
$action = $bootstrap->request->action."Action";
$data = $bootstrap->controller->$action();

require_once(VIEWS."/layout.html");
