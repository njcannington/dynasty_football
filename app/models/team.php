<?php
namespace App\Models;

use Lib\Db\Models;

class Team extends Models
{
    private $table = "teams";
    private $columns = ["name", "owner", "id"];

    public function create($name, $owner, $id)
    {
        $sql = "INSERT INTO {$this->table} VALUES ('{$name}','{$owner}','{$id}')";
        $this->db->exec($sql);
    }
}
