<?php
namespace App\Models;

use App\Lib\Db\Models;

class Ranking extends Models
{
    protected $player_name;

    public function __construct($player_name)
    {
        $this->player_name = $player_name;
    }
    public static function create($position, $rankings)
    {
        $date = date("Y-m-d H:i:s");
        $columns = implode(",", ["player", "position", "ranking", "updated_at"]);
        $values = implode('", "', [$rankings["player"], $position, $rankings["average"], $date]);
        $sql = 'INSERT INTO rankings'.'('.$columns.') VALUES ("'.$values.'")';
        $this->db->exec($sql);
    }

    public function getRank()
    {
        $sql = 'SELECT ranking FROM rankings WHERE player like "%'.str_replace(" ", "%", $this->player_name).'%" ORDER BY updated_at DESC LIMIT 1';
        foreach ($this->db->query($sql) as $row) {
                $rank = $row["ranking"];
        }
        
        return isset($rank) ? $rank : 'n/a';
    }

    public function getRankings()
    {
        $sql = 'SELECT ranking, CAST(updated_at AS DATE) FROM rankings WHERE player like "%'.str_replace(" ", "%", $this->player_name).'%" ORDER BY updated_at DESC LIMIT 10';
        foreach ($this->db->query($sql) as $row) {
                $results[] = ["ranking" => $row["ranking"], "date" => $row["CAST(updated_at AS DATE)"]];
        }
        return $results;
    }
}
