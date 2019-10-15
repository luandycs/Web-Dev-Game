<?php
/**
 * Created by PhpStorm.
 * User: alu95
 * Date: 2/14/2019
 * Time: 11:52 PM
 */

namespace Game;


class Cards {


    public function __construct() {

    }

    public function shuffleDeck() {
        shuffle($this->deck);
    }

    public function getCards() {
        return $this->deck;
    }

    public function addCard($card){
        array_push($this->deck, $card);
    }

    // removes specific card in deck if present
    public function removeCard($card){
        $key = array_search($card, $this->deck);
        if($key !== false){
            array_diff_key($this->deck, array($key));
        }
    }

    public function shiftCard() {
        return array_shift($this->deck);
    }
    public function copy($array){
        $newdeck = new Cards;
        for($i=0;$i<count($this->deck);$i++){
            if(!in_array($this->deck[$i],$array)){
                $newdeck->addCard(clone $this->deck[$i]);
            }

        }
        return $newdeck;
    }
    private $deck = array();
}