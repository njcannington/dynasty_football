<?php
namespace App\Lib\Scraper\Fleaflicker;

use App\Lib\Scraper\Scraper;
use App\Lib\Config\Config;

class League extends Scraper
{
    const XPATH_TEAM_DATA = "//td[contains(@class, 'left')][1]/div[contains(@class, 'league-name')]/a";
    const XPATH_OWNER_DATA = "//td[contains(@class,'right')][1]";
    protected $team_ids = [];
    protected $team_names = [];
    protected $team_owners = [];

    public function __construct()
    {
        $config = Config::getInstance();
        $league_type = $config["ff"]["type"];
        $league_id = $config["ff"]["league"];
        $this->url = "https://www.fleaflicker.com/".$league_type."/leagues/".$league_id;
        parent::__construct();
    }

    public function getTeams()
    {
        $this->getLeagueData();
        for ($i = 0; $i < count($this->team_ids); $i++) {
            $teams[$i] = ["id" => $this->team_ids[$i],
                        "name" => $this->team_names[$i],
                        "owner" => $this->team_owners[$i]];
        }
        return $teams;
    }

    protected function getLeagueData()
    {
        $this->setTeamIds();
        $this->setTeamNames();
        $this->setTeamOwners();
    }

    protected function setTeamIds()
    {
        try {
            $team_urls = $this->getHrefs(self::XPATH_TEAM_DATA);
        } catch (\Exception $e) {
            return;
        }
        foreach ($team_urls as $team_url) {
            $this->team_ids[] = self::extractTeamID($team_url);
        }
    }

    protected function setTeamNames()
    {
        try {
            $this->team_names = $this->getTextContent(self::XPATH_TEAM_DATA);
        } catch (\Exception $e) {
            return;
        }
    }

    protected function setTeamOwners()
    {
        try {
            $this->team_owners = $this->getTextContent(self::XPATH_OWNER_DATA);
        } catch (\Exception $e) {
            return;
        }
    }
    
    protected static function extractTeamID($team_url)
    {
        $pieces = explode("/", $team_url);
        $count  = count($pieces);

        return $pieces[$count-1];
    }
}
