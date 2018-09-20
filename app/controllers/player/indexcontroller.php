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

        $ranking = new Models\Ranking($player_name);
        $rank = $ranking->getRank();
        $rankings = $ranking->getRankings(10);
        foreach ($rankings as $data) {
            $table_data[] = $data["ranking"];
            $label_data[] = $data["date"];
        }

        return compact('player_name', 'rank', 'id', 'team_name', 'table_data', 'label_data');
    }
}
