<?php
namespace App\Lib\Scraper\DynastyLeagueFootball;

use App\Lib\Scraper\DynastyLeagueFootball\DynastyLeagueFootball;

class Tightend extends DynastyLeagueFootball
{
    public function __construct()
    {
        $this->url = parent::BASE_URL."/rankings/te-rankings";
        parent::__construct();
    }
}
