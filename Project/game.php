<?php
/**
 * Created by PhpStorm.
 * User: dunnu
 * Date: 2/13/2019
 * Time: 7:37 PM
 */
require 'lib/game.inc.php';
$view = new Game\GameView($game);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WMMG - Game</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
    <script src="dist/main.js"></script>
</head>
<body>
<form class="board_game" method="post" action="game-post.php">
    <div class="game">
    <?php
        echo $view->presentMenu();
        echo $view->presentBoard();

    ?>
    </div>
</form>
</body>