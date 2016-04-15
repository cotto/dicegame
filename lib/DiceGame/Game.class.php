<?php

namespace DiceGame;

class Game {

    private $dice; // should be "die" but that'd be ambiguous

    // array of Player objects
    private $players;

    // array of integers containing the running total of points for each player
    private $scores;

    // array of integers that determines which order players will take their turns
    private $playerOrder;

    public function __construct() {
        $this->scores = array();
        $this->players = array();
    }

    public function setDice($dice) {
        $this->dice = $dice;
    }

    public function addPlayer($player) {
        $this->players[] = $player;
        $this->scores[] = 0;
        $this->playerOrder = range(0, count($this->players));
        shuffle($this->playerOrder);
    }


}
