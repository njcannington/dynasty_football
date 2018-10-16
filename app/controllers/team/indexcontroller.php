<?php
namespace App\Controllers\Team;

use App\Models\Team;
use App\Models\Player;

class IndexController
{
    public function indexAction()
    {
        $id = $_GET["id"];
        $team = new Team($id);
        $players = $team->getPlayers();
        $team_name = $team->getTeamName();
        $owner = $team->getOwner();

        for ($i = 0; $i < count($players); $i++) {
            $player = new Player($players[$i]["name"]);
            $players[$i]["score"] = $player->getScore();
            $players[$i]["3week"] = $player->getDelta(3);
            $players[$i]["10week"] = $player->getDelta(10);
        }

        return compact("players", "team_name", "owner", "id");
    }

    public static function setColor($num)
    {
        if ($num > 0) {
            return "success";
        } elseif ($num < 0) {
            return "danger";
        }
    }
}
