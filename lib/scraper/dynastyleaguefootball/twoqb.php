<?php
namespace Lib\Scraper\DynastyLeagueFootball;

use Lib\Scraper\DynastyLeagueFootball\DynastyLeagueFootball;

class TwoQb extends DynastyLeagueFootball
{
    public function __construct()
    {
        $this->url = parent::BASE_URL."/dynasty-2qb-rankings/";
        parent::__construct();
    }
}