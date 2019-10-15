<?php
require __DIR__ . '/lib/game.inc.php';
$controller = new Game\PlayerCardsController($game, $_POST);
/*
if($controller->isReset()) {
    unset($_SESSION[GAME_SESSION]);
}
*/
if(isset($_POST['next'])){
    if(!$game->nextPlayer()){
        header("location: game.php");
        exit;
    }
}

header("location: playercards.php");
exit;