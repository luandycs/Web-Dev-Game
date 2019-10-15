<?php
/**
 * Created by PhpStorm.
 * User: dunnu
 * Date: 2/19/2019
 * Time: 1:14 PM
 */

use \Game\Game as Game;

class GameTest extends \PHPUnit\Framework\TestCase
{
    const SEED = 1234;

    public function test_construct() {
        $game = new \Game\Game(self::SEED);
        $this->assertInstanceOf(Game::class, $game);

        $game = new \Game\Game();
        $this->assertInstanceOf(Game::class, $game);
    }

    public function test_rollDice() {
        $game = new \Game\Game(self::SEED);
        $game->addPlayer("Prof. Owen", $game->getNode(0,14));
        $game->setPlayer($game->getPlayers()[0]);
        $game->rollDice();

        $this->assertEquals(2, count($game->getDiceNum()));

        $this->assertLessThanOrEqual(6, $game->getDiceNum()[0]);
        $this->assertLessThanOrEqual(6, $game->getDiceNum()[1]);
        $this->assertGreaterThanOrEqual(1, $game->getDiceNum()[0]);
        $this->assertGreaterThanOrEqual(1, $game->getDiceNum()[1]);

        $this->assertEquals(5, $game->getDiceNum()[0]);
        $this->assertEquals(3, $game->getDiceNum()[1]);
    }

    public function test_constructDeck() {
        $game = new \Game\Game();

        $this->assertEquals(21, count($game->getCards()->getCards()));
    }

    public function test_setMurderCards() {
        $game = new \Game\Game(self::SEED);
        $this->assertEquals(\Game\Card::TYPE_ROOM, $game->getMurderRoom()->getType());
        $this->assertEquals(\Game\Card::TYPE_WEAPON, $game->getMurderWeapon()->getType());
        $this->assertEquals(\Game\Card::TYPE_PLAYER, $game->getMurderer()->getType());
    }

    public function test_addPlayer() {
        $game = new \Game\Game(self::SEED);

        $this->assertEquals(0, count($game->getPlayers()));
        $game->addPlayer("Prof. Owens", 0);
        $this->assertEquals(1, count($game->getPlayers()));
    }

    public function test_getCard() {
        $game = new Game(self::SEED);
        $this->assertInstanceOf(\Game\Card::class, $game->getCard(0));
    }

}