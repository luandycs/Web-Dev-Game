<?php
/**
 * Created by PhpStorm.
 * User: nicholasescote
 * Date: 2019-02-17
 * Time: 13:44
 */

namespace Game;


class Node
{
    const TYPE_SQUARE = 0;
    const TYPE_START = 1;
    const TYPE_ROOM = 2;

    public function __construct(){

    }

    /**
     * sets all
     * @param $distance that is rolled on the dice
     */
    public function searchReachable($distance) {
        // The path is done if it at the end of the distance
        // also true if room
        if($distance === 0 ) {
            $this->reachable = true;
            return;
        }

        $this->onPath = true;

        foreach($this->to as $to) {
            if(!$to->blocked && !$to->onPath) {
                if($to->getType() != Node::TYPE_ROOM){
                    $to->searchReachable($distance-1);
                }
                else{
                    $to->setReachable(true);
                }

            }
        }

        $this->onPath = false;

        // if current node is a room makes it an option to move to
        if($this->type == Node::TYPE_ROOM){
            $this->reachable = true;
        }
    }

    /**
     * Add a neighboring node
     * @param Node $to Node we can step into
     */
    public function addTo($to){
        $this->to[] = $to;
    }

    public function setBlocked($bool){
        $this->blocked = $bool;
    }

    public function setOnPath($bool){
        $this->onPath = $bool;
    }

    public function setReachable($bool){
        $this->reachable = $bool;
    }


    /**
     * @param const int $$type
     */
    public function setType($type){
        $this->type = $type;
    }

    public function getTo(){
        return $this->to;
    }

    /**
     * @return const int $type
     */
    public function getType(){
        return $this->type;
    }

    public function getBlocked(){
        return $this->blocked;
    }

    public function getOnPath(){
        return $this->onPath;
    }

    public function getReachable(){
        return $this->reachable;
    }

    public function getPositionCount(){
        return $this->positionCount;
    }

    public function decrementPositionCount(){
        if($this->positionCount > 0){
            $this->positionCount--;
        }
    }

    public function incrementPositionCount(){
        if($this->positionCount < 5){
            $this->positionCount++;
        }
    }

    public function getPosition($ndx){
        return $this->positions[$ndx];
    }

    public function addToPositions($arr){
        $this->positions[] = $arr;
    }


    public function getRoom() {
        return $this->room;
    }

    public function setRoom($name) {
        $this->room = $name;
    }

    private $room = "";

    // This node is blocked and cannot be visited
    private $blocked = false;
    // This node is on the current path
    private $onPath = false;
    // This node is reachable in the current move
    private $reachable = false;
    // pointers to adjacent nodes
    private $to = [];

    //display position list, only used if the nodes is a room
    private $positions = [];
    //position count
    private $positionCount = 0;
    //might not need following variables
    private $type = Node::TYPE_SQUARE;

}