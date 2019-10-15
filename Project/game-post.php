<?php
require __DIR__ . '/lib/game.inc.php';
$controller = new Game\GameController($game, $_POST);

//if($controller->isReset()) {
//    unset($_SESSION[GAME_SESSION]);
//}
// player movement
if(isset($_POST['cell'])){
    $cell = $_POST['cell'];

    $c_ar = unserialize($cell[0]);
    $row = $c_ar[0];
    $col = $c_ar[1];
    $game->move($row, $col);

}

$view = new \Game\GameView($game);
$menu  = $view->presentMenu();
$board  = $view->presentBoard();


echo json_encode(['ok' => true,'board'=>$board, 'menu'=>$menu]);


exit;