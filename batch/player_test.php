<?php
require("test_requirements.php");

use App\Models\Player;

$name = 'Tom Brady';
$player = new Player($name);
var_dump($player->getScore());