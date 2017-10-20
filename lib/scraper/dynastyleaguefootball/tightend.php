<?php
namespace Lib\Scraper\DynastyLeagueFootball;

use Lib\Scraper\DynastyLeagueFootball\DynastyLeagueFootball;

class Tightend extends DynastyLeagueFootball
{
    public function __construct()
    {
        $this->url = parent::BASE_URL."/rankings/te-rankings";
        parent::__construct();
    }
}
