<?php
namespace App\Controllers\League;

use Lib\Scraper\Fleaflicker;

class IndexController
{
    public function indexAction()
    {
        $league = new Fleaflicker\League("167544");
        $headers = $league::HEADERS;
        $teams = $league->getFilteredData();
        

        return compact("headers", "teams");
    }
}
