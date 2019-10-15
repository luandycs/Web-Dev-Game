<?php
/**
 * Created by PhpStorm.
 * User: zoinulchoudhury
 * Date: 2019-02-14
 * Time: 18:07
 */

namespace Game;


class Game
{
    const PASS = 0;
    const INROOM = 1;
    const SUGGEST = 2;
    const ACCUSE = 3;
    const WEAPON = 4;
    const WIN = 5;
    const HINT =8;

    public function __construct($seed = null) {
        if($seed !== null) {
            srand($seed);
        }

        $this->cards = new Cards();
        $this->board = new Board();
        $this->createAllPlayers();
        $this->constructDeck();
        $this->setMurderCards();

    }

    public function constructDeck() {

        // Players
        $this->cards->addCard(new Card("Prof. Enbody", CARD::TYPE_PLAYER, 'images/enbody.jpg'));
        $this->cards->addCard(new Card("Prof. Plum", CARD::TYPE_PLAYER, 'images/plum.jpg'));
        $this->cards->addCard(new Card("Prof. Day", CARD::TYPE_PLAYER, 'images/day.jpg'));
        $this->cards->addCard(new Card("Prof. Onsay", CARD::TYPE_PLAYER, 'images/onsay.jpg'));
        $this->cards->addCard(new Card("Prof. McCullen", CARD::TYPE_PLAYER, 'images/mccullen.jpg'));
        $this->cards->addCard(new Card("Prof. Owen", CARD::TYPE_PLAYER, 'images/owen.jpg'));

        // Weapons
        $this->cards->addCard(new Card("Programming Assignment", CARD::TYPE_WEAPON, 'images/programming.jpg'));
        $this->cards->addCard(new Card("Written Assignment",  CARD::TYPE_WEAPON, 'images/written.jpg'));
        $this->cards->addCard(new Card("Project",  CARD::TYPE_WEAPON, 'images/project.jpg'));
        $this->cards->addCard(new Card("Quiz",  CARD::TYPE_WEAPON, 'images/quiz.jpg'));
        $this->cards->addCard(new Card("Midterm Exam",  CARD::TYPE_WEAPON, 'images/midterm.jpg'));
        $this->cards->addCard(new Card("Final Exam",  CARD::TYPE_WEAPON, 'images/final.jpg'));

        // Locations
        $this->cards->addCard(new Card("Wharton Center",  CARD::TYPE_ROOM, 'images/wharton.jpg'));
        $this->cards->addCard(new Card("Spartan Stadium",  CARD::TYPE_ROOM, 'images/stadium.jpg'));
        $this->cards->addCard(new Card("Breslin Center",  CARD::TYPE_ROOM, 'images/breslin.jpg'));
        $this->cards->addCard(new Card("University Union",  CARD::TYPE_ROOM, 'images/union.jpg'));
        $this->cards->addCard(new Card("Engineering Building",  CARD::TYPE_ROOM, 'images/engineering.jpg'));
        $this->cards->addCard(new Card("International Center",  CARD::TYPE_ROOM, 'images/international.jpg'));
        $this->cards->addCard(new Card("Library",  CARD::TYPE_ROOM, 'images/library.jpg'));
        $this->cards->addCard(new Card("Beaumont Tower",  CARD::TYPE_ROOM, 'images/beaumont.jpg'));
        $this->cards->addCard(new Card("Art Museum",  CARD::TYPE_ROOM, 'images/museum.jpg'));

        $this->cards->shuffleDeck();

    }

    public function dealCards() {
        $numPlayers = count($this->players);
        $numCards = (int)(18/$numPlayers);
        $tempDeck = $this->cards->copy($temp = array($this->murderer,$this->murderRoom,$this->murderWeapon));

        for ($j = 0; $j < count($this->players); $j++) {

            $this->player = $this->players[$j];


            while (true) {

                if (count($this->player->get_cards()->getCards()) >= $numCards || count($this->player->get_cards()->getCards())>=6 ) {
                    break;
                }

                $card = $tempDeck->shiftCard();
                $this->player->addCard($card);
            }
            $localDeck = $this->cards->copy($this->player->get_cards()->getCards());
            $this->player->setLocalDeck($localDeck);
            $this->player->generateCodes();
        }
    }

