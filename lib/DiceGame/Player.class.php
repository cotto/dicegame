<?php

namespace DiceGame;


abstract class Player {

    private $name;

    protected $gameState = array();
    protected $gameUpdates = array();
    protected $game;

    public function __construct($name) {
        $this->name = $name;
    }

    public function setGame($game) {
        $this->game = $game;
    }

    public function getName() {
        return $this->name;
    }

    // handle game state information
    public function tell($pubData) {
        $this->gameUpdates[] = $pubData;
    }


    public function askWhichRollsToKeep($rolls) {
        $rollValues = array();
        foreach ($rolls as $i => $rollNumber) {
            $rollValues[$i] = $this->game->getScoringRules()->rollValue($rollNumber);
        }

        $rollsToKeep = $this->decideWhichRollsToKeep($rollValues);
        return $rollsToKeep;
    }

    abstract protected function decideWhichRollsToKeep($rollValues);

    abstract public function getStrategyName();

}
