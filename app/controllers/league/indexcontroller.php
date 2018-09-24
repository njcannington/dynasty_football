<?php
namespace App\Controllers\League;

use App\Lib\Scraper\Fleaflicker;

class IndexController
{
    public function indexAction()
    {
        $league = new Fleaflicker\League();
        $teams = $league->getTeams();
        foreach ($teams as $team_data) {
            $team = new Fleaflicker\Team($team_data["id"]);
            $team_avg = $team->getAverage();
            $team_data["avg"] = $team_avg;
            $updated_teams[]=$team_data;
        }
        return compact("updated_teams");
    }
}
