<?php
namespace App\Controllers\Rankings;

use Lib\Scraper\DynastyLeagueFootball;
use App\Models\Team;

class IndexController
{
    public function indexAction()
    {
        $team = new Team();
        // $team->create("Kama-Kamara Chameleon", "nic_c", "1153300");
        return [];
    }
}
