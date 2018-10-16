<?php
namespace App\Models;

use App\Lib\Scraper\Scraper;
use App\Lib\Config\Config;
use App\Lib\Db\Models;
use App\Lib\Db\Db;

class Ranking extends Models
{
    const XPATH_PLAYER_DATA = "//table[@id='avgTable']/tbody/tr/td[2]";
    const XPATH_AVG_DATA = "//table[@id='avgTable']/tbody/tr/td[@class='darkerCell']";
    const QB = "https://dynastyleaguefootball.com/rankings/qb-rankings";
    const RB = "https://dynastyleaguefootball.com/rankings/rb-rankings";
    const WR = "https://dynastyleaguefootball.com/rankings/wr-rankings";
    const TE = "https://dynastyleaguefootball.com/rankings/te-rankings";

    protected $player_names;
    protected $position;
    protected $averages;
    protected $scraper;

    public function __construct($position)
    {
        $config = Config::getInstance();
        $this->position = $position;
        switch ($position) {
            case 'QB':
                $url = self::QB;
                break;
            case 'RB':
                $url = self::RB;
                break;
            case 'WR':
                $url = self::WR;
                break;
            case 'TE':
                $url = self::TE;
                break;
            default:
                return null;
        }
        $this->scraper = new Scraper($url,  $config["dlf"]["cookie"]);
    }

    public function save()
    {
        $date = date("Y-m-d H:i:s");
        foreach ($this->getRankings() as $rankings)
        {
            $score = 101-$rankings["average"];
            $columns = implode(",", ["player", "position", "ranking", "updated_at"]);
            $values = implode('", "', [$rankings["player"], $this->position, $score, $date]);
            $sql = 'INSERT INTO rankings'.'('.$columns.') VALUES ("'.$values.'")';
            $db = DB::getInstance();
            $db->exec($sql);
        }
    }

    protected function setPlayerNames()
    {
        try {
            $this->player_names = $this->scraper->getTextContent(self::XPATH_PLAYER_DATA);
        } catch (\Exception $e) {
            return;
        }
    }


    protected function setAverages()
    {
        try {
            $this->averages = $this->scraper->getTextContent(self::XPATH_AVG_DATA);
        } catch (\Exception $e) {
            return;
        }
    }

    protected function getRankings()
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