<?php
namespace App\Models;

use Lib\Db\Models;

class Ranking extends Models
{
    private $table = "rankings";
    private $columns = ["player", "position", "ranking", "updated_at", "id"];

    public function create($position, $rankings)
    {
        $date = date("Y-m-d H:i:s");
        $columns = implode(",", ["player", "position", "ranking", "updated_at"]);
        $values = implode('", "', [$rankings["player"], $position, $rankings["average"], $date]);
        $sql = 'INSERT INTO '.$this->table.'('.$columns.') VALUES ("'.$values.'")';
        $this->db->exec($sql);
    }

    public function getRecent($player)
    {
        $like_player = str_replace(" ", "%", $player);
        $sql = 'SELECT * FROM '.$this->table.' WHERE player like "%'.$like_player.'%" ORDER BY updated_at DESC LIMIT 1';
        foreach ($this->db->query($sql) as $row) {
            return ["player" => $player,
                    "ranking" => $row["ranking"],
                    "position" => $row["position"]];
        }
    }
}
