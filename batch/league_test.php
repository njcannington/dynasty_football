<?php
require("test_requirements.php");

use App\Models\League;

$league = new League();
var_dump($league->getTeams());