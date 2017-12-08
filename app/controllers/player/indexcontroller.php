<?php
namespace App\Controllers\Player;

use App\Lib\Scraper\Fleaflicker;
use App\Models;

class IndexController
{
    public function indexAction()
    {
        $player_name = urldecode($_GET["name"]);
        $id = $_GET["team"];
        $team = new Fleaflicker\Team($id);
        $team_name = $team->getTeamName();

        $ranking = new Models\Ranking();
        $rank = $ranking->getRank($player_name);
        $rankings = $ranking->getRankings($player_name);
        foreach ($rankings as $data) {
            $table_data[] = $data["ranking"];
            $label_data[] = $data["date"];
        }

        return compact('player_name', 'rank', 'id', 'team_name', 'table_data', 'label_data');
    }
}
