<?php
namespace Scraper\Fleaflicker;

use Scraper\Fleaflicker\Fleaflicker;

class Team extends Fleaflicker
{
    const HEADERS = ["Name"];
    protected $url;
    protected $team_id;

    public function __construct($league_id, $team_id)
    {
        $this->url = parent::BASE_URL."/".parent::LEAGUE_TYPE."/leagues/{$league_id}/teams/{$team_id}";
        $this->league_id = $team_id;
        parent::__construct(true);
    }

    public static function cleanupHTML($html)
    {
        $html = str_replace("Q</span>", "", $html);
        $html = str_replace("SUS</span>", "", $html);
        $html = str_replace("IR</span>", "", $html);
        $html = preg_replace("#<[^>]+>#", "", $html);
        $html = str_replace("&#39;", "'", $html);
        $html = str_replace("PUP", "", $html);
        $html = str_replace("OUT", "", $html);

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
