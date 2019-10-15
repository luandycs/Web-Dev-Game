<?php
/**
 * Created by PhpStorm.
 * User: zoinulchoudhury
 * Date: 2019-02-14
 * Time: 18:08
 */

namespace Game;


use phpDocumentor\Reflection\Types\This;

class Board
{
    public function __construct() {

        //creates room Nodes
        $ic = new Node();
        $ic->setType(Node::TYPE_ROOM);
        $ic->setRoom("International Center");
        $this->nodes['International Center'] = $ic;
        $this->nodes['International Center']->addToPositions(array(2,2));
        $this->nodes['International Center']->addToPositions(array(2,3));
        $this->nodes['International Center']->addToPositions(array(3,2));
        $this->nodes['International Center']->addToPositions(array(3,3));
        $this->nodes['International Center']->addToPositions(array(4,2));
        $this->nodes['International Center']->addToPositions(array(4,3));


        $bc = new Node();
        $bc->setRoom('Breslin Center');
        $bc->setType(Node::TYPE_ROOM);
        $this->nodes['Breslin Center'] = $bc;
        $this->nodes['Breslin Center']->addToPositions(array(3,11));
        $this->nodes['Breslin Center']->addToPositions(array(3,12));
        $this->nodes['Breslin Center']->addToPositions(array(4,11));
        $this->nodes['Breslin Center']->addToPositions(array(4,12));
        $this->nodes['Breslin Center']->addToPositions(array(5,11));
        $this->nodes['Breslin Center']->addToPositions(array(5,12));

        $bt = new Node();
        $bt->setRoom('Beaumont Tower');
        $bt->setType(Node::TYPE_ROOM);
        $this->nodes['Beaumont Tower'] = $bt;
        $this->nodes['Beaumont Tower']->addToPositions(array(2,20));
        $this->nodes['Beaumont Tower']->addToPositions(array(2,21));
        $this->nodes['Beaumont Tower']->addToPositions(array(3,20));
        $this->nodes['Beaumont Tower']->addToPositions(array(3,21));
        $this->nodes['Beaumont Tower']->addToPositions(array(4,20));
        $this->nodes['Beaumont Tower']->addToPositions(array(4,21));

        $uu = new Node();
        $uu->setType(Node::TYPE_ROOM);
        $uu->setRoom('University Union');
        $this->nodes['University Union'] = $uu;
        $this->nodes['University Union']->addToPositions(array(12,2));
        $this->nodes['University Union']->addToPositions(array(12,3));
        $this->nodes['University Union']->addToPositions(array(12,4));
        $this->nodes['University Union']->addToPositions(array(13,2));
        $this->nodes['University Union']->addToPositions(array(13,3));
        $this->nodes['University Union']->addToPositions(array(13,4));


        $am = new Node();
        $am->setType(Node::TYPE_ROOM);
        $am ->setRoom('Art Museum');
        $this->nodes['Art Museum'] = $am;
        $this->nodes['Art Museum']->addToPositions(array(9,19));
        $this->nodes['Art Museum']->addToPositions(array(9,21));
        $this->nodes['Art Museum']->addToPositions(array(11,19));
        $this->nodes['Art Museum']->addToPositions(array(11,21));
        $this->nodes['Art Museum']->addToPositions(array(10,20));
        $this->nodes['Art Museum']->addToPositions(array(10,22));

        $wc = new Node();
        $wc->setType(Node::TYPE_ROOM);
        $wc ->setRoom('Wharton Center');
        $this->nodes['Wharton Center'] = $wc;
        $this->nodes['Wharton Center']->addToPositions(array(21,2));
        $this->nodes['Wharton Center']->addToPositions(array(21,3));
        $this->nodes['Wharton Center']->addToPositions(array(21,4));
        $this->nodes['Wharton Center']->addToPositions(array(22,2));
        $this->nodes['Wharton Center']->addToPositions(array(22,3));
        $this->nodes['Wharton Center']->addToPositions(array(22,4));

        $li = new Node();
        $li->setType(Node::TYPE_ROOM);
        $li ->setRoom('Library');
        $this->nodes['Library'] = $li;
        $this->nodes['Library']->addToPositions(array(15,19));
        $this->nodes['Library']->addToPositions(array(15,21));
        $this->nodes['Library']->addToPositions(array(17,19));
        $this->nodes['Library']->addToPositions(array(17,21));
        $this->nodes['Library']->addToPositions(array(16,20));
        $this->nodes['Library']->addToPositions(array(16,22));

        $ss = new Node();
        $ss->setType(Node::TYPE_ROOM);
        $ss ->setRoom('Spartan Stadium');
        $this->nodes['Spartan Stadium'] = $ss;
        $this->nodes['Spartan Stadium']->addToPositions(array(20,11));
        $this->nodes['Spartan Stadium']->addToPositions(array(20,12));
        $this->nodes['Spartan Stadium']->addToPositions(array(21,11));
        $this->nodes['Spartan Stadium']->addToPositions(array(21,12));
        $this->nodes['Spartan Stadium']->addToPositions(array(22,11));
        $this->nodes['Spartan Stadium']->addToPositions(array(22,12));


        $eb = new Node();
        $eb->setType(Node::TYPE_ROOM);
        $eb ->setRoom('Engineering Building');
        $this->nodes['Engineering Building'] = $eb;
        $this->nodes['Engineering Building']->addToPositions(array(22,19));
        $this->nodes['Engineering Building']->addToPositions(array(22,20));
        $this->nodes['Engineering Building']->addToPositions(array(22,21));
        $this->nodes['Engineering Building']->addToPositions(array(23,19));
        $this->nodes['Engineering Building']->addToPositions(array(23,20));
        $this->nodes['Engineering Building']->addToPositions(array(23,21));

        //initialize grid
        for($row = 0; $row < 25; $row++){
            $row_contents = [];
            for($col = 0; $col < 24; $col++){
                //section for setting starting nodes
                if($row == 0){
                    $new_node = new Node();
                    if($col == 9 || $col == 14){
                        $new_node->setType(Node::TYPE_START);
                        array_push($row_contents, $new_node);
                        continue;
                    }
                    else{
                        $new_node->setBlocked(true);
                        array_push($row_contents, $new_node);
                        continue;
                    }
                }
                elseif((($row == 7 || $row == 19) && $col == 23) || ($row == 17 &&
                    $col == 0)){
                    $new_node = new Node();
                    $new_node->setType(Node::TYPE_START);
                    array_push($row_contents, $new_node);
                }
                // sets nodes for room and menu
                elseif($row == 1 && ($col > 9 && $col < 14)){
                    array_push($row_contents, $this->nodes['Breslin Center']);
                }
                elseif(($row > 0 && $row < 7) && $col < 6){
                    array_push($row_contents, $this->nodes['International Center']);
                }
                // maybe use this conditional to set al blocked nodes
                elseif ((($row ==1) && ($col == 6 || $col == 17)) || ($col == 0 && ($row == 6
                        || $row == 8 || $row == 16 || $row == 18)) || ($col == 23 && ($row == 5
                        || $row == 6 || $row == 13  || $row == 14 || $row == 18 || $row  == 20))
                        || ($row == 24 && ($col == 6 || $col == 8 || $col  == 15 || $col == 17))){
                    $new_node = new Node;
                    $new_node->setBlocked(true);
                    array_push($row_contents, $new_node);
                }
                elseif(($row < 8 && $row >1) && ($col > 7 && $col <16 )){
                    array_push($row_contents, $this->nodes['Breslin Center']);
                }
                elseif(($row >0 && $row < 6) && $col > 17){
                    array_push($row_contents, $this->nodes['Beaumont Tower']);
                }
                elseif(($row > 7 && $row < 13) && $col > 17){
                    array_push($row_contents, $this->nodes['Art Museum']);
                }
                elseif($row ==9 && $col < 5){
                    array_push($row_contents, $this->nodes['University Union']);
                }
                elseif(($row > 9 && $row < 16) && $col < 8){
                    array_push($row_contents, $this->nodes['University Union']);
                }
                elseif(($row >9 && $row < 17) && ($col > 9 && $col < 15)){ // sets nodes for menu
                    $new_node = new Node();
                    $new_node->setBlocked(true);
                    array_push($row_contents, $new_node);
                }
                elseif(($row == 14 || $row == 18) && ($col > 17)){
                    array_push($row_contents, $this->nodes['Library']);
                }
                elseif(($row > 14 && $row < 18) && ($col > 16)){
                    array_push($row_contents, $this->nodes['Library']);
                }
                elseif($row > 18 && $col < 7){
                    array_push($row_contents, $this->nodes['Wharton Center']);
                }
                elseif($row > 17 && ($col >8 && $col <15)){
                    array_push($row_contents, $this->nodes['Spartan Stadium']);
                }
                elseif($row > 20 && $col > 16){
                    array_push($row_contents, $this->nodes['Engineering Building']);
                }
                elseif($row == 24){
                    $new_node = new Node();
                    if($col == 7){
                        $new_node->setType(Node::TYPE_START);

                    }
                    elseif($col == 16){
                        $new_node->setType(Node::TYPE_SQUARE);
                    }
                    array_push($row_contents, $new_node);
                }
                else{
                    $new_node = new Node();
                    array_push($row_contents, $new_node);
                }

            }
            array_push($this->grid, $row_contents);
        }

        //assigning movable nodes to each node
        for($row = 0; $row < 25; $row++) {
            for ($col = 0; $col < 24; $col++) {
                if($this->grid[$row][$col]->getBlocked() == false && $this->grid[$row][$col]->getType() != Node::TYPE_ROOM){
                    if($row < 24 && $this->grid[$row+1][$col]->getBlocked() == false && $this->grid[$row+1][$col]->getType() != Node::TYPE_ROOM){
                        $this->grid[$row][$col]->addTo($this->grid[$row+1][$col]);
                    }
                    if($row > 0 && $this->grid[$row-1][$col]->getBlocked() == false && $this->grid[$row-1][$col]->getType() != Node::TYPE_ROOM){
                        $this->grid[$row][$col]->addTo($this->grid[$row-1][$col]);
                    }
                    if($col < 23 && $this->grid[$row][$col+1]->getBlocked() == false && $this->grid[$row][$col+1]->getType() != Node::TYPE_ROOM){
                        $this->grid[$row][$col]->addTo($this->grid[$row][$col+1]);
                    }
                    if($col > 0 && $this->grid[$row][$col-1]->getBlocked() == false && $this->grid[$row][$col-1]->getType() != Node::TYPE_ROOM){
                        $this->grid[$row][$col]->addTo($this->grid[$row][$col-1]);
                    }
                }
                //echo '<br/>';
            }
        }

        //adds the rooms to the nodes outside the entrance
        $this->grid[7][4]->addTo($this->nodes['International Center']);
        $this->grid[5][7]->addTo($this->nodes['Breslin Center']);
        $this->grid[8][9]->addTo($this->nodes['Breslin Center']);
        $this->grid[8][14]->addTo($this->nodes['Breslin Center']);
        $this->grid[5][16]->addTo($this->nodes['Breslin Center']);
        $this->grid[6][18]->addTo($this->nodes['Beaumont Tower']);
        $this->grid[12][8]->addTo($this->nodes['University Union']);
        $this->grid[16][6]->addTo($this->nodes['University Union']);
        $this->grid[9][17]->addTo($this->nodes['Art Museum']);
        $this->grid[13][22]->addTo($this->nodes['Art Museum']);
        $this->grid[13][20]->addTo($this->nodes['Art Museum']);
        $this->grid[16][16]->addTo($this->nodes['Library']);
        $this->grid[18][6]->addTo($this->nodes['Wharton Center']);
        $this->grid[17][11]->addTo($this->nodes['Spartan Stadium']);
        $this->grid[17][12]->addTo($this->nodes['Spartan Stadium']);
        $this->grid[20][17]->addTo($this->nodes['Engineering Building']);

        //adds the movable nodes from rooms
        $this->nodes['International Center']->addTo($this->nodes['Engineering Building']);
        $this->nodes['International Center']->addTo($this->grid[7][4]);

        $this->nodes['Breslin Center']->addTo($this->grid[5][7]);
        $this->nodes['Breslin Center']->addTo($this->grid[8][9]);
        $this->nodes['Breslin Center']->addTo($this->grid[8][14]);
        $this->nodes['Breslin Center']->addTo($this->grid[5][16]);

        $this->nodes['Beaumont Tower']->addTo($this->nodes['Wharton Center']);
        $this->nodes['Beaumont Tower']->addTo($this->grid[6][18]);

        $this->nodes['University Union']->addTo($this->grid[12][8]);
        $this->nodes['University Union']->addTo($this->grid[16][6]);

        $this->nodes['Art Museum']->addTo($this->grid[9][17]);
        $this->nodes['Art Museum']->addTo($this->grid[13][22]);

        $this->nodes['Library']->addTo($this->grid[16][16]);
        $this->nodes['Library']->addTo($this->grid[13][20]);

        $this->nodes['Wharton Center']->addTo($this->nodes['Beaumont Tower']);
        $this->nodes['Wharton Center']->addTo($this->grid[18][6]);

        $this->nodes['Spartan Stadium']->addTo($this->grid[17][11]);
        $this->nodes['Spartan Stadium']->addTo($this->grid[17][12]);

        $this->nodes['Engineering Building']->addTo($this->nodes['International Center']);
        $this->nodes['Engineering Building']->addTo($this->grid[20][17]);
    }



    public function resetReachableOnPath(){
        for($row = 0; $row < 25; $row++){
            for($col = 0; $col < 24; $col++){
                $this->grid[$row][$col]->setReachable(false);
                //$this->grid[$row][$col]->setOnPath(false);
            }
        }
    }

    public function getNode($row, $col) {
        return $this->grid[$row][$col];
    }


    // array of cells
    private $grid = [];

    // array of room nodes
    private $nodes = [];
}