<?php
/**
 * Created by PhpStorm.
 * User: dunnu
 * Date: 2/13/2019
 * Time: 7:37 PM
 */

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>WMMG - Select Players</title>
    <link href="game.css" type="text/css" rel="stylesheet" />

</head>
<body>
    <form method="post" action="index-post.php">
        <fieldset>
            <input type="checkbox" name="owen" id="owen">
            <label for ="owen">Prof. Owen</label><br>
            <input type="checkbox" name="mccullen" id="mccullen">
            <label for ="mccullen">Prof. McCullen</label><br>
            <input type="checkbox" name="onsay" id="onsay">
            <label for ="onsay">Prof. Onsay</label><br>
            <input type="checkbox" name="enbody" id="enbody">
            <label for ="enbody">Prof. Enbody</label><br>
            <input type="checkbox" name="plum" id="plum">
            <label for ="plum">Prof. Plum</label><br>
            <input type="checkbox" name="day" id="day">
            <label for ="day">Prof. Day</label><br>
            <p>Select at least 2 players to play the game.</p>
            <p><input type="submit" name="submit" onclick=""></p>
            <p><a href="instructions.php">Instructions</a></p>


        </fieldset>
    </form>
</body>