<?php
/**
 * Created by PhpStorm.
 * User: dunnu
 * Date: 2/14/2019
 * Time: 7:22 PM
 */

namespace Game;

use \Game\Game as Game;

class GameController
{
    public function __construct(Game $game, $post) {
        $this->game = $game;
        //check for form values here
//        if(isset($post['value'])) {
//            //do something
//        }
        if (isset($post['suggest'])) {
            $this->game->setStatus($post['suggest']);
        }

        if (isset($post['inroom'])) {
            $this->game->setStatus($post['inroom']);
        }

        if (isset($post['selection'])) {
            $this->game->setStatus($post['selection']);
        }

        if (isset($post['player'])) {
            if($game->isSuggestion()) {
                $game->suggestPlayer($post['player']);
            }
            else {
                $game->accusePlayer($post['player']);
            }
        }

        if (isset($post['weapon'])) {
            if($game->isSuggestion()) {
                $game->suggestWeapon($post['weapon']);
            }
            else {
                $game->accuseWeapon($post['weapon']);
            }
        }

        if (isset($post['pass'])) {
            $game->setStatus($post['pass']);
        }
    }

    private $game;

}