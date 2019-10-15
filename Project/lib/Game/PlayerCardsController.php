<?php
/**
 * Created by PhpStorm.
 * User: nicholasescote
 * Date: 2019-02-19
 * Time: 02:20
 */

namespace Game;


class PlayerCardsController
{
    public function __construct(Game $game, $post) {
        if(isset($post['clear'])) {
            $this->reset = true;
        }
        $this->game=$game;
    }

    public function isReset(){
        return $this->reset;
    }

    public function addPlayer($name, $startNode){
        $this->game->addPlayer($name,$startNode);
    }


    private $playerIndex=0;
    private $game;
    private $reset = false;
    //private $playercards;

}