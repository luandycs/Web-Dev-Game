<?php
/**
 * Created by PhpStorm.
 * User: alu95
 * Date: 2/28/2019
 * Time: 12:15 AM
 */

class GameControllerTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct(){
        $game = new Game\Game();
        $controller = new Game\GameController($game, 'none');

        $this->assertInstanceOf('Game\GameController', $controller);
    }
}