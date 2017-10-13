<?php
namespace Lib\Scraper\Fleaflicker;

use Lib\Scraper\Fleaflicker\Fleaflicker;

class Team extends Fleaflicker
{
    const HEADERS = ["Name"];
    const REMOVE_CHARS = ["Q</span>", "SUS</span>", "IR</span>", "PUP</span>", "OUT</span>"];
    protected $url;
    protected $team_id;

    public function __construct($league_id, $team_id)
    {
        $this->url = parent::BASE_URL."/".parent::LEAGUE_TYPE."/leagues/{$league_id}/teams/{$team_id}";
        $this->league_id = $team_id;
        parent::__construct(true);
        $this->extractNames();
    }

    protected function extractNames()
    {
        foreach ($this->filtered_data as $details) {
            $bits = explode(" ", $details["Name"]);
            $name = "{$bits[0]} {$bits[1]}";
            $names[] = ["Name" => $name];
        }
        $this->filtered_data = $names;
    }
}
