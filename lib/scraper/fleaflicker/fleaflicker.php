<?php
namespace Lib\Scraper\Fleaflicker;

use Lib\Scraper\Scraper;

abstract class Fleaflicker extends Scraper
{
    const BASE_URL = "https://www.fleaflicker.com/";

    public function __construct()
    {
        $url = $this->url;
        $html = self::fetchHTML($url);
        $this->html_dom = self::newDom($html);
    }
}
