<?php
require("test_requirements.php");

use App\Models\Team;

$team = new Team("1153300");
var_dump($team->getPlayers());