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
        $url = $this->url;
        $config = Config::getInstance();
        $html = self::fetchHTML($this->url, $config["dlf"]["cookie"]);
        $this->html_dom = self::newDom($html);

        $this->setPlayerNames();
        $this->setAverages();
    }

    protected function setPlayerNames()
    {
        $this->player_names = $this->extractTextContent(self::XPATH_PLAYER_DATA);
    }

    protected function setAverages()
    {
        $this->averages = $this->extractTextContent(self::XPATH_AVG_DATA);
    }

    public function getRankings()
    {
        for ($i = 0; $i < count($this->averages); $i++) {
            $rankings[$i] = ["player" => $this->player_names[$i],
                             "average" => $this->averages[$i]];
        }
        return $rankings;
    }
}

