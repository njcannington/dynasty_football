<?php
namespace Fleaflicker;

use Fleaflicker\Fleaflicker as Fleaflicker;
use Fleaflicker\League as League;

class Team extends Fleaflicker
{
    protected $league;
    protected $team_url;
    protected $team_id;
    protected $team_name;
    protected $players = array();

    public function __construct(League $league, $team_id)
    {
        $this->league = $league;
        $league_url = $this->league->get('league_url');
        $this->team_url = $league_url."/teams/{$team_id}";
        $data = $this->prepData();
        $this->team_name = self::extractTeamName($data);
        $this->players   = self::extractPlayers($data);
    }

    public static function cleanupHTML($html)
    {
        $html = str_replace("Q</span>", "", $html);
        $html = str_replace("SUS</span>", "", $html);
        $html = str_replace("IR</span>", "", $html);
        $html = preg_replace("#<[^>]+>#", "", $html);
        $html = str_replace("&#39;", "'", $html);
        $html = str_replace("PUP", "", $html);

        return $html;
    }

    protected function prepData()
    {
        $html = self::getHTML($this->team_url);
        $teams = self::convertRowstoArray($html);
        $teams = self::cleanupHTML($teams);

        return $teams;
    }

    protected static function extractTeamName($data)
    {
        $parts = explode("-", $data[0]);
        $team_name = trim($parts[0]);

        return $team_name;
    }


    protected static function extractPlayers($data)
    {
        $players = array();
        $count = count($data);
        $positions = array("QB","RB","WR","TE");
        $ii = 0;
        for ($i=1; $i<$count; $i++) {
            $parts = explode(" ", $data[$i]);
            if (isset($parts[2]) && in_array($parts[2], $positions)) {
                $players[$ii]["name"] = $parts[0]." ".$parts[1];
                $players[$ii]["position"] = $parts[2];
                $ii++;
            }
        }

        return $players;
    }
}
