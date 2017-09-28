<?php
namespace Scraper\DynastyLeagueFootball;

use Scraper\DynastyLeagueFootball\DynastyLeagueFootball;

class Quarterback extends DynastyLeagueFootball
{
    public function __construct()
    {
        $this->url = parent::BASE_URL."/rankings/qb-rankings";
        parent::__construct(true);
    }
}
