<?php
namespace Lib\Scraper\DynastyLeagueFootball;

use Lib\Scraper\DynastyLeagueFootball\DynastyLeagueFootball;

class Top200 extends DynastyLeagueFootball
{
    public function __construct()
    {
        $this->url = parent::BASE_URL."rankings/dynasty-rankings";
        parent::__construct();
    }
}
