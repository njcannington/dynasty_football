<?php
namespace Lib\Scraper\Fleaflicker;

use Lib\Scraper\Fleaflicker\Fleaflicker;
use Lib\Config\Config;

class League extends Fleaflicker
{
    const XPATH_TEAM_DATA = "//td[contains(@class, 'left')][1]/div[contains(@class, 'league-name')]/a";
    const XPATH_OWNER_DATA = "//td[contains(@class,'right')][1]";
    protected $team_ids = [];
    protected $team_names = [];
    protected $team_owners = [];

    public function __construct()
    {
        $config = Config::getInstance();
        $league_id = $config["ff"]["league"];
        $this->url = parent::BASE_URL."/".$config["ff"]["type"]."/leagues/".$config["ff"]["league"];
        parent::__construct();
        $this->setTeamIds();
        $this->setTeamNames();
        $this->setTeamOwners();
    }

    private function setTeamIds()
    {
        $team_urls = $this->extractHREFs(self::XPATH_TEAM_DATA);
        foreach ($team_urls as $team_url) {
            $this->team_ids[] = self::extractID($team_url);
        }
    }

    private function setTeamNames()
    {
        $this->team_names = $this->extractTextContent(self::XPATH_TEAM_DATA);
    }

    private function setTeamOwners()
    {
        $this->team_owners = $this->extractTextContent(self::XPATH_OWNER_DATA);
    }
    
    private static function extractID($team_url)
    {
        $pieces = explode("/", $team_url);
        $count  = count($pieces);

        return $pieces[$count-1];
    }

    public function getTeams()
    {
        for ($i = 0; $i < count($this->team_ids); $i++) {
            $teams[$i] = ["id" => $this->team_ids[$i],
                        "name" => $this->team_names[$i],
                        "owner" => $this->team_owners[$i]];
        }
        return $teams;
    }
}
