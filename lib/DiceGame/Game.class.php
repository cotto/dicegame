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


    // number of dice rolled during a player's turn
    private $dicePerTurn;

    private $debugOutput = false;

    public function __construct() {
        $this->scores = array();
        $this->players = array();
        $this->dicePerTurn = 0;
    }

    public function setDicePerTurn($i) {
        // TODO: validate int
        $this->dicePerTurn = $i;
        $this->note("each player will roll $i dice per turn");
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

    // print debug output
    public function note($s) {
        if ($this->debugOutput) {
            echo "$s\n";
        }
    }

    // print game state information
    public function announce($s) {
        echo "$s\n";
    }

    private function rotatePlayerOrder() {
        $firstPlayer = array_shift($this->playerOrder);
        $this->playerOrder[] = $firstPlayer;
    }

    public function playGame() {

        $this->announce("starting game...");

        // run one round for each player
        for ($turnNum = 1; $turnNum <= count($this->players); $turnNum++) {

            $this->announce("starting round $turnNum");
            $firstPlayer = $this->playerOrder[0];
            $this->announce("player $firstPlayer has the first turn");

            // give each player a turn
            foreach ($this->playerOrder as $playerNum) {

                $currPlayer = $this->players[$playerNum];

                // roll 5 dice
                $diceRolls = array();
                foreach (range(0, $this->dicePerTurn) as $n) {
                    $diceRolls[] = $this->dice->roll();
                }
                $this->announce("initial rolls for player $playerNum: ".join($diceRolls, ','));



                // while (something)
                    //


            } // end of player's turn

            $this->rotatePlayerOrder();
        } // end of round

    }


}
