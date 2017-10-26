<?php
namespace tests\fleaflicker;

$_SESSION["env"] = "dev";

use Lib\Scraper\Fleaflicker;

class TeamTests extends \PHPUnit_Framework_TestCase
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
            $this->assertTrue(is_string($player), "does not return a string");
            $this->assertContains(" ", $player, "does not return a first/last name with space");
        }
    }
}
