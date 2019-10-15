<?php

require 'lib/index.inc.php';
$controller = new Game\PlayerCardsController($game, $_POST);

if(isset($_POST['owen'])){
    $controller->addPlayer("Prof. Owen", $game->getNode(0,14));
}

if(isset($_POST['mccullen'])){
    $controller->addPlayer("Prof. McCullen", $game->getNode(0,9));
}

if(isset($_POST['onsay'])){
    $controller->addPlayer("Prof. Onsay", $game->getNode(17,0));
}

if(isset($_POST['enbody'])){
    $controller->addPlayer("Prof. Enbody", $game->getNode(24,7));
}

if(isset($_POST['plum'])){
    $controller->addPlayer("Prof. Plum", $game->getNode(19,23));
}

if(isset($_POST['day'])){
    $controller->addPlayer("Prof. Day", $game->getNode(7,23));
}


$game->dealCards();
$game->setPlayer($game->getPlayers()[0]);
if(count($game->getPlayers()) < 2){
    header("location: index.php");
    exit;
}
header("location: cards-post.php"); //changed to cards post
exit;