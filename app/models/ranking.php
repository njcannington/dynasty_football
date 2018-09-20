<?php
namespace App\Models;

use App\Lib\Db\Models;

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

    public function getRank($player_name)
    {
        $sql = 'SELECT ranking FROM '.$this->table.' WHERE player like "%'.str_replace(" ", "%", $player_name).'%" ORDER BY updated_at DESC LIMIT 1';
        foreach ($this->db->query($sql) as $row) {
                $rank = $row["ranking"];
        }
        
        return isset($rank) ? $rank : 'n/a';
    }

    public function getRankings($player_name)
    {
        $sql = 'SELECT ranking, CAST(updated_at AS DATE) FROM '.$this->table.' WHERE player like "%'.str_replace(" ", "%", $player_name).'%" ORDER BY updated_at DESC LIMIT 10';
        foreach ($this->db->query($sql) as $row) {
                $results[] = ["ranking" => $row["ranking"], "date" => $row["CAST(updated_at AS DATE)"]];
        }
        return $results;
    }
}
