<?php
/**
 * Created by PhpStorm.
 * User: nicholasescote
 * Date: 2019-02-17
 * Time: 13:23
 */
//require_once __DIR__ . '/vendor/autoload.php';
require 'lib/game.inc.php';
$view = new Game\GameView($game);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Game - Player's Cards</title>
    <link href="game.css" type="text/css" rel="stylesheet" />
</head>
<body>
    <?php
        echo $view->presentPlayerCards();
        echo $view->presentCards();
    ?>
</body>
</html>
