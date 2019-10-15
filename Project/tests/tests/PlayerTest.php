<?php
/**
 * Created by PhpStorm.
 * User: nicholasescote
 * Date: 2019-02-17
 * Time: 13:53
 */

class PlayerTest extends \PHPUnit\Framework\TestCase
{
    const SEED = 1234;

    public function test_construct(){
        $node = new Game\Node();
        $player = new Game\Player('Dr. Owen', $node);

        $this->assertInstanceOf('Game\Player', $player);

        $this->assertInstanceOf('Game\Cards', $player->get_cards());
        $this->assertInstanceOf('Game\Node', $player->get_curr_node());
        $this->assertEquals('Dr. Owen', $player->get_name());
    }

    public function test_get_name(){
        $node = new Game\Node();
        $player = new Game\Player('Dr. Owen', $node);
        $this->assertEquals('Dr. Owen', $player->get_name());

        $player1 = new Game\Player('Dr. Plum', $node);
        $this->assertEquals('Dr. Plum', $player1->get_name());

        $player2 = new Game\Player('', $node);
        $this->assertEquals('', $player2->get_name());
    }

    public function test_get_cards(){
        $node = new Game\Node(1,1);
        $player = new Game\Player('Dr. Owen', $node);

        $this->assertInstanceOf('Game\Cards', $player->get_cards());
    }

    public function test_get_curr_node(){
        $node = new Game\Node();
        $player = new Game\Player('Dr. Owen', $node);

        $this->assertInstanceOf('Game\Node', $player->get_curr_node());
    }

    public function test_get_in_room(){
        $node = new Game\Node();
        $node->setType(2);

        $player = new Game\Player("Prof. Owen", $node);
        $this->assertEquals(true, $player->getInRoom());

        $node->setType(1);
        $player1 = new Game\Player("Prof. Day", $node);
        $this->assertEquals(false, $player1->getInRoom());
    }

    public function test_getCanAccuse(){
        $node = new Game\Node(1,1);
        $player = new Game\Player('Dr. Owen', $node);

        $this->assertEquals(True, $player->getCanAccuse());

        $player->setCanAccuse(False);
        $this->assertEquals(False, $player->getCanAccuse());
    }

    public function test_setCanAccuse(){
        $node = new Game\Node(1,1);
        $player = new Game\Player('Dr. Owen', $node);

        $this->assertEquals(True, $player->getCanAccuse());

        $player->setCanAccuse(False);
        $this->assertEquals(False, $player->getCanAccuse());

        $player->setCanAccuse(True );
        $this->assertEquals(True, $player->getCanAccuse());
    }

    public function test_set_curr_node(){
        $node = new Game\Node();
        $player = new Game\Player('Dr. Owen', $node);

        $this->assertInstanceOf('Game\Node', $player->get_curr_node());

        $node1 = new Game\Node();
        $player->set_curr_node($node1);
        $this->assertInstanceOf('Game\Node', $player->get_curr_node());
    }

    public function test_addCard(){
        $node = new Game\Node(1,1);
        $player = new Game\Player('Dr. Owen', $node);

        $card = new Game\Card('Prof. Owen', 'PACE', 0, 'images/owen.jpg');

        $player->addCard($card);
        $this->assertContains($card, $player->get_cards()->getCards());

    }

    public function test_get_local_deck(){
        $game = new Game\Game(self::SEED);
        $node = new Game\Node();
        $node1 = new Game\Node();
        $player = new Game\Player("Prof. Owen", $node);
        $player1 = new Game\Player("Prof. Day", $node1);
        $local_deck = new \Game\Cards();

        $card = new \Game\Card("Prof. Plum", Game\CARD::TYPE_PLAYER, 'images/plum.jpg');
        $local_deck->addCard(new Game\Card("Prof. Enbody", Game\CARD::TYPE_PLAYER, 'images/enbody.jpg'));
        $local_deck->addCard($card);
        $player->setLocalDeck($local_deck);
        $this->assertContains($card, $player->getLocalDeck()->getCards());
    }

    public function test_set_local_deck(){
        $game = new Game\Game(self::SEED);
        $node = new Game\Node();
        $node1 = new Game\Node();
        $player = new Game\Player("Prof. Owen", $node);
        $player1 = new Game\Player("Prof. Day", $node1);
        $local_deck = new \Game\Cards();

        $card = new \Game\Card("Prof. Enbody", Game\CARD::TYPE_PLAYER, 'images/enbody.jpg');
        $local_deck->addCard($card);
        $local_deck->addCard(new Game\Card("Prof. Plum", Game\CARD::TYPE_PLAYER, 'images/plum.jpg'));
        $player->setLocalDeck($local_deck);
        $this->assertContains($card, $player->getLocalDeck()->getCards());
    }


}