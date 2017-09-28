<?php
namespace Scraper\Fleaflicker;

use Scraper\Scraper;

abstract class Fleaflicker extends Scraper
{
    const BASE_URL = "https://www.fleaflicker.com/";
    const LEAGUE_TYPE = "nfl";
    const HEADER_LOCATION = ["table" => 0, "thead" => 0, "tr" => 1];
    const HEADER_ELEMENT = "th";
    const COOKIE = ""; //Fleaflicker doesn't require cookie
}
