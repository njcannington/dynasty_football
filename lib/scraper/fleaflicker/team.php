<?php
namespace Lib\Scraper\Fleaflicker;

use Lib\Scraper\Scraper;
use Lib\Config\Config;

class Team extends Scraper
{
    protected $cookie = '';

    const XPATH_PLAYER_DATA = "//div[@class='player-name']/a";
    const XPATH_NAME_DATA = "//div[@id='top-bar']/ul/li[3]";
    const XPATH_OWNER_DATA = "//a[@class='user-name']";

    public function __construct($team_id)
    {
        $league_type = Config::getInstance()["ff"]["type"];
        $league_id = Config::getInstance()["ff"]["league"];
        $this->url = "https://www.fleaflicker.com/".$league_type."/leagues/".$league_id."/teams/".$team_id;
        parent::__construct();
    }

    public function getPlayers()
    {
        try {
            $players = $this->getTextContent(self::XPATH_PLAYER_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }
        return $players;
    }


    public function getTeamName()
    {
        try {
            $name = $this->getTextContent(self::XPATH_NAME_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }
        return $name[0];
    }

    public function getOwner()
    {
        try {
            $name = $this->getTextContent(self::XPATH_OWNER_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }
        return $name[0];
    }
}
