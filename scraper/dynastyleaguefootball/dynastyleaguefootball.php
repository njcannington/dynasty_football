<?php
namespace Scraper\DynastyLeagueFootball;

use Scraper\Scraper;

abstract class DynastyLeagueFootball extends Scraper
{
    const BASE_URL = "https://dynastyleaguefootball.com";
    const HEADER_LOCATION = ["table" => 0, "thead" => 0];
    const HEADER_ELEMENT = "th";
    const HEADERS = ["Name", "AVG"];
    const COOKIE = ""; //PUT DLF COOKIE HERE
    protected $rankings;

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
