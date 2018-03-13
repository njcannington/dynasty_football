<?php
namespace tests\fleaflicker;

$_SESSION["env"] = "dev";

use App\Lib\Scraper\Fleaflicker;

class LeagueTests extends \PHPUnit_Framework_TestCase
{
    private $league;

    public function setUp()
    {
        $this->league = new Fleaflicker\League();
    }

    public function tearDown()
    {
    }

    public function testGetTeams()
    {
        $teams = $this->league->getTeams();
        $this->assertGreaterThan(0, count($teams), "does not return array");
        foreach ($teams as $team) {
            $this->assertTrue(is_string($team["name"]), "does not return a string");
            $this->assertTrue(is_string($team["id"]), "does not return a string");
            $this->assertTrue(is_string($team["owner"]), "does not return a string");
        }
    }
}
