<?php
namespace Lib\Scraper\Fleaflicker;

use Lib\Scraper\Scraper;
use Lib\Config\Config;

class Team extends Scraper
{
    protected $cookie = '';

    const XPATH_STARTER_DATA = "//table/tr/td[1]/div[@class='player']/div[@class='player-name']/a";

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
            $players = $this->getTextContent(self::XPATH_STARTER_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }
        return $players;
    }
}
