<?php
namespace App\Models;

use App\Lib\Db\Models;
use App\Lib\Db\Db;

class Player extends Models
{
    protected $player_name;

    public function __construct($player_name)
    {
        parent::__construct();
        $this->player_name = $player_name;
    }

    public function getScore()
    {
        $sql = 'SELECT score FROM rankings WHERE player like "%'.str_replace(" ", "%", $this->player_name).'%" ORDER BY updated_at DESC LIMIT 1';
        foreach ($this->db->query($sql) as $row) {
                $rank = $row["score"];
        }
        
        return isset($rank) ? $rank : 'n/a';
    }

    public function getScores($num_of_results)
    {
        $sql = 'SELECT score, CAST(updated_at AS DATE) FROM rankings WHERE player like "%'.str_replace(" ", "%", $this->player_name).'%" ORDER BY updated_at DESC LIMIT '.$num_of_results;
        foreach ($this->db->query($sql) as $row) {
                $results[] = ["score" => $row["score"], "date" => $row["CAST(updated_at AS DATE)"]];
        }

        return isset($results) ? $results : 'n/a';
    }

    public function getDelta($num_of_results)
    {
        $scores = $this->getScores($num_of_results);
        if ($scores != "n/a") {
                $start = current($scores);
                $end = end($scores);

                return $start["score"]-$end["score"];        
        } else {
            return $scores;
        }

    }
}