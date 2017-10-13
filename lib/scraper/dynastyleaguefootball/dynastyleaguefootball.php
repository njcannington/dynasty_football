<?php
namespace Lib\Scraper\DynastyLeagueFootball;

require_once("lib/scraper/scraper.php");
require_once("lib/config/config.php");

use Lib\Scraper\Scraper;
use Lib\Config\Config;

abstract class DynastyLeagueFootball extends Scraper
{
    const BASE_URL = "https://dynastyleaguefootball.com";
    const HEADER_LOCATION = ["table" => 0, "thead" => 0];
    const HEADER_ELEMENT = "th";
    const HEADERS = ["Name", "AVG"];
    protected $cookie;

    protected $rankings;

    public function __construct()
    {
        $config = Config::getInstance();
        $this->cookie = $config["dlf"]["cookie"];
        parent::__construct();
    }

    protected function setTableDetails()
    {
        $row = 0;
        $column = 0;
        $headers = static::HEADER_LOCATION;
        $table = $this->dom->getElementsByTagName("table")->item($headers["table"]);
        foreach ($table->getElementsByTagName('td') as $detail) {
            $this->table_details[$row][] = trim($detail->textContent);
            $column++;
            $row = $column % count($this->table_headers) == 0 ? $row + 1 : $row;
        }
    }
}
