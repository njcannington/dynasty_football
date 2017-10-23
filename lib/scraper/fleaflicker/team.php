<?php
namespace Lib\Scraper\Fleaflicker;

use Lib\Scraper\Fleaflicker\Fleaflicker;
use Lib\Config\Config;

class Team extends Fleaflicker
{
    const XPATH_STARTER_DATA = "//table[@id='table_0']/tr/td[1]/div[@class='player']/div[@class='player-name']/a";
    protected $players = [];

    public function __construct($team_id)
    {
        $config = Config::getInstance();
        $this->url = parent::BASE_URL.$config["ff"]["type"]."/leagues/".$config["ff"]["league"]."/teams/".$team_id;
        parent::__construct();
        $this->setPlayers();
    }

    private function setPlayers()
    {
        $this->players = $this->extractTextContent(self::XPATH_STARTER_DATA);
    }


    public function getPlayers()
    {
        return $this->players;
    }
}
