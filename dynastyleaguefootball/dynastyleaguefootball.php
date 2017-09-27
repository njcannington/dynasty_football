<?php
namespace DynastyLeagueFootball;

use Scraper\Scraper;

abstract class DynastyLeagueFootball
{
    const BASE_URL = "https://dynastyleaguefootball.com";
    const TABLE_OFFSET = 1; //DLF currently stores rankings in the 1st table
    const HEADERS = ["Name", "AVG"]; //labels used by DLF and only data we need
    const COOKIE = ""; //ADD DLF WORDPRESS COOKIE HERE
    protected $rankings;

    public function __construct()
    {
        $html = Scraper::fetchHTML(static::URL, self::COOKIE);
        $table = Scraper::fetchTable($html, self::TABLE_OFFSET);
        $headers = Scraper::fetchTableHeaders($table);
        $details = Scraper::fetchTableDetails($table);
        $this->rankings = self::filterRankings($headers, $details);
    }

    protected static function getHeaderKeys($headers)
    {
        foreach (self::HEADERS as $header) {
            $keys[] = array_search($header, $headers);
        }

        return $keys;
    }

    protected static function filterRankings($headers, $details)
    {
        $keys = self::getHeaderKeys($headers);
        foreach ($details as $detail) {
            $rankings[$detail[$keys[0]]] = $detail[$keys[1]];
        }

        return $rankings;
    }

    public function getRankings()
    {
        return $this->rankings;
    }
}
