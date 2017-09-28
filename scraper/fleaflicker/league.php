<?php
namespace Fleaflicker;

use Scraper\Fleaflicker\Fleaflicker;

class League extends Fleaflicker
{
    const HEADERS = ["Team", "Owner"];
    protected $url;
    protected $league_id;

    public function __construct($league_id)
    {
        $this->url = parent::BASE_URL."/".parent::LEAGUE_TYPE."/leagues/{$league_id}";
        $this->league_id = $league_id;
        parent::__construct(true);
    }
}
