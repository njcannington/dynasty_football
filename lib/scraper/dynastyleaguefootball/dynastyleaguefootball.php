<?php
namespace Lib\Scraper\DynastyLeagueFootball;

use Lib\Scraper\Scraper;
use Lib\Config\Config;

abstract class DynastyLeagueFootball extends Scraper
{
    const BASE_URL = "https://dynastyleaguefootball.com";
    const XPATH_PLAYER_DATA = "//table[@id='avgTable']/tbody/tr/td[2]";
    const XPATH_AVG_DATA = "//table[@id='avgTable']/tbody/tr/td[@class='darkerCell']";

    protected $player_names;
    protected $averages;


    public function __construct()
    {
        $config = Config::getInstance();
        $this->cookie = $config["dlf"]["cookie"];
        parent::__construct();
    }

    protected function setPlayerNames()
    {
        try {
            $this->player_names = $this->getTextContent(self::XPATH_PLAYER_DATA);
        } catch (\Exception $e) {
            return;
        }
    }


    protected function setAverages()
    {
        try {
            $this->averages = $this->getTextContent(self::XPATH_AVG_DATA);
        } catch (\Exception $e) {
            return;
        }
    }

    public function getRankings()
    {
        $this->setPlayerNames();
        $this->setAverages();
        for ($i = 0; $i < count($this->averages); $i++) {
            $rankings[$i] = ["player" => $this->player_names[$i],
                             "average" => $this->averages[$i]];
        }
        return $rankings;
    }
}
