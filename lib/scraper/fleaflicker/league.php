<?php
namespace Lib\Scraper\Fleaflicker;

use Lib\Scraper\Fleaflicker\Fleaflicker;

class League extends Fleaflicker
{
    const HEADERS = ["Team", "Owner"];
    const REMOVE_CHARS = ["</div>-", "*"]; // array to store HTML chars that can muddy up the process
    protected $url;
    protected $league_id;

    public function __construct($league_id)
    {
        $this->url = parent::BASE_URL."/".parent::LEAGUE_TYPE."/leagues/{$league_id}";
        $this->league_id = $league_id;
        parent::__construct(true);
    }
}
