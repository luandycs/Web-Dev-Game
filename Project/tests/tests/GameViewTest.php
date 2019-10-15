<?php
/**
 * Created by PhpStorm.
 * User: dunnu
 * Date: 2/22/2019
 * Time: 5:57 PM
 */

use Game\GameView as GameView;
use Game\Game as Game;
use Game\PlayerCardsController as Controller;
class GameViewTest extends  \PHPUnit\Framework\TestCase
{
    const SEED = 1234;

    public function test_construct() {
        $game = new Game(self::SEED);
        $view = new GameView($game);
        $this->assertInstanceOf('Game\GameView',$view);
    }

    public function test_action_menu() {
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());

        $controller->addPlayer("Sir Test",0);
        $controller->addPlayer("Sir Jest",0);

        $game->setPlayer($game->getPlayers()[0]);

        $view = new GameView($game);

        $html = <<<HTML
<div class="content">
    <h3 class="player">Player</h3>
    <h3 class="player">Sir Test</h3>
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

        $this->assertContains($html,$view->presentActionMenu());

        $html = <<<HTML
<div class="content">
    <h3 class="player">Player</h3>
    <h3 class="player">Sir Jest</h3>
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

        $html .=
            '<p>
    <input type="radio" class="turn_accuse" name="selection" value="accuse">
    <label for ="accuse">Accuse</label><br>
</p>';
        $game->nextPlayer();
        $view = new GameView($game);


        $this->assertContains($html,$view->presentActionMenu());



    }
    public function test_player_list(){
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());
        $view = new GameView($game);
        $controller->addPlayer("Prof. Owen",0);
        $controller->addPlayer("Prof. McCullen",0);
        $controller->addPlayer("Prof. Onsay",0);
        $controller->addPlayer("Prof. Enbody",0);
        $controller->addPlayer("Prof. Plum",0);
        $controller->addPlayer("Prof. Day",0);

        $game->setPlayer($game->getPlayers()[0]);
        $html = <<<HTML
<div class="content">
    <h3 class="player">Player</h3>
    <h3 class="player">Prof. Owen</h3>
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
HTML;

        $this->assertContains($html,$view->presentPlayerList());
    }

    public function test_weapon_list(){
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());
        $view = new GameView($game);
        $controller->addPlayer("Prof. Owen",0);
        $controller->addPlayer("Prof. McCullen",0);
        $game->setPlayer($game->getPlayers()[0]);

        $html = <<<HTML
<div class="content">
<h3 class="player">Player</h3>
<h3 class="player">Prof. Owen</h3> 
<p>With what?</p>
<form class ="menu" action="game-post.php" method="post">
HTML;
        $this->assertContains($html,$view->presentWeaponList());

    }

    public function test_present_winner(){
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());
        $view = new GameView($game);
        $controller->addPlayer("Prof. Owen",0);
        $controller->addPlayer("Prof. McCullen",0);
        $game->setPlayer($game->getPlayers()[0]);
        $html = <<<HTML
<div class="content">
    <h3 class="player">Player</h3>
    <h3 class="player">Prof. Owen</h3>
    <p>You won the game!</p>
</div>
HTML;
        $this->assertContains($html,$view->presentWinner());
    }

    public function test_present_player_cards(){
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());
        $view = new GameView($game);
        $controller->addPlayer("Prof. Owen",0);
        $controller->addPlayer("Prof. McCullen",0);
        $game->setPlayer($game->getPlayers()[0]);
        $html = <<<HTML
<fieldset>
    <h1 class="playercards">Cards for Prof. Owen</h1c>
    <form class="no-print" action="cards-post.php" method="post">
        <p><input type="button" class="playerbuttons" onclick="window.print();return false;" value="Print">  
        <input type="submit" name="next" value="Next">
        </p>
    </form>
</fieldset>
HTML;

        $this->assertContains($html,$view->presentPlayerCards());
    }

    public function test_present_hint(){
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());
        $view = new GameView($game);
        $controller->addPlayer("Prof. Owen",0);
        $controller->addPlayer("Prof. McCullen",0);
        $game->setPlayer($game->getPlayers()[0]);

        $html = <<<HTML
<div class ="content">
    <h3 class="player">Player</h3>
    <h3 class="player">Prof. Owen</h3>
    <p>Word on the street is</p>
HTML;
        $html2 = <<<HTML
<form class="menu" action="">
    <p><input class="hidden" type="radio" value="Go" name="pass" checked></p>
    <p><input type="submit" name="Go" value = "GO"></p>
HTML;

        $this->assertContains($html,$view->presentHint());
        $this->assertContains($html2, $view->presentHint());
    }

    public function test_present_suggestion(){
        $game = new Game(self::SEED);
        $controller = new Controller($game, array());
        $view = new GameView($game);
        $controller->addPlayer("Prof. Owen",0);
        $controller->addPlayer("Prof. McCullen",0);
        $game->setPlayer($game->getPlayers()[0]);
        $html = <<<HTML
<div class="content">
    <h3 class="player">Player</h3>
    <h3 class="player">Prof. Owen</h3>
    <p>Who done it?</p>
    <form class ="menu" action="" onclick="">
HTML;

        $this->assertContains($html,$view->presentSuggestion());
    }

    }