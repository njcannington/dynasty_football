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
        $player_names = $team->getPlayers();

        $rankings = [];
        $ranking = new Models\Ranking();
        foreach ($player_names as $player) {
            $players[] = $ranking->getRecent($player);
        }

        return compact("players");
    }
}
