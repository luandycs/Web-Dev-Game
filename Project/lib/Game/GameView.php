<?php
/**
 * Created by PhpStorm.
 * User: George's PC
 * Date: 2/15/2019
 * Time: 11:26 AM
 */

namespace Game;

use \Game\Game as Game;

class GameView
{
    public function __construct(Game $game) {
        $this->game = $game;
    }

    public function presentMenu(){
        //nick added this. Skips a players turn if a player goes into a room, but not the player
        //that moves into the room. Skips player after.
        /*if($this->game->getPlayerInRoom()){
            $this->game->setStatus('inroom');
        }*/
        switch($this->game->getStatus()) {
            case Game::PASS:
                $this->game->nextPlayer();
                $this->game->rollDice();
                return $this->presentDice();
                //return $this->presentActionMenu();

            case Game::INROOM:
                return $this->presentActionMenu();

            case Game::ACCUSE:
                return $this->presentPlayerList();

            case Game::SUGGEST:
                return $this->presentPlayerList();

            case Game::WEAPON:
                return $this->presentWeaponList();

            case Game::WIN:
                return $this->presentWinner();

            case Game::HINT:
                return $this->presentHint();
        }
    }

    public function presentBoard() {
        $this->game->clearDisplayed();
        $html = <<< HTML

<div class = "board">
HTML;

        $element_row_open = "<div class='row'>";
        $element_row_close = "</div>";

        foreach(range(0, 24) as $x) {
            $html .= $element_row_open;
            foreach (range(0, 23) as $y) {
                //player movement
                $html .= "<div class='cell'>";
                
                $p = $this->game->getPlayerAtPosition($x, $y);
                
                if($this->game->getNode($x, $y)->getReachable()){
                     //creates button if reachable
                    $a = array($x, $y);
                    $html.= '<button type="submit" name="cell" value="'. serialize($a) .'">';
                    if($p) {
                        if($this->game->getNode($x, $y)->getType()==Node::TYPE_ROOM){
                            $p_count = $this->game->getNode($x,$y)->getPositionCount();
                            $coords = $this->game->getNode($x,$y)->getPosition($p_count);
                            if ($coords[0] == $x && $coords[1] == $y){
                                $img = $p->getPlayerPiece();
                                $html .= '<img class="player-piece" src="' . $img . '">';
                                $this->game->setDisplayed($p);
                            }
                        }
                        else {
                            $img = $p->getPlayerPiece();
                            $html .= '<img class="player-piece" src="' . $img . '">';
                            $this->game->setDisplayed($p);
                        }
                    }
                    $html .= '</button>';

                }

                elseif($p){
                    // check if node is a room then can put a specific node to put player in
                    // maybe put a player status displayed to make sure not more that one showed
                    if($this->game->getNode($x, $y)->getType()==Node::TYPE_ROOM){
                        $p_count = $this->game->getNode($x,$y)->getPositionCount();
                        $coords = $this->game->getNode($x,$y)->getPosition($p_count);
                        if ($coords[0] == $x && $coords[1] == $y){
                            $img = $p->getPlayerPiece();
                            $html .= '<img class="player-piece" src="' . $img . '">';
                            $this->game->setDisplayed($p);
                        }
                    }
                    elseif($p){
                        $img = $p->getPlayerPiece();
                        $html .= '<img class="player-piece" src="' . $img . '">';
                        $this->game->setDisplayed($p);
                    }
                }

                $html .= "</div>";
            }
            $html .= $element_row_close;
        }
        /*
        foreach($this->game->getPlayers() as $p){
            $p->resetDisplayed();
        }*/
        //$this->game->clearDisplayedPlayers();
        return $html;
        $html.='<p><a href="index.php">New Game</a></p>';
        $html .= <<< HTML
        
</div>
</div>
</form>
HTML;

    }

