<?php
namespace App\Controllers\Player;

use App\Models\Team;
use App\Models\Player;

class IndexController
{
    public function indexAction()
    {
        $player_name = urldecode($_GET["name"]);
        $id = $_GET["team"];
        $team = new Team($id);
        $team_name = $team->getTeamName();

        $player = new Player($player_name);
        $score = $player->getScore();
        $scores = $player->getScores(10);
        foreach ($scores as $data) {
            $table_data[] = $data["score"];
            $label_data[] = $data["date"];
        }

        $table_data = array_reverse($table_data);
        $label_data = array_reverse($label_data);

        return compact('player_name', 'score', 'id', 'team_name', 'table_data', 'label_data');
    }
}
