<?php
include "/Volumes/Projects/sites/dynasty/autoload.php";

use Lib\Scraper\DynastyLeagueFootball;
use App\Models;

$rankings = new Models\Ranking();

$qb = new DynastyLeagueFootball\Quarterback();
foreach ($qb->getFilteredData() as $data) {
    $rankings->create("QB", $data);
}

$rb = new DynastyLeagueFootball\Runningback();
foreach ($rb->getFilteredData() as $data) {
    $rankings->create("RB", $data);
}

$te = new DynastyLeagueFootball\Tightend();
foreach ($te->getFilteredData() as $data) {
    $rankings->create("TE", $data);
}

$wr = new DynastyLeagueFootball\Widereceiver();
foreach ($wr->getFilteredData() as $data) {
    $rankings->create("WR", $data);
}
