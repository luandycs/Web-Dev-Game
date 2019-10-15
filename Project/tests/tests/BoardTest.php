<?php
/**
 * Created by PhpStorm.
 * User: alu95
 * Date: 3/1/2019
 * Time: 7:39 PM
 */


class BoardTest extends \PHPUnit\Framework\TestCase
{
    public function test_construct(){
        $board = new Game\Board();

        $this->assertInstanceOf('Game\Board', $board);
    }

    public function test_resetReachableOnPath(){
        $board = new Game\Board();

        for($x = 0; $x < 25; $x ++){
            for($y = 0; $y < 24; $y ++){
                $this->assertFalse($board->getNode($x,$y)->getReachable());
            }
        }
    }

    public function test_getNode(){
        $board = new Game\Board();

        for($x = 0; $x < 25; $x ++){
            for($y = 0; $y < 24; $y ++){
                $this->assertInstanceOf('Game\Node', $board->getNode($x, $y));
            }
        }
    }
}