    public function addPlayer($name,$startNode){
        $this->players[] = new Player($name,$startNode);
    }

    public function createAllPlayers() {
        $this->allPlayers[] = new Player("Prof. Owen", $this->getNode(0,14));
        $this->allPlayers[] = new Player("Prof. McCullen", $this->getNode(0,9));
        $this->allPlayers[] = new Player("Prof. Onsay", $this->getNode(17,0));
        $this->allPlayers[] = new Player("Prof. Enbody", $this->getNode(24,7));
        $this->allPlayers[] = new Player("Prof. Plum", $this->getNode(19,23));
        $this->allPlayers[] = new Player("Prof. Day", $this->getNode(7,23));
    }

    public function nextPlayer(){
        $this->playerIndex++;
        if($this->playerIndex < count($this->players)) {
            $this->player = $this->players[$this->playerIndex];
            return true;
        }
        $this->playerIndex=0;
        $this->player = $this->players[$this->playerIndex];
        return false;
    }

    public function rollDice() {
        $dice1 = rand(1,6);
        $dice2 = rand(1,6);

        $this->dice[0] = $dice1;
        $this->dice[1] = $dice2;

        $this->player->get_curr_node()->searchReachable($dice1+$dice2);
    }


    public function accusePlayer($player) {
        $this->accusedPlayer = $player;
        $this->setStatus(Game::WEAPON);
        foreach($this->players as $p) {
            if ($p->get_name() == $player) {
                $p->set_curr_node($this->player->get_curr_node());
            }
        }
    }

    public function accuseWeapon($weapon) {
        $this->accusedWeapon = $weapon;

        if ($this->accusedPlayer == $this->murderer ->getName()
            and $this->accusedWeapon == $this->murderWeapon ->getName()
            and $this->currentRoom == $this->murderRoom ->getName()) {
            //Player wins, need to also check if the player is in the correct room in the condition above.
            $this->setStatus(Game::WIN);
        }

        else {
            $this->player->setCanAccuse(False);
            $this->setStatus(Game::PASS); // Set to Game::PASS after movement implemented.
        }
    }

    public function setMurderCards() {
        $roomSet = False;
        $weaponSet = False;
        $playerSet = False;

        /** @var $card \Game\Card */
        foreach ($this->cards->getCards() as $card) {
            // Break out of loop if all murder cards are set
            if ($roomSet and $weaponSet and $playerSet) {
                break;
            }

            // Set the murder Room Card
            if ($card->getType() == Card::TYPE_ROOM and $roomSet == False) {
                $this->murderRoom = $card;
                $this->cards->removeCard($card);
                $roomSet = True;
            }

            // Set the murder Weapon Card
            if ($card->getType() == Card::TYPE_WEAPON and $weaponSet == False) {
                $this->murderWeapon = $card;
                $this->cards->removeCard($card);
                $weaponSet = True;
            }

            // Set the murder Player Card
            if ($card->getType() == Card::TYPE_PLAYER and $playerSet == False) {
                $this->murderer = $card;
                $this->cards->removeCard($card);
                $playerSet = True;
            }
        }
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }

    public function setStatus($status) {
        if ($status == 'pass') {
            $this->status = Game::PASS;

        }

        elseif ($status == 'inroom') {
            $this->status = Game::INROOM;
        }

        elseif ($status == 'suggest') {
            $this->suggestion = true;
            $this->status = Game::SUGGEST;
        }

        elseif ($status == 'accuse') {
            $this->status = Game::ACCUSE;
            $this->suggestion = false;
        }

        else {
            $this->status = $status;
        }

    }

    /**
     * @return array
     */
    public function getPlayers()
    {
        return $this->players;
    }

    public function getPlayer() {
        return $this->player;
    }

