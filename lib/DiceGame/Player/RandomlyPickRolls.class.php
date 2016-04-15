<?php

namespace DiceGame\Player;


class RandomlyPickRolls extends \DiceGame\Player {

    protected function decideWhichRollsToKeep($rollValues) {
        $picks = array();

        while (!$this->game->isRollsToKeepValid($picks)) {
            $picks = array();
            foreach ($rollValues as $rollValue) {
                $picks[] = rand(0,1);
            }
        }
        return $picks;
    }

    public function getStrategyName() {
        return "randomly pick dice with a 50% probability";
    }

}
