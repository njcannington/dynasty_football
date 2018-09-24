<?php
$root = substr(dirname(__FILE__), 0, -11);

include $root."/autoload.php";

use App\Lib\Scraper\DynastyLeagueFootball;
use App\Models;

$qb = new DynastyLeagueFootball\Quarterback();
foreach ($qb->getRankings() as $data) {
    Models\Ranking::create("QB", $data);
}

$rb = new DynastyLeagueFootball\Runningback();
foreach ($rb->getRankings() as $data) {
    Models\Ranking::create("RB", $data);
}

$te = new DynastyLeagueFootball\Tightend();
foreach ($te->getRankings() as $data) {
    Models\Ranking::create("TE", $data);
}

$wr = new DynastyLeagueFootball\Widereceiver();
foreach ($wr->getRankings() as $data) {
    Models\Ranking::create("WR", $data);
}
