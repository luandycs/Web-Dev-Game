<?php
require __DIR__ . "/../vendor/autoload.php";
/**
 * Created by PhpStorm.
 * User: alu95
 * Date: 2/14/2019
 * Time: 10:35 PM
 */
session_start();
define("GAME_SESSION", 'game');
// If there is a session, use that. Otherwise, create one
if(!isset($_SESSION[GAME_SESSION])) {
    $_SESSION[GAME_SESSION] = new Game\Game();
}

$game = $_SESSION[GAME_SESSION];