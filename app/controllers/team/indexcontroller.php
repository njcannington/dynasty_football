<?php
namespace App\Controllers\Team;

use Lib\Scraper\Fleaflicker;
use App\Models;

class IndexController
{
    public function indexAction()
    {
        $id = $_GET["id"];
        $team = new Fleaflicker\Team($id);
        $players = $team->getPlayers();
        $team_name = $team->getTeamName();
        $owner = $team->getOwner();

        $ranking = new Models\Ranking();
        for ($i = 0; $i < count($players); $i++) {
            $players[$i]["ranking"] = $ranking->getRanking($players[$i]["name"]);
        }

        return compact("players", "team_name", "owner");
    }
}
