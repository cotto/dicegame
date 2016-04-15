<?php

namespace DiceGame\Player;


class AlwaysPickLowestRoll extends \DiceGame\Player {

    protected function decideWhichRollsToKeep($rollValues) {
        $picks = array();

        $minRollValue = 99;

        foreach ($rollValues as $rollValue) {
            if ($rollValue < $minRollValue) {
                $minRollValue = $rollValue;
            }
        }

        foreach ($rollValues as $i => $rollValue) {
            if ($rollValue == $minRollValue) {
                $picks[] = 1;
            }
            else {
                $picks[] = 0;
            }
        }

        return $picks;
    }

    public function getStrategyName() {
        return "pick all dice that have the lowest roll";
    }

}
