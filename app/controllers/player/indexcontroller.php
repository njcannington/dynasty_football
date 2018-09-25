<?php
namespace App\Controllers\Player;

use App\Models\Team;
use App\Models\Ranking;

class IndexController
{
    public function indexAction()
    {
        $player_name = urldecode($_GET["name"]);
        $id = $_GET["team"];
        $team = new Team($id);
        $team_name = $team->getTeamName();

        $ranking = new Ranking($player_name);
        $rank = $ranking->getScore();
        $rankings = $ranking->getScores(10);
        foreach ($rankings as $data) {
            $table_data[] = $data["score"];
            $label_data[] = $data["date"];
        }

        $table_data = array_reverse($table_data);
        $label_data = array_reverse($label_data);

        return compact('player_name', 'rank', 'id', 'team_name', 'table_data', 'label_data');
    }
}
