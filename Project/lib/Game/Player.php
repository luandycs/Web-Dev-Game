<?php
/**
 * Created by PhpStorm.
 * User: nicholasescote
 * Date: 2019-02-14
 * Time: 14:52
 */

namespace Game;

class Player
{
    public function __construct($name, $node){
        $this->name = $name;
        $this->curr_node = $node;
        $this->cards = new Cards();
        $this->allCodes = ["eyeball","maraca","violin","rum","coconut","kitchen","flamingo","robin","duck","menagerie",
            "lounge","earlobe","radio","tomato","couscous", "football", "soccer","nose","jumper"];
        $pieces = array(
            'owen' => 'images/owen-piece.png',
            'mccullen' => 'images/mccullen-piece.png',
            'day' => 'images/day-piece.png',
            'plum' => 'images/plum-piece.png',
            'onsay' => 'images/onsay-piece.png',
            'enbody' =>  'images/enbody-piece.png'
        );
        if($name == "Prof. Owen"){
            $this->playerPiece = $pieces['owen'];
        }
        elseif($name == "Prof. McCullen"){
            $this->playerPiece = $pieces['mccullen'];
        }
        elseif($name == "Prof. Onsay"){
            $this->playerPiece = $pieces['onsay'];
        }
        elseif($name == "Prof. Enbody"){
            $this->playerPiece = $pieces['enbody'];
        }
        elseif($name == "Prof. Plum"){
            $this->playerPiece = $pieces['plum'];
        }
        elseif($name == "Prof. Day"){
            $this->playerPiece = $pieces['day'];
        }
    }

    /**
     * returns player name
     * @return string $name
     */
    public function get_name(){
        return $this->name;
    }


    public function get_cards(){
        return $this->cards;
    }

    /**
     * @return Node Object $curr_node
     */
    public function get_curr_node(){
        return $this->curr_node;
    }

    public function getInRoom(){
        if($this->curr_node->getType() == Node::TYPE_ROOM){
            return true;
        }
        return false;
    }

    public function getCanAccuse() {
        return $this->canAccuse;
    }

    public function setCanAccuse($bool) {
        $this->canAccuse = $bool;
    }

    /**
     * sets $curr_node to $new_node
     * @param $new_node
     */
    public function set_curr_node($new_node){
        //for player movement if the node is occupied/blocked
        //clears last node and and occupies new one
        $this->curr_node->setBlocked(false);
        if($this->curr_node->getType() == Node::TYPE_ROOM) {
            $this->curr_node->decrementPositionCount();
        }
        $this->curr_node = $new_node;
        if($this->curr_node->getType() != Node::TYPE_ROOM) {
            $this->curr_node->setBlocked(true);
        }
        elseif($this->curr_node->getType() == Node::TYPE_ROOM){
            $this->curr_node->incrementPositionCount();
        }
    }

    public function addCard($card) {
       $this->cards->addCard($card);
    }

    /**
     * @return mixed
     */
    public function getLocalDeck()
    {
        return $this->localDeck;
    }
    public function setLocalDeck($deck){
        $this->localDeck = $deck;
        for($i=0;$i<count($this->cards->getCards());$i++){
            if(in_array($this->cards->getCards()[$i],$this->localDeck->getCards())){
                $this->localDeck->removeCard($this->cards->getCards()[$i]);
            }
        }
    }


    public function getCodeWord($card){
        $deck = $this->localDeck->getCards();

        foreach ($deck as $cards) {
            if ($cards->getName() == $card) {
                return $cards->getCode();
            }
        }


        return "";

    }

    public function generateCodes(){
        $i=0;
        shuffle($this->allCodes);
        while($i<count($this->localDeck->getCards())){
            $code = $this->allCodes[$i];
            $this->localDeck->getCards()[$i]->setCode($code);
            $i++;
        }
    }

    //player display
    public function getPlayerPiece(){
        return $this->playerPiece;
    }

    public function getDisplayed(){
        return $this->displayed;
    }

    public function setDisplayed(){
        $this->displayed = true;
    }

    public function resetDisplayed(){
        $this->displayed = false;
    }

    private $displayed = false;
    private $name;
    private $cards;
    private $localDeck;
    private $canAccuse = True;
    private $curr_node;
    private $allCodes = array();
    private $playerPiece;
}
