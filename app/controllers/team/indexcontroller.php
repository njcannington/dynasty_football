<?php
namespace App\Controllers\Team;

use Lib\Scraper\Fleaflicker;

class IndexController
{
    public function indexAction()
    {
        $id = $_GET["id"];
        $team = new Fleaflicker\Team($id);
        $players = $team->getPlayers();
        

        return compact("players");
    }
}
