<?php
$root = substr(dirname(__FILE__), 0, -11);

include $root."/autoload.php";

//set environement to dev
$_SESSION["env"] = "dev";

use App\Lib\Scraper\DynastyLeagueFootball;
use App\Models;

$rankings = new Models\Ranking();

$qb = new DynastyLeagueFootball\Quarterback();
foreach ($qb->getRankings() as $data) {
    $rankings->create("QB", $data);
}

$rb = new DynastyLeagueFootball\Runningback();
foreach ($rb->getRankings() as $data) {
    $rankings->create("RB", $data);
}

$te = new DynastyLeagueFootball\Tightend();
foreach ($te->getRankings() as $data) {
    $rankings->create("TE", $data);
}

$wr = new DynastyLeagueFootball\Widereceiver();
foreach ($wr->getRankings() as $data) {
    $rankings->create("WR", $data);
}
