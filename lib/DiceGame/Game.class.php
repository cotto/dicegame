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

    public function getScoringRules() {
        return $this->scoringRules;
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

            $this->announce("\nstarting round $turnNum");
            $firstPlayer = $this->playerOrder[0];
            $firstPlayerName = $this->players[$firstPlayer]->getName();
            $this->announce("player $firstPlayer ($firstPlayerName) has the first turn");

            // give each player a turn
            foreach ($this->playerOrder as $playerNum) {

                $currPlayer = $this->players[$playerNum];

                $remainingDiceCount = $this->dicePerTurn;

                $this->announce("\nstarting turn for '".$currPlayer->getName()."'");

                while ($remainingDiceCount != 0) {

                    // roll dice
                    $diceRolls = array();
                    foreach (range(1, $remainingDiceCount) as $n) {
                        $diceRolls[] = $this->dice->roll();
                    }
                    $this->announce("rolls for player $playerNum: ".join($diceRolls, ','));
                    
                    // tell all players about the initial roll
                    $this->tellPlayers(array(
                        'eventName'  => 'roll',
                        'playerName' => $currPlayer->getName(),
                        'diceRolls'  => $diceRolls,
                    ));

                    // ask player which dice she wants to keep
                        // e.g. "keep 0, 1, 3"
                    $rollsToKeep = $currPlayer->askWhichRollsToKeep($diceRolls);
                    $this->note("player will keep the following rolls: ".join($rollsToKeep, ','));

                    // validate that the player asked to keep at least one die
                    if (!$this->isRollsToKeepValid($rollsToKeep)) {
                        // TODO: handle this more gracefully.
                        throw new Exception($currPlayer->getName()." attempted to select 0 rolls and killed the game");
                    }

                    // calculate the score 
                    $turnScore = $this->getTurnScore($diceRolls, $rollsToKeep);
                    $this->note("adding $turnScore to player's total points");
                    $this->scores[$playerNum] += $turnScore;

                    // announce this player's move
                    $this->tellPlayers(array(
                        'eventName'  => 'move',
                        'playerName' => $currPlayer->getName(),
                        'diceRolls'  => $diceRolls,
                        'rollsKept'  => $rollsToKeep,
                        'totalScore' => $this->scores[$playerNum],
                    ));

                    $remainingDiceCount = $this->getDiceRemaining($rollsToKeep);
                    $this->note("remaining dice count is $remainingDiceCount");
                }
                $this->note("player's score is now ".$this->scores[$playerNum]);

            } 

            $this->rotatePlayerOrder();
        } // end of round

        $lowScore = false;
        $winners = array();

        for($i = 0; $i < count($this->players); $i++) {
            $playerScore = $this->scores[$i];
            $this->announce("player $i \"".$this->players[$i]->getName()."\" scored $playerScore points");
            if ($lowScore === false || $playerScore <= $lowScore) {

                // deal with ties
                if ($lowScore == $playerScore) {
                    $winners[] = $i;
                } 
                else {
                    $winners = array($i);
                }
                $lowScore = $playerScore;
            }
        }

        if (count($winners) > 1) {
            $this->announce("\nThe winners are...");
        }
        else {
            $this->announce("\nThe winner is...");
        }
        foreach ($winners as $i) {
            $winner = $this->players[$i];
            $this->announce($winner->getName().", whose strategy was '".$winner->getStrategyName()."'");
        }
    }

    private function getTurnScore($diceRolls, $rollsToKeep) {
        $turnScore = 0;
        foreach ($diceRolls as $i => $rollNumber) {
            if ($rollsToKeep[$i]) {
                $turnScore += $this->getScoringRules()->rollValue($rollNumber);
            }
        }
        return $turnScore;
    }

    public function isRollsToKeepValid($rollsToKeep) {
        foreach ($rollsToKeep as $i => $willKeepRoll) {
            if ($willKeepRoll) {
                return true;
            }
        }
        return false;
    }

    // could do this with array_map but this may be clearer
    private function getDiceRemaining($rollsToKeep) {
        $remainingDiceCount = 0;
        foreach ($rollsToKeep as $keepRoll) {
            if (!$keepRoll) {
                $remainingDiceCount++;
            }
        }
        return $remainingDiceCount;
    }

}
