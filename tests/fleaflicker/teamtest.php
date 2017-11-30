<?php
namespace tests\fleaflicker;

$_SESSION["env"] = "dev";

use Lib\Scraper\Fleaflicker;

class TeamTests extends \PHPUnit\Framework\TestCase
{
    private $team;

    public function setUp()
    {
        $this->team = new Fleaflicker\Team("1153300");
    }

    public function tearDown()
    {
    }

    public function testGetPlayers()
    {
        $players = $this->team->getPlayers();
        $this->assertGreaterThan(0, count($players), "does not return array");
        foreach ($players as $player) {
            $this->assertTrue(is_string($player["name"]), "name - does not return a string");
            $this->assertContains(" ", $player["name"], "does not return a first/last name with space");
            $this->assertTrue(is_string($player["position"]), "position - does not return a string");
        }
    }
}