    public function presentActionMenu(){
        $player = $this->game->getPlayer();
        $playerName = $player->get_name();
        $html = <<<HTML
<div class="content">
    <h3 class="player">Player</h3>
    <h3 class="player">$playerName</h3>
    <p>What do you wish to do?</p>
    <form class ="menu" action="game-post.php" method="post">
        <p>
           <input type="radio" class="turn_pass" name="selection" value="pass">
            <label for ="pass">Pass</label>
            <br>
        </p>
        <p>
            <input type="radio" class="turn_suggest" name="selection" value="suggest">
            <label for ="suggest">Suggest</label>
            <br>
        </p>
HTML;

        if ($player->getCanAccuse()){
            $html .= <<<HTML
<p>
    <input type="radio" class="turn_accuse" name="selection" value="accuse">
    <label for ="accuse">Accuse</label><br>
</p>

HTML;
        }

        $html .= <<<HTML
<p><input type="submit" value="Go"></p>
</form>
</div>
HTML;

        return $html;
    }

    public function presentPlayerList(){
        $player = $this->game->getPlayer()->get_name();
        $players = $this->game->getPlayers();

        $html = <<<HTML
<div class="content">
    <h3 class="player">Player</h3>
    <h3 class="player">$player</h3>
    <p>Who done it?</p>
    <form class ="menu" action="game-post.php" method="post">
        <input type="radio" name="player" id="player" value="Prof. Owen">
        <label for ="player">Prof. Owen</label><br>
        
        <input type="radio" name="player" id="player" value="Prof. McCullen">
        <label for ="player">Prof. McCullen</label><br>
        
        <input type="radio" name="player" id="player" value="Prof. Onsay">
        <label for ="player">Prof. Onsay</label><br>
        
        <input type="radio" name="player" id="player" value="Prof. Enbody">
        <label for ="player">Prof. Enbody</label><br>
        
        <input type="radio" name="player" id="player" value="Prof. Plum">
        <label for ="player">Prof. Plum</label><br>
        
        <input type="radio" name="player" id="player" value="Prof. Day">
        <label for ="player">Prof. Day</label><br>
        
        <p><input type="submit" value="Go"></p>
    </form>
</div>
HTML;

        return $html;
    }

    public function presentWeaponList(){
        $player = $this->game->getPlayer()->get_name();
        $cards = $this->game->getCards()->getCards();

        $html = <<<HTML
<div class="content">
<h3 class="player">Player</h3>
<h3 class="player">$player</h3> 
<p>With what?</p>
<form class ="menu" action="game-post.php" method="post">
HTML;
        /** @var $card \Game\Card */
        foreach ($cards as $card) {
            if ($card->getType() == Card::TYPE_WEAPON) {
                $name = $card->getName();
                $html .= <<<HTML
<p>
<input type="radio" name="weapon" id="weapon" value="$name">
<label for="weapon">$name</label>
</p>
HTML;
            }
        }

        $html .= <<<HTML
<p><input type="submit" value="Go"></p>
</form>
</div>
HTML;

        return $html;
    }

    public function presentWinner() {
        $player = $this->game->getPlayer()->get_name();

        $html = <<<HTML
<div class="content">
    <h3 class="player">Player</h3>
    <h3 class="player">$player</h3>
    <p>You won the game!</p>
</div>
HTML;

        return $html;
    }

    public function presentPlayerCards() {
         //increment next
        $name = $this->game->getPlayer()->get_name();
        $html = <<<HTML
<fieldset>
    <h1 class="playercards">Cards for $name</h1c>
    <form class="no-print" action="cards-post.php" method="post">
        <p><input type="button" class="playerbuttons" onclick="window.print();return false;" value="Print">  
        <input type="submit" name="next" value="Next">
        </p>
    </form>
</fieldset>
HTML;

        return $html;
    }

