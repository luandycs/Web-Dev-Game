<?php
/**
 * Created by PhpStorm.
 * User: zoinulchoudhury
 * Date: 2019-02-22
 * Time: 18:47
 */

use \Game\Game as Game;
use \Game\Card as Card;

class CardTest extends \PHPUnit\Framework\TestCase
{
    const SEED = 1234;

    public function test_construct() {
        $card = new Card("Prof. Owen", CARD::TYPE_PLAYER, 'images/owen.jpg');
        $this->assertInstanceOf(Card::class, $card);
    }

    public function test_getName() {
        $card = new Card("Prof. Owen", CARD::TYPE_PLAYER, 'images/owen.jpg');
        $this->assertEquals("Prof. Owen", $card->getName());
    }

    public function test_getCode() {
        $card = new Card("Prof. Owen", CARD::TYPE_PLAYER, 'images/owen.jpg');
        $card->setCode("Goat");
        $this->assertEquals("Goat", $card->getCode());
    }

    public function test_getType() {
        $card = new Card("Prof. Owen", CARD::TYPE_PLAYER, 'images/owen.jpg');
        $this->assertEquals(CARD::TYPE_PLAYER, $card->getType());
    }

    public function test_getBitmap() {
        $card = new Card("Prof. Owen",  CARD::TYPE_PLAYER, 'images/owen.jpg');
        $this->assertEquals('images/owen.jpg', $card->getBitmap());
    }

    public function test_setName() {
        $card = new Card("Prof. Owen",  CARD::TYPE_PLAYER, 'images/owen.jpg');
        $this->assertEquals("Prof. Owen", $card->getName());

        $card->setName("Prof. McCullen");
        $this->assertEquals("Prof. McCullen", $card->getName());
    }


    public function test_setType() {
        $card = new Card("Prof. Owen",  CARD::TYPE_PLAYER, 'images/owen.jpg');
        $this->assertEquals(CARD::TYPE_PLAYER, $card->getType());

        $card->setType(Card::TYPE_WEAPON);
        $this->assertEquals(Card::TYPE_WEAPON, $card->getType());
    }
}