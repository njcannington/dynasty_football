<?php
namespace App\Lib\Scraper\DynastyLeagueFootball;

use App\Lib\Scraper\DynastyLeagueFootball\DynastyLeagueFootball;

class Runningback extends DynastyLeagueFootball
{
    public function __construct()
    {
        $this->url = parent::BASE_URL."/rankings/rb-rankings";
        parent::__construct();
    }
}