    public function getCard($c) {
        return $this->cards->getCards()[$c];
    }

    public function getCards(){
        return $this->cards;
    }

    public function getRoom($r) {
        return $this->rooms[$r];
    }

    public function getMurderer() {
        return $this->murderer;
    }

    public function getMurderRoom() {
        return $this->murderRoom;
    }

    public function getMurderWeapon() {
        return $this->murderWeapon;
    }

    public function getDiceNum() {
        return $this->dice;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getNode($row, $col){
        return $this->board->getNode($row,$col);
    }

    public function setCurrentRoom($room){
        $this->currentRoom = $room;
    }

    public function suggestPlayer($player) {
        $this->suggestedPlayer = $player;
        $this->setStatus(Game::WEAPON);

        foreach($this->players as $p) {
            if ($p->get_name() == $player) {
                $p->set_curr_node($this->player->get_curr_node());
            }
        }
    }

    public function suggestWeapon($weapon)
    {
        #move suggestedPlayer to current room


        #if their guesses not the murderer get code word for that guess else code is
        $player = $this->player;
        if ($this->suggestedPlayer != $this->murderer->getName()) {
            $suggestion = $player->getCodeWord($this->suggestedPlayer);
            if ($suggestion != "") {
                $this->code = $suggestion;
            }
            else {
                $this->code = "I got nothing!";
            }
        }
        else if ($weapon != $this->murderWeapon->getName()) {
            $suggestion = $player->getCodeWord($weapon);
            if ($suggestion != "") {
                $this->code = $suggestion;
            }
            else {
                $this->code = "I got nothing!";
            }
        }
        else {
            #need to check current room here first
            if($this->currentRoom != $this->murderRoom->getName()) {
                $suggestion = $player->getCodeWord($this->currentRoom);
                if ($suggestion != "") {
                    $this->code = $suggestion;
                } else {
                    $this->code = "I got nothing!";
                }
            }


            $this->code = "I got nothing!";

        }
        #testing to make sure we are getting weapon
        $this->setStatus(Game::HINT);
    }


    public function move($row, $col) {
        //set player curr_node
        //clear last node -- done in set_curr_node
        //occupy new node -- done in set_curr_node
        //reset nodes reachable to false after move is executed
        $this->player->set_curr_node($this->board->getNode($row, $col));

        if ($this->getPlayerInRoom()) {
            $this->setStatus("inroom");
            $this -> currentRoom = $this->player->get_curr_node()->getRoom();
        }

        $this->board->resetReachableOnPath();

    }


    public function isSuggestion() {
        return $this->suggestion;
    }

    public function getCode() {
        return $this->code;
    }

    public function getPlayerAtPosition($row, $col){
        $node = $this->getNode($row, $col);
        foreach($this->players as $p){
           if(($p->get_curr_node() === $node) && ($p->getDisplayed() == false)){
                {
                   //$this->displayedPlayers[] = $p;
                   return $p;
               }
           }
        }
        return false;
    }

    public function setDisplayed($player){
        $player->setDisplayed();
    }

    public function clearDisplayed(){
        foreach($this->players as $p){
            $p->resetDisplayed();
        }
    }

    public function getPlayerInRoom(){
        return $this->player->get_curr_node()->getType() == Node::TYPE_ROOM;
    }


    private $displayedPlayers = [];
    private $board;

    private $dice = array(0,0);
    private $rooms = [];

    /** @var $cards \Game\Cards */
    private $cards;

    // Remove default(INROOM) value after movement implemented
    private $status = Game::PASS;

    /** @var $player \Game\Player */
    private $player;
    private $players = [];
    private $playerIndex=0;

    private $allPlayers = [];

    /** @var $murderRoom \Game\Card */
    private $murderRoom;

    /** @var $murderWeapon \Game\Card */
    private $murderWeapon;

    /** @var $murderer \Game\Card */
    private $murderer;

    private $accusedPlayer;
    private $accusedWeapon;
    private $currentRoom;

    private $suggestedPlayer;
    private $suggestion = false;
    private $code;

}