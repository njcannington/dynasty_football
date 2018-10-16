<?php
require("test_requirements.php");

use App\Models\Ranking;

$ranking = new Ranking("QB");
var_dump($ranking->getRankings());