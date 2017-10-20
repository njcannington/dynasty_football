<?php
namespace Lib\Scraper\DynastyLeagueFootball;

use Lib\Scraper\DynastyLeagueFootball\DynastyLeagueFootball;

class Widereceiver extends DynastyLeagueFootball
{
    public function __construct()
    {
        $this->url = parent::BASE_URL."/rankings/wr-rankings";
        parent::__construct();
    }
}
