<?php

namespace DiceGame;


class Player {

    private $name;

    private $gameState = array();
    private $gameUpdates = array();
    private $game;

    public function __construct($name) {
        $this->name = $name;
    }

    public function setGame($g) {
        $this->game = $g;
    }

    public function name() {
        return $this->name;
    }

    // handle game state information
    public function tell($pubData) {
        $this->gameUpdates[] = $pubData;
    }



}
