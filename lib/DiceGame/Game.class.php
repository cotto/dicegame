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

    private $scoringRules;

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

    public function setScoringRules($scoringRules) {
        $this->scoringRules = $scoringRules;
    }

    public function addPlayer($player) {
        $this->players[] = $player;
        $this->scores[] = 0;
        $this->playerOrder = range(0, count($this->players)-1);
        shuffle($this->playerOrder);
        $player->setGame($this);
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

    public function tellPlayers($pubData) {
        foreach ($this->players as $player) {
            $player->tell($pubData);
        }
    }

    private function rotatePlayerOrder() {
        $firstPlayer = array_shift($this->playerOrder);
        $this->playerOrder[] = $firstPlayer;
    }

    public function playGame() {

        // TODO: validate that the game has been set up correctly
        //   - scoring rules
        //   - dice
        //   - players
        //   - rolls per turn

        $this->announce("starting game...");

        // run one round for each player
        for ($turnNum = 1; $turnNum <= count($this->players); $turnNum++) {

            $this->announce("starting round $turnNum");
            $firstPlayer = $this->playerOrder[0];
            $firstPlayerName = $this->players[$firstPlayer]->name();
            $this->announce("player $firstPlayer ($firstPlayerName) has the first turn");

            // give each player a turn
            foreach ($this->playerOrder as $playerNum) {

                $currPlayer = $this->players[$playerNum];

                // roll dice
                $diceRolls = array();
                foreach (range(0, $this->dicePerTurn) as $n) {
                    $diceRolls[] = $this->dice->roll();
                }
                $this->announce("initial rolls for player $playerNum: ".join($diceRolls, ','));

                // tell all other players what this player rolled
                // tell this player what she rolled
                // ask player which dice she wants to keep
                    // e.g. "keep 0, 1, 3"
                // validate that the player asked to keep at least one die
                // announce this player's move
                // calculate the score 


                // while (something)
                    //


            } // end of player's turn

            $this->rotatePlayerOrder();
        } // end of round

    }


}
