<?php
/**
 * Created by PhpStorm.
 * User: nicholasescote
 * Date: 2019-02-17
 * Time: 13:54
 */

class NodeTest extends \PHPUnit\Framework\TestCase
{

    public function test_construct(){
        $node = new Game\Node();

        $this->assertInstanceOf('Game\Node', $node);

        $node1 = new Game\Node();

        $this->assertInstanceOf('Game\Node', $node1);
    }
    public function test_search_reachable(){
        $node = new Game\Node();
        $node->searchReachable(0);
        $this->assertEquals(true, $node->getReachable());

        $node1 = new Game\Node();
        $node1->searchReachable(1);
        $this->assertEquals(false, $node1->getOnPath());

        $node2 = new Game\Node();
        $node2->addTo($node1);
        $node2->searchReachable(1);
        $this->assertEquals(false, $node2->getOnPath());
        $this->assertEquals(true, $node1->getReachable());

        $node_blocked = new Game\Node();
        $node_blocked->setBlocked(true);

        $node_not_on_path = new Game\Node();
        $node_not_on_path->setOnPath(false);

        $node3 = new Game\Node();
        $node3->addTo($node_blocked);
        $node3->addTo($node_not_on_path);
        $node3->searchReachable(3);
        $this->assertEquals(false, $node_blocked->getReachable());
        $this->assertEquals(false, $node_not_on_path->getReachable());

        $node_room = new Game\Node();
        $node_room->setType(2);
        $node_room->searchReachable(2);
        $this->assertEquals(true, $node_room->getReachable());

        $node5 = new Game\Node();
        $node5->setType(1);
        $node5->setReachable(false);
        $node5->searchReachable(2);
        $this->assertEquals(false, $node5->getReachable());
    }

    public function test_add_to(){
        $node = new Game\Node();
        $node2 = new Game\Node();
        $node3 = new Game\Node();
        $node_list = [];
        array_push($node_list, $node, $node2);
        $node3->addTo($node);
        $node3->addTo($node2);
        $this->assertEquals($node_list, $node3->getTo());
    }

    public function test_set_blocked(){
        $node = new Game\Node();
        $node->setBlocked(true);
        $this->assertEquals(true, $node->getBlocked());

        $node1 = new Game\Node();
        $node1->setBlocked(false);
        $this->assertEquals(false, $node1->getBlocked());
    }

    public function test_set_on_path(){
        $node = new Game\Node();
        $node->setOnPath(false);
        $this->assertEquals(false, $node->getOnPath());

        $node1 = new Game\Node();
        $node1->setOnPath(true);
        $this->assertEquals(true, $node1->getOnPath());
    }

    public function test_set_reachable(){
        $node = new Game\Node();
        $node->setReachable(false);
        $this->assertEquals(false, $node->getReachable());

        $node1 = new Game\Node();
        $node1->setReachable(true);
        $this->assertEquals(true, $node1->getReachable());
    }

    public function test_set_type(){
        $node = new Game\Node();
        $node->setType(0);
        $this->assertEquals(0, $node->getType());

        $node1 = new Game\Node();
        $node1->setType(1);
        $this->assertEquals(1, $node1->getType());

        $node2 = new Game\Node();
        $node2->setType(2);
        $this->assertEquals(2, $node2->getType());
    }

    public function test_get_to(){
        $node = new Game\Node();
        $node2 = new Game\Node();
        $node3 = new Game\Node();
        $node_list = [];
        array_push($node_list, $node, $node2);
        $node3->addTo($node);
        $node3->addTo($node2);
        $this->assertEquals($node_list, $node3->getTo());
    }

    public function test_get_type(){
        $node = new Game\Node();

        $node->setType(0);
        $this->assertEquals(0, $node->getType());

        $node->setType(1);
        $this->assertEquals(1, $node->getType());

        $node->setType(2);
        $this->assertEquals(2, $node->getType());
    }

    public function test_get_blocked(){
        $node = new Game\Node();
        $node->setBlocked(true);
        $this->assertEquals(true, $node->getBlocked());

        $node1 = new Game\Node();
        $node1->setBlocked(false);
        $this->assertEquals(false, $node1->getBlocked());
    }

    public function test_get_on_path(){
        $node = new Game\Node();
        $node->setOnPath(false);
        $this->assertEquals(false, $node->getOnPath());

        $node1 = new Game\Node();
        $node1->setOnPath(true);
        $this->assertEquals(true, $node1->getOnPath());
    }

    public function test_get_reachable(){
        $node = new Game\Node();
        $node->setReachable(false);
        $this->assertEquals(false, $node->getReachable());

        $node1 = new Game\Node();
        $node1->setReachable(true);
        $this->assertEquals(true, $node1->getReachable());
    }

}