    /**
     * @var $game \Game\Game
     * @return html string
     */
    public function presentCards(){
        $html = <<<HTML
        <div class="print-only">
        <p class="card-header">Held Cards</p>
        
HTML;


        for($x = 0; $x < sizeof($this->game->getPlayer()->get_cards()->getCards()); $x++){
            $card = $this->game->getPlayer()->get_cards()->getCards()[$x];
            $cardImg = $card->getBitMap();
            $html.= "<div class='inline-cards'><p><img src=$cardImg alt='Image of card' width='100' height='135'></p></div>";
        }

        $html.='</div><br>
                <div class="print-only">
                <p class="card-header"><br><br><br><br><br><br><br><br><br>Other Cards</p><br> 
                '; // This shouldnt be like this

        for($x = 0; $x < sizeof($this->game->getPlayer()->getLocalDeck()->getCards()); $x++){
            $card = $this->game->getPlayer()->getLocalDeck()->getCards()[$x];
            $cardCode = $this->game->getPlayer()->getLocalDeck()->getCards()[$x]->getCode();
            for($i = 0; $i < sizeof($this->game->getPlayer()->get_cards()->getCards()); $i++){

                if( !in_array($card, $this->game->getPlayer()->get_cards()->getCards())){
                    $cardImg = $this->game->getPlayer()->getLocalDeck()->getCards()[$x]->getBitmap();
                    $html.= "<div class='inline-cards'><p><img src=$cardImg width='100' height='135'></p>";
                    $html.= "<figcaption >$cardCode </figcaption></div>";
                    break;
                }
            }

        }

        $html .='
                 </div>';

        return $html;
    }

    /**
     * @param $card card object to display
     * @param $addName bool value to display the name
     * @param $addCode bool value to display the secret code
     * @return string of html
     */
    public function presentCard($card, $addName, $addCode){
        $cardImg = $card->getBitMap();
        $cardCode = $card->getCode();
        $cardName = $card->getName();
        $html = <<<HTML
        <p>
        <div class="inline-cards"></div>
        <img src=$cardImg width="100" height="135"> <br>

HTML;
        if ($addName){
            $html.="<figcaption> $cardName </figcaption>";
        }

        if ($addCode){
            $html .= "<figcaption> $cardCode </figcaption>'";
        }

        $html .= '</div></p>';
        return $html;
    }


    public function presentDice() {
        $diceImages = array('images/dice1.png','images/dice2.png','images/dice3.png','images/dice4.png','images/dice5.png','images/dice6.png',);
        $player = $this->game->getPlayer()->get_name();

        $dice = $this->game->getDiceNum();
        $dice1 = $diceImages[$dice[0]-1];
        $dice2 = $diceImages[$dice[1]-1];
        $html = <<<HTML
<div class ="content">
    <h3 class="player">Player</h3>
    <h3 class="player">$player</h3>
    <p id ="dice">
        <img src=$dice1 alt ="dice1" height="32" width="33">
        <img src=$dice2 alt ="dice1" height="32" width="33">
   </p>
</div>
HTML;


        return $html;
    }


    public function presentHint() {
        $code = $this->game->getCode();
        $player = $this->game->getPlayer()->get_name();
        $html = <<<HTML
<div class ="content">
    <h3 class="player">Player</h3>
    <h3 class="player">$player</h3>
    <p>Word on the street is</p>
    <p>$code</p>
    <form class="menu" action="">
    <p><input class="hidden" type="radio" value="Go" name="pass" checked></p>
    <p><input type="submit" name="Go" value = "GO"></p>
    </form>
</div>
HTML;

        return $html;
    }

    public function presentSuggestion(){
        $player = $this->game->getPlayer()->get_name();
        $players = $this->game->getPlayers();

        $html = <<<HTML
<div class="content">
    <h3 class="player">Player</h3>
    <h3 class="player">$player</h3>
    <p>Who done it?</p>
    <form class ="menu" action="" onclick="">
HTML;
        /** @var $otherPlayer \Game\Player */
        foreach ($players as $otherPlayer) {
            if ($otherPlayer->get_name() != $player) {
                $html .= '<p><input type="radio" name="player" value="pass">';
                $html .= $otherPlayer->get_name();
                $html .= '</p>';
            }
        }

        $html .= '<p><input type="submit" name="Go" value="Go"></p>
                  </form>
                  </div>';

        return $html;
    }

    private $game;
}