<?php
/**
 * Created by PhpStorm.
 * User: dunnu
 * Date: 2/22/2019
 * Time: 9:39 PM
 */



use Game\Game as Game;
use Game\PlayerCardsController as Controller;

class PlayerCardsControllerTest extends \PHPUnit\Framework\TestCase
{
    const SEED = 1234;

    public function test_construct() {
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());
        $this->assertInstanceOf('Game\PlayerCardsController',$controller);
    }

    public function test_is_reset(){
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());
        $this->assertEquals(false, $controller->isReset());

        $game = new Game(self::SEED);
        $temp = [];
        $temp['clear'] = true;
        $controller = new Controller($game, $temp);
        $this->assertEquals(true, $controller->isReset());
    }
    
    public function test_add_player() {
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());

        $controller->addPlayer("SirTest",0);
        $controller->addPlayer("SirJest",0);
        $game->setPlayer($game->getPlayers()[0]);

        $playerName = $game->getPlayer()->get_name();

        $this->assertEquals($playerName,"SirTest");

        $game ->nextPlayer();
        $playerName = $game->getPlayer()->get_name();

        $this->assertEquals($playerName,"SirJest");

        $players = $game->getPlayers();

        $this->assertEquals(count($players),2);

        $controller->addPlayer("Test",0);
        $controller->addPlayer("Jest",0);


        $players = $game->getPlayers();
        $this->assertEquals(count($players),4);


    }

}