<?php
namespace Scraper\DynastyLeagueFootball;

use Scraper\DynastyLeagueFootball\DynastyLeagueFootball;

class Runningback extends DynastyLeagueFootball
{
    public function __construct()
    {
        $this->url = parent::BASE_URL."/rankings/rb-rankings";
        parent::__construct(true);
    }
}
