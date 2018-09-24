<?php
namespace App\Lib\Scraper\Fleaflicker;

use App\Lib\Scraper\Scraper;
use App\Lib\Config\Config;
use App\Models;

class Team extends Scraper
{
    protected $cookie = '';

    const XPATH_PLAYER_NAME_DATA = "//div[@class='player-name']/a";
    const XPATH_PLAYER_POS_DATA = "//div/span[@class='position']";
    const XPATH_TEAM_NAME_DATA = "//div[@id='top-bar']/ul/li[3]";
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
        $names = $this->getPlayerNames();
        $positions = $this->getPlayerPositions();
        for ($i = 0; $i < count($names); $i++) {
            $players[] = ["name" => $names[$i], "position" => $positions[$i]];
        }

        return $players;
    }

    private function getPlayerNames()
    {
        try {
            $player_names = $this->getTextContent(self::XPATH_PLAYER_NAME_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }

        return $player_names;
    }

    private function getPlayerPositions()
    {
        try {
            $positions = $this->getTextContent(self::XPATH_PLAYER_POS_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }
        return $positions;
    }

    public function getTeamName()
    {
        try {
            $name = $this->getTextContent(self::XPATH_TEAM_NAME_DATA);
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

    public function getAverage()
    {
        $players =  $this->addRankings();
        $qbs = $this->getPosition($players, "QB");
        $rbs = $this->getPosition($players, "RB");
        $wrs = $this->getPosition($players, "WR");
        $tes = $this->getPosition($players, "TE");
        $scores = array_map("self::getScore", [$qbs, $rbs, $wrs]);
        $scores[] = $this->getScore($tes);

        return array_sum($scores);
    }

    private function getScore($players)
    {
        $score = [];
        foreach ($players as $player) {
            if ($player["rank"] !== "n/a") {
                $score[] = (float)$player["rank"];
            }
            sort($score);
        }
        return $score[0]+$score[1];
    }

    private function getTEScore($players)
    {
        $score = [];
        foreach ($players as $player) {
            if ($player["rank"] !== "n/a") {
                $score[] = (float)$player["rank"];
            }
            sort($score);
        }
        return $score[0];
    }

    private function getPosition($players, $position)
    {
        $callback = "self::is{$position}";
        return array_filter($players, $callback);
    }

    private function isQB($array)
    {
        return $array["position"] == "QB";
    }

    private function isRB($array)
    {
        return $array["position"] == "RB";
    }

    private function isWR($array)
    {
        return $array["position"] == "WR";
    }

    private function isTE($array)
    {
        return $array["position"] == "TE";
    }

    private function addRankings()
    {
        $i = 0;
        $players = $this->getPlayers();
        foreach ($players as $player) {
            $ranking = new Models\Ranking($player["name"]);
            $players[$i]["rank"] = $ranking->getRank();
            $i++;
        }
        return $players;
    }
}
