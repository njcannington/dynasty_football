<?php
session_start();
$_SESSION["env"] = "dev";
$root = str_replace("/batch", "", __DIR__);
require $root."/autoload.php";