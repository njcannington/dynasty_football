<?php
namespace App\Models;

use App\Lib\Scraper\Scraper;
use App\Lib\Config\Config;
use App\Lib\Db\Models;

class Team extends Models
{
    protected $cookie = '';

    const XPATH_PLAYER_NAME_DATA = "//div[@class='player-name']/a";
    const XPATH_PLAYER_POS_DATA = "//div/span[@class='position']";
    const XPATH_TEAM_NAME_DATA = "//div[@id='top-bar']/ul/li[3]";
    const XPATH_OWNER_DATA = "//a[@class='user-name']";
    protected $scraper;

    public function __construct($team_id)
    {
        $league_type = Config::getInstance()["ff"]["type"];
        $league_id = Config::getInstance()["ff"]["league"];
        $url = "https://www.fleaflicker.com/".$league_type."/leagues/".$league_id."/teams/".$team_id;
        $this->scraper = new Scraper($url);
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
            $player_names = $this->scraper->getTextContent(self::XPATH_PLAYER_NAME_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }

        return $player_names;
    }

    private function getPlayerPositions()
    {
        try {
            $positions = $this->scraper->getTextContent(self::XPATH_PLAYER_POS_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }
        return $positions;
    }

    public function getTeamName()
    {
        try {
            $name = $this->scraper->getTextContent(self::XPATH_TEAM_NAME_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }
        return $name[0];
    }

    public function getOwner()
    {
        try {
            $name = $this->scraper->getTextContent(self::XPATH_OWNER_DATA);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return;
        }
        return $name[0];
    }

    public function getAverage()
    {
        $players =  $this->addScores();
        $qbs = $this->getPosition($players, "QB");
        $rbs = $this->getPosition($players, "RB");
        $wrs = $this->getPosition($players, "WR");
        $tes = $this->getPosition($players, "TE");
        $scores = array_map("self::getScore", [$qbs, $rbs, $wrs]);
        $scores[] = $this->getScore($tes);
        
        $rb_flex = $this->getFlexScore($rbs);
        $wr_flex = $this->getFlexScore($wrs);
        $te_flex = $this->getTEFlexScore($tes);
        $scores[] = $te_flex[0];

        $flex_scores = [$wr_flex, $rb_flex];

        foreach ($flex_scores as $flex_score){
            $scores[] = $flex_score[0]+$flex_score[1];
        }

        return array_sum($scores);
    }

    private function getScore($players)
    {
        $score = [];
        foreach ($players as $player) {
            if ($player["score"] !== "n/a") {
                $score[] = (float)$player["score"];
            }
            rsort($score);
        }
        return $score[0]+$score[1];
    }

    private function getFlexScore($players)
    {
        $score = [];
        foreach ($players as $player) {
            if ($player["score"] !== "n/a") {
                $score[] = (float)$player["score"];
            }
        }
        sort($score);
        array_pop($score);
        array_pop($score);
        rsort($score);

        return $score;
    }

    private function getTEScore($players)
    {
        $score = [];
        foreach ($players as $player) {
            if ($player["score"] !== "n/a") {
                $score[] = (float)$player["score"];
            }
            rsort($score);
        }
        return $score[0];
    }

    private function getTEFlexScore($players)
    {
        $score = [];
        foreach ($players as $player) {
            if ($player["score"] !== "n/a") {
                $score[] = (float)$player["score"];
            }
        }
        sort($score);
        array_pop($score);
        rsort($score);

        return $score;
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

    private function addScores()
    {
        $i = 0;
        $players = $this->getPlayers();
        foreach ($players as $player_data) {
            $player = new Player($player_data["name"]);
            $players[$i]["score"] = $player->getScore();
            $i++;
        }
        return $players;
    }
}