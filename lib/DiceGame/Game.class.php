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

    private $debugOutput = false;

    public function __construct() {
        $this->scores = array();
        $this->players = array();
    }

    public function setDice($dice) {
        $this->dice = $dice;
        $diceSize =  $dice->size();
        $this->note("added a D$diceSize as the dice");
    }

    public function addPlayer($player) {
        $this->players[] = $player;
        $this->scores[] = 0;
        $this->playerOrder = range(0, count($this->players)-1);
        shuffle($this->playerOrder);
        $this->note("Added a player.  The new order is ".join(',', $this->playerOrder).'.');
    }

    public function enableDebugOutput() {
        $this->debugOutput = true;
        $this->note("debug output is enabled");
    }

    public function note($s) {
        if ($this->debugOutput) {
            echo "$s\n";
        }
    }

    public function playGame() {
        // ...
    }


}
