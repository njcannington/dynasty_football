<?php
namespace App\Models;

use Lib\Db\Models;

class Ranking extends Models
{
    private $table = "rankings";
    private $columns = ["player", "position", "ranking", "updated_at", "id"];

    public function create($position, $ranking_data)
    {
        $date = date("Y-m-d H:i:s");
        $columns = implode(",", ["player", "position", "ranking", "updated_at"]);
        $values = implode('", "', [$ranking_data["Name"], $position, $ranking_data["AVG"], $date]);
        $sql = 'INSERT INTO '.$this->table.'('.$columns.') VALUES ("'.$values.'")';
        $this->db->exec($sql);
    }
}
