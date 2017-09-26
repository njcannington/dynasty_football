<?php
namespace Fleaflicker;

use Fleaflicker\Fleaflicker;

class League extends Fleaflicker
{
    protected $league_url;
    protected $league_id;
    protected $team_ids = array();

    public function __construct($league_type, $league_id)
    {
        parent::__construct($league_type);
        $base_url = $this->get("base_url");
        $this->league_url = $base_url."/leagues/{$league_id}";
        $this->league_id = $league_id;
        $this->team_ids = $this->extractTeamIDs();
    }

    //return array of ids for each team in league
    protected function extractTeamIDs()
    {
        $url = $this->league_url;
        $html = self::getHTML($url);
        $needle = "<a href=\"/{$this->league_type}/leagues/{$this->league_id}/teams/";
        $last_pos = 0;
        $positions = array();

        while (($last_pos = strpos($html, $needle, $last_pos))!== false) {
            $positions[] = $last_pos;
            $last_pos = $last_pos + strlen($needle);
        }

        foreach ($positions as $value) {
            $team_link = substr($html, $value, 44)."\n";
            $team_link = explode("/", $team_link);
            $team_id = substr($team_link[5], 0, -3);
            $team_ids[] = $team_id;
        }

        return $team_ids;
    }

    public function getTeamIDs()
    {
        return $this->team_ids;
    }
}
