<?php
namespace App\Controllers\League;

use Lib\Scraper\Fleaflicker;

class IndexController
{
    public function indexAction()
    {
        $league = new Fleaflicker\League();
        $teams = $league->getTeams();
        

        return compact("teams");
    }
}
