<?php
/**
 * Created by PhpStorm.
 * User: George's PC
 * Date: 2/26/2019
 * Time: 7:14 PM
 */
use \Game\Game as Game;
use \Game\Card as Card;
use \Game\Cards as Cards;

class CardsTest extends \PHPUnit\Framework\TestCase
{
    public function test_addGet() {
        $card = new Card("Prof. Owen", CARD::TYPE_PLAYER, 'images/owen.jpg');
        $cards = new Cards;
        $cards->addCard($card);
        $this->assertTrue(in_array($card, $cards->getCards()));
    }
